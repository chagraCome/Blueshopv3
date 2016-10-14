<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Handler.php 198 2016-01-29 10:37:01Z montassar.amhsoft $
 * $Rev: 198 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-29 11:37:01 +0100 (ven., 29 janv. 2016) $
 * $Author: montassar.amhsoft $
 */
class Amhsoft_System_Boot_Event_Handler extends Amhsoft_Event_Handler {

    public static function attach(Amhsoft_System_Boot_Event_Listener_Abstract $listener, $eventName = 'boot') {
        self::$_observers[$eventName][] = $listener;
    }

    public static function trigger($eventName, Amhsoft_System $system) {
        if (isset(self::$_observers[$eventName])) {
            foreach ((array) self::$_observers[$eventName] as $observer) {
                if ($observer instanceof Amhsoft_Event_Listener) {
                    $observer->receive($eventName, $system);
                } else {
                    if (is_object($observer)) {
                        continue;
                    }
                    call_user_func($observer, $system);
                }
            }
        }
    }

    public static function addListner($eventName, $listener) {
        self::$_observers[$eventName][] = $listener;
    }

}

?>
