<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Event.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Widget_Event {

    private $callbacks = array();

    public function __construct() {
        
    }

    private function Get_Callback($args) {
        $context = isset($args[0]) && is_object($args[0]) ? get_class($args[0]) : $args[0];
        $e = (count($args) < 2) ? new Amhsoft_Widget_Event_Callback($args[0], '') : new Amhsoft_Widget_Event_Callback($args[1], $context);
        return $e;
    }

    public function registerEvent() {
        $callback = $this->Get_Callback(func_get_args());

        if (!in_array($callback, $this->callbacks)) {
            $this->callbacks[] = $callback;
        }
        else
            throw new Amhsoft_Widget_Event_Exception($callback->method . _t(' already subscribed to this event'));
    }

    public function unregisterEvent() {
        $callback = $this->Get_Callback(func_get_args());

        $key = array_search($callback, $this->callbacks);
        if (!($key === false)) {
            unset($this->callbacks[$key]);
        }
        else
            throw new Amhsoft_Widget_Event_Exception($callback->method . _t(' not subscribed to this event'));
    }

    public function dispatchEvent() {
        foreach ($this->callbacks as $callback) {
            if (method_exists($callback->context, $callback->method) || function_exists($callback->method)) {
                $params = func_get_args();
                if (!empty($callback->context)) {
                    return @call_user_func_array(array($callback->context, $callback->method), $params);
                } else {
                    return call_user_func_array(array($callback->method), $params);
                }
            }
            else
                throw new Amhsoft_Widget_Event_Exception($callback->method . _t(' does not exist'));
        }
    }

}
