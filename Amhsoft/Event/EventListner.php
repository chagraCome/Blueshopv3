<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: EventListner.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
/*
 * BusinessOrmLister interface
 */
interface IModelEventListener {

  public function receive($eventname, DbObjectAdapter $sender, $args);
}

interface IEventListener {

  public function receive($eventname, $sender, $args);
}

/**
 * Controller Listner Interface.
 */
interface IControllerEventListener {

  public function receive($eventname, IController $sender, $args);
}

interface IApplicationBootEventListener {

  public function receive($module, $controller, $event, &$stop);
}

class EventHandler {

  protected static $_observers = array();
  protected static $events = array();

  public static function attach(IEventListener $listener, $eventName) {
    self::$_observers[$eventName][] = $listener;
  }

  public static function trigger($eventName, $sender, $args) {
    self::$events[] = $eventName;
    if (isset(self::$_observers[$eventName])) {
      foreach ((array) self::$_observers[$eventName] as $observer) {
        $observer->receive($eventName, $sender, $args);
      }
    }
  }

  public static function debug() {
    echo '<script>alert("' . implode('\n', self::$events) . '");</script>';
  }

}

class ModelEventHandler extends EventHandler {

  public static function attach(IModelEventListener $listener, $eventName) {
    self::$_observers[$eventName][] = $listener;
  }

}

class ApplicationBootEventHandler extends EventHandler {

  public static function attach(IApplicationBootEventListener $listener, $eventName = 'boot') {
    self::$_observers[$eventName][] = $listener;
  }

  public static function trigger($eventName, $module, $controller, $event, &$stop) {
    if (isset(self::$_observers[$eventName])) {
      foreach ((array) self::$_observers[$eventName] as $observer) {
        $observer->receive($module, $controller, $event, $stop);
      }
    }
  }

}

class ControllerEventHandler extends EventHandler {

  public static function attach(IControllerEventListener $listner, $eventName) {
    self::$_observers[$eventName][] = $listner;
  }

}

?>
