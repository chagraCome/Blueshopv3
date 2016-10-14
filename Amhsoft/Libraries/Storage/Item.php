<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Item.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Storage
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Storage_Item{
  public $name;
  public $pathName;
  public $fullPathName;
  public $binary;
  public $size;
  public $extention;
  
  public static function fromFile($filePath){
    $item = new Amhsoft_Storage_Item();
    //TODO: implement
    //$item->pathName = dirname($filePath);
    //$item->size = ?
    //...
  }
}

