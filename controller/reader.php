<?php
// ini_set('display_errors', true);
require_once "../model/CsvReader.php";
require_once "../model/ImageManager.php";
require_once "../model/ZipManager.php";
require_once "../model/UrlHelper.php";

$message = '';

if (!empty($_FILES['fileToUpload']['tmp_name'])) {
  $file     = new CsvReader($_FILES['fileToUpload']['tmp_name']);
  $imageMng = new ImageManager($file->read());
  $imageMng->processImages();
  $zipMng   = new ZipManager($imageMng->getFolderName(), $imageMng->getFolderPath());
  $zipMng->downloadZip();
  $imageMng->deleteFolder();

  $message  = 'Imagens baixadas com sucesso';
}else{
  $message  = 'É necessário informar um arquivo CSV válido';
}

UrlHelper::redirect('?message='.$message);