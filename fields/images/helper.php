<?php 
  function translation($string) {
    
    $translations = require __DIR__ . DS . 'translations.php';
    $language = substr( site()->user()->language(), 0, 2 );
    if (!array_key_exists($language, $translations)) {
      $language = 'en';
    }
    $translation = $translations[$language];
    
    if(array_key_exists($string, $translation)) {
      $string = $translation[$string];
    }
    return $string;
    
  }