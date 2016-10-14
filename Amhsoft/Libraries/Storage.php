<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Storage.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package  Lib
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Storage {

  public static function factory($type = 'local') {
    if ($type == 'local') {
      return new Amhsoft_Storage_Local_File_Stragegy();
    }

    if ($type == 'webdav') {
      //return new Amhsoft_Storage_Local_File_Stragegy();
    }

    if ($type == 'ftp') {
      //return new Amhsoft_Storage_Local_File_Stragegy();
    }

    if ($type == 'ftp') {
      //return new Amhsoft_Storage_Local_File_Stragegy();
    }
  }

}
