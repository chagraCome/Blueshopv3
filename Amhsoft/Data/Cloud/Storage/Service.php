<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Cloud_Storage_Service {

  protected static $services = array();

  public static function addSerivce($alias, Amhsoft_Data_Cloud_Storage_Interface $storage) {
    self::$services[$alias] = $storage;
  }

  public static function fetchItem($item) {
    if (empty(self::$services)) {
      self::$services['file'] = new Amhsoft_Data_Cloud_Storage_File_Service();
    }
    foreach (self::$services as $alias => $service) {
      if ($service instanceof Amhsoft_Data_Cloud_Storage_Interface) {
        $data = $service->fetchItem($item);
        if (FALSE !== $data) {
          return $data;
        }
      }
    }
    return null;
  }

  public static function storeItem($item, $data) {
    if (empty(self::$services)) {
      self::$services['file'] = new Amhsoft_Data_Cloud_Storage_File_Service();
    }

    foreach (self::$services as $alias => $service) {
      if ($service instanceof Amhsoft_Data_Cloud_Storage_Interface) {
        $service->storeItem($item, $data);
      }
    }
  }
  
  public static function deleteItem($item) {
    if (empty(self::$services)) {
      self::$services['file'] = new Amhsoft_Data_Cloud_Storage_File_Service();
    }

    foreach (self::$services as $alias => $service) {
      if ($service instanceof Amhsoft_Data_Cloud_Storage_Interface) {
        $service->deleteItem($item);
      }
    }
  }

  public static function removeService($alias) {
    unset(self::$services[$alias]);
  }

}

?>
