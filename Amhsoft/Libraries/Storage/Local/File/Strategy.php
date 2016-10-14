<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Strategy.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Storage
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Storage_Local_File_Stragegy extends Amhsoft_Storage_Abstract_Strategy {

 
  public function copyItem($source, $destination) {
    copy($source, $destination);
  }

  public function deleteItem($source) {
    unlink($source);
  }

  public function fetchItem($source) {
    return $source;
  }

  public function fetchItems($path) {
    return glob($path);
  }

  public function renameItem($source, $destination) {
    rename($source, $destination);
  }

  public function store(Amhsoft_Storage_Item $item) {
    file_put_contents($item->fullPathName, $item->binary);
  }

  public function storeItem($source, $data, $options = array()) {
    file_put_contents($source, $data);
  }

}
