<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
interface Amhsoft_Data_Cloud_Storage_Interface{
  public function fetchItem($item);
  public static function storeItem($item, $data);
  public static function deleteItem($item);
}
?>
