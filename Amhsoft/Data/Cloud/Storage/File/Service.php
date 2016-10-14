<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_Data_Cloud_Storage_File_Service implements Amhsoft_Data_Cloud_Storage_Interface{
  
  protected $stream;
  protected $userName;
  protected $password;
  
  public function __construct() {
  }
  
  public function fetchItem($item){  
    return @file_get_contents($item);
  }

  public static function deleteItem($item) {
    return @unlink($item);
  }

  public static function storeItem($item, $data) {
    return @file_put_contents($item, $data);
  }
  
}
?>
