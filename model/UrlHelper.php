<?php

class UrlHelper{

  public static function redirect($additionalPath = ''){
    header('Location: '.self::getBaseUrl().$additionalPath); exit();
  }

  public static function getBaseUrl(){
    return sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME']
          );
  }
}