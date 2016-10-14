<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Amhsoft_System_Backup_Abstract_Handler {

  abstract function init();
  
  abstract function backupModule($moduleName, $database=true, $data=true);
  abstract function getData();

  public function getFilesAndDataFromDirs($dirs) {
    $files = array();
    if (is_array($dirs)) {
      foreach ($dirs as $dir) {
        if (is_dir($dir)) {
          $files = array_merge($files, Amhsoft_Common::scandirFlat($dir));
        }
      }
    }
    $array = array();

    foreach ($files as $file) {
      $data = file_get_contents($file);
      $array[] = array('filename' => $file, 'data' => $data);
    }
    return $array;
  }

  public function getFilesFromDirs($dirs) {
    $files = array();
    if (is_array($dirs)) {
      foreach ($dirs as $dir) {
        if (is_dir($dir)) {
          $files = array_merge($files, Amhsoft_Common::scandirFlat($dir));
        }
      }
    }
    $array = array();

    foreach ($files as $file) {
      $array[] = $file;
    }
    return $array;
  }

}

?>
