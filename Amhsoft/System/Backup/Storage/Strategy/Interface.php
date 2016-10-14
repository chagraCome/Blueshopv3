<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
interface Amhsoft_System_Backup_Storage_Strategy_Interface{
  public function store($data, $fileName);
   public function listAll();
}
?>
