<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_Data_Cloud_Storage_Http_Service implements Amhsoft_Data_Cloud_Storage_Interface{
  
  protected $stream;
  protected $serviceUrl;
  protected $userName;
  protected $password;
  
  public function __construct($serviceUrl, $userName=null, $password=null) {
    $this->serviceUrl = $serviceUrl;
  }
  
  public function fetchItem($item){  
    $storagePath = rtrim($this->serviceUrl, '/').'/' .ltrim($item, '/');
    $http = new Amhsoft_Http();
    $this->stream = $http->execute($storagePath);  
    return $this->stream;
  }

  public static function deleteItem($item) {
    
  }

  public static function storeItem($item, $data) {
    
  }
  
}
?>
