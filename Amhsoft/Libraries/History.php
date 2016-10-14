<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: History.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Amhsoft_History {

  public static function getName() {
    return 'history_stack_' . Amhsoft_System::getLevel();
  }

  public static function Observe() {
    global $_GET, $_POST;
    $post_vars = $_POST;
    $URL = @$_SERVER['REQUEST_URI'];
    if (preg_match('/(quicklist|quickadd|document|ajax|delete|modify|getmodels|qualify|makes|offline|online)/', $URL)) {
      return;
    }
    $data = $URL;
    $stack = Amhsoft_Registry::get(self::getName());

    if (!is_array($stack)) {
      $stack = array();
    }
    if (@end($stack) == $data) {
      return;
    }

    array_push($stack, $data);


    while (count($stack) > 5) {
      array_shift($stack);
    }

    Amhsoft_Registry::register(self::getName(), $stack);
  }

  public static function getHistory() {
    $stack = Amhsoft_Registry::get(self::getName());
    if (!is_array($stack)) {
      return array();
    }
    return $stack;
  }

  /**
   *
   * @return array
   */
  public static function getLast() {
    $stack = self::getHistory();
    $current = $_SERVER['PHP_SELF'];
    $last = @end($stack);
    if (strpos($current, 'admin.php') && strpos($last, 'index.php')) {
      return rtrim($current, "&ret=true") . "?ret=true";
    }
    return @end($stack);
  }

  public static function back($count = 0) {
    $stack = self::getHistory();
    $count = intval($count);
    $i = count($stack);
    if ($count > 0 && $i > $count) {
      $current = $_SERVER['PHP_SELF'];
      $last = $stack[($i - ($count + 1))];
      if (strpos($current, 'admin.php') && strpos($last, 'index.php')) {
        return $current . "?ret=true";
      } else {
        return @str_replace("&ret=true", "", $stack[($i - ($count + 1))]);
      }
    }

    $current = $_SERVER['PHP_SELF'];
    $last = @end($stack);
    if (strpos($current, 'admin.php') && strpos($last, 'index.php')) {
      return rtrim($current, "&ret=true") . "?ret=true";
    }
    return @str_replace("&ret=true", "", @end($stack));
  }

  /**
   * Clear the history
   */
  public static function clear() {
    $stack = Registry::destroy(self::getName());
    $stack->stack = array();
    $stack->position = 0;
  }

}

?>