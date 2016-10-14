<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_Data_Search_Directory{
    
    public static $directoryPath='./_index/';
    private $directory;
    private $path;
    
    public function __construct($directory) {
        if(is_null($directory)){
            throw new Amhsoft_Search_Exception('Directory '. $directory. ' is empty');
        }
        
        $this->directory = self::getDefaultDirectoryPath().$directory;
        if(!is_dir($this->directory)){
            mkdir($this->directory, 0777);
        }
        $this->directory = $this->directory.'/';
    }
    
    public function getPath(){
        return $this->directory;
    }
    
    
    public function getIndexPath(){
        return $this->getPath() . '/_index';
    }
    
    public static function setDefaultDirectoryPath($path){
        self::$directoryPath = rtrim($path, '/').'/';
    }
    
    public static function getDefaultDirectoryPath(){
        return self::$directoryPath;
    }
}
?>
