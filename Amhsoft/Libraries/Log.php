<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Log.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
require dirname(__FILE__).'/Log/Abstract.php';
require dirname(__FILE__).'/Log/Console/Adapter.php';
require dirname(__FILE__).'/Log/File/Adapter.php';
require dirname(__FILE__).'/Log/Firebug/Adapter.php';

class Amhsoft_Log {

    /** @var Amhsoft_Log_Abstract $adapter */
    private static $_adapter = null;
    private static $_debug_mode = false;

    private static function getAdapter() {
        if (self::$_adapter === null) {
            self::$_adapter = new Amhsoft_Log_Console_Adapter();
        }
        return self::$_adapter;
    }

    public static function setDebugMode($mode = true) {
        self::$_debug_mode = $mode;
    }

    public static function setLogger(Amhsoft_Log_Abstract $logger) {
        self::$_adapter = $logger;
    }

    public static function error($msg, $obj=null) {
        if (self::$_debug_mode) {
            self::getAdapter()->error($msg, $obj);
        }
    }

    public static function info($msg, $obj=null) {
        if (self::$_debug_mode) {
            self::getAdapter()->info($msg, $obj);
        }
    }

    public static function warn($msg, $obj=null) {
        if (self::$_debug_mode) {
            self::getAdapter()->warn($msg, $obj);
        }
    }

}

?>
