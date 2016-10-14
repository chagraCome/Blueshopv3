<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Debugger.php 132 2016-01-26 19:36:21Z a.cherif $
 * $Rev: 132 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 20:36:21 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Debugger {

    public static $debuger;
    public static $debugerRendrer;

    /**
     * Check if Amhsoft Debug Bar is enabled.
     * @return boolean state.
     */
    public static function isActive() {
        return (Amhsoft_System_Config::getInstance()->getProperty('amhsoft_debugbar') === 'true');
    }

    /**
     * Gets Amhsoft Debug Bar Instance.
     * @return Amhsoft_Debugger.
     */
    public static function getInstance() {
        if (self::$debuger === NULL) {
            self::$debuger = new DebugBar\StandardDebugBar();
            return self::$debuger;
        } else {
            return self::$debuger;
        }
    }

    /**
     * Add Message in Amhsoft Debug Bar.
     * @param Mixed $message
     * @param String $type (info,warning,error)
     */
    public static function addMessage($message, $type = 'info') {
        self::getInstance()->getCollector('messages')->addMessage($message, $type);
    }
    
   

    /**
     * Start Measure.
     * @param String $name
     * @param String $label
     */
    public static function startMeasure($name, $label) {
        self::getInstance()->getCollector('time')->startMeasure($name, $label);
    }

    /**
     * Stop Measure.
     * @param String $name
     */
    public static function stopMeasure($name) {
        self::getInstance()->getCollector('time')->stopMeasure($name);
    }
    
    /**
     * Add Exception
     * @param Exception $e
     */
    public static function addException(Exception $e){
        self::getInstance()->getCollector('exceptions')->addException($e);
    }

}

?>