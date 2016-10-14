<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cache
 *
 * @author administrator
 */
class Amhsoft_Cache {
    
    private $_adapter;
    
    public function __construct(Amhsoft_Cache_Interface $adapter) {
      $this->_adapter = $adapter;
    }
    
    public static function factory($type='file'){
      if($type == 'file'){
        $cacheManager = new Amhsoft_Cache(new Amhsoft_Cache_File_Adapter());
        return $cacheManager;
      }
    }
    
    public function add($key, $data){
        $this->_adapter->add($key, $data);
        return $this;
    }
    
    public function get($key){
       return  $this->_adapter->get($key);
    }
}

?>
