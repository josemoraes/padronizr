<?php

class CsvReader{
  protected $_file;
  protected $_data;

  public function __construct($file){
    $this->_file = $file;
    $this->_data = [];
  }

  public function read(){
    $file = new SplFileObject($this->_file);
    $file->setFlags(SplFileObject::READ_CSV);
    $file->setCsvControl(',');
    foreach ($file as $position => $row) {
        if($row[0]){
          list($this->_data[$position]['sku'], $this->_data[$position]['images']) = $row;
        }
    }
    return $this->_data;
  }
}