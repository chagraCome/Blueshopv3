<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Version.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Version {

    public static $versionNumber = '3.0';
    public static $versionName = 'Blueshop';
    public static $build = '1.0.5';
    public static $builddate = '20/01/2016';
    public static $licenceDomain = 'amhsoft.com';

    public static function getVersionNumber() {
        return self::$versionNumber;
    }

    public static function getVersion() {
        return self::getVersionName() . ' ' . self::getVersionNumber();
    }

    public static function getVersionName() {
        return self::$versionName;
    }

    public static function getBuild() {
        return self::$build;
    }

    public static function getBuildDate() {
        return self::$builddate;
    }

    public static function getCopyrightYear() {
        return date('Y');
    }

    public static function getLicenceDomain() {
        return self::$licenceDomain;
    }

}
