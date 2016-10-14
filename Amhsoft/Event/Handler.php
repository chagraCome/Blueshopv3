<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Handler.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Event_Handler {

    protected static $_observers = array();
    protected static $events = array();

    public static function attach(Amhsoft_Event_Listener $listener, $eventName) {
         
        self::$_observers[$eventName][] = $listener;
    }

    public static function trigger($eventName, $sender, $args) {
       if($eventName == 'before.fetch.eav_attribute_datasource_model' || $eventName == 'before.fetch.eav_attribute_model' || $eventName == 'after.fetch.eav_attribute_datasource_model' || $eventName == 'after.fetch.eav_attribute_model'){
            return;
        }
        Amhsoft_Debugger::getInstance()->getCollector('Events')->addEvent($eventName, $sender, $args);
        self::$events[] = $eventName;
        $stop = false;
        if (isset(self::$_observers[$eventName])) {
            $stop = true;
            foreach ((array) self::$_observers[$eventName] as $observer) {
                $stop &= $observer->receive($eventName, $sender, $args);
            }
        }
        return $stop;
    }

    public static function debug() {
        echo '<script>alert("' . implode('\n', self::$events) . '");</script>';
    }

}

?>
