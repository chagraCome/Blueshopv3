<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adapter
 *
 * @author administrator
 */
class Amhsoft_Cache_File_Adapter implements Amhsoft_Cache_Interface{
    
    private $cachedir;
    private $cacheFile;
    private $cacheData = array();
    
    public function __construct($cachedir='cache') {
        $this->cachedir = rtrim($cachedir, '/'). '/';
        $this->cacheFile = $this->cachedir.'.cache';
        if(!file_exists($this->cacheFile)){
          $this->cacheData = array('timesmtp', microtime(true));
          file_put_contents($this->cacheFile, serialize($this->cacheData));
        }else{
          $this->cacheData = unserialize(file_get_contents($this->cacheFile));
          $this->flush();
        }
    }
    
    private function flush(){
      file_put_contents($this->cacheFile, serialize($this->cacheData));
    }
    
    public function add($key, $data) {
        $this->cacheData[$key] = $data;
        $this->flush();
    }

    public function get($key) {
        return @$this->cacheData[$key];
    }
}

?>
