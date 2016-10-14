<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_System_Backup_Storage_Strategy_Local implements Amhsoft_System_Backup_Storage_Strategy_Interface{
  
  private $backupDir;
  
  public function __construct($backupDir) {
    $this->backupDir = rtrim($backupDir, '/');

    if(!is_dir($this->backupDir)){
      @mkdir($this->backupDir, 0777, true);
    }
    
    if(!is_dir($this->backupDir)){
      throw new Exception('Backup directory '.$this->backupDir. ' does not exists.');
    }
    
    if(!is_writable($this->backupDir)){
      throw new Exception('Backup directory '.$this->backupDir. ' is not writeable');
    }
  }
  
  public function store($data, $fileName){
    $dir = $this->backupDir.'/'.$fileName;
    file_put_contents($dir, $data);
  }
  
  public function listAll(){
    return glob($this->backupDir.'/*');
  }
}
?>
