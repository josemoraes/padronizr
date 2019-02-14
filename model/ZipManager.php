<?php

class ZipManager{
  protected $_folder;
  protected $_folderPath;
  protected $_zipName;

  public function __construct($folder, $folderPath){
    $this->_zipName     = $folder.'.zip';
    $this->_folderPath  = $folderPath;
  }

  public function downloadZip(){
    $this->zipFile();
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$this->_zipName");
    header("Content-length: " . filesize($this->_zipName));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$this->_zipName");
    unlink($this->_zipName);
  }

  public function zipFile(){
    $zip = new ZipArchive();
    $zip->open($this->_zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $files = $this->getFilesFromFolder();

    foreach ($files as $name => $file)
    {
      if (!$file->isDir())
      {
        $filePath     = $file->getRealPath();
        $relativePath = substr($filePath, strlen($this->_folderPath));
        $zip->addFile($filePath, $relativePath);
      }
    }

    $zip->close();
  }

  public function getFilesFromFolder(){
    return new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->_folderPath),
            RecursiveIteratorIterator::LEAVES_ONLY
          );
  }
}