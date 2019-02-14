<?php

class ImageManager{
  protected $_pathToSave;
  protected $_items;
  protected $_folder;

  public function __construct($items, $path = '/images/'){
    $this->_items       = $items;
    $this->_folder      = $path.uniqid('padronizr', true);
    $this->_pathToSave  = dirname(__DIR__).$this->_folder.'/';
  }

  public function processImages(){
    for ($i=1; $i < count($this->_items); $i++) {
      foreach (explode('|',$this->_items[$i]['images']) as $position => $imageUrl) {
        $this->saveImage(
          $this->downloadImages($imageUrl),
          $this->getUrlToSaveImage($imageUrl, $this->_items[$i]['sku'], ($position+1))
        );
      }
    }
  }

  public function downloadImages($url){
    $ch = curl_init ();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $imageData = curl_exec($ch);
    curl_close ($ch);
    return $imageData;
  }

  public function getUrlToSaveImage($imageUrl, $baseIdentifier, $sequenceNumber){
    $extension        = explode('?',end(explode('.', $imageUrl)))[0];
    return $this->_pathToSave.($baseIdentifier.'-'.$sequenceNumber.'.'.$extension);
  }

  public function saveImage($imageData, $saveTo){
    if(!file_exists($this->_pathToSave)){ mkdir($this->_pathToSave, 0777, true); }
    if(file_exists($saveTo)){ unlink($saveTo); }

    $file = fopen($saveTo,'w');
    fwrite($file, $imageData);
    fclose($file);
    return $saveTo;
  }

  public function getFolderName(){ return end(explode('/', $this->_folder)); }

  public function getFolderPath(){ return $this->_pathToSave; }

  public function deleteFolder(){
    $this->deleteImages();
    rmdir($this->_pathToSave);
  }

  public function deleteImages(){
    $files = glob($this->_pathToSave . '/*');
    foreach($files as $file){
      if(is_file($file)){
        unlink($file);
      }
    }
  }
}