<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Registry.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Registry {

  const PREFIX = 'amhsoft_reg_';

  /**
   * Regsiter a key val
   * @param string $key
   * @param mixed $val
   * @param bool $safe
   * @throws Exception
   */
  public static function register($key, $val, $safe = false) {
    if ($safe == true && array_key_exists($key, $_SESSION[self::PREFIX])) {
      throw new Exception("key $key exists!");
    }

    $_SESSION[self::PREFIX][$key] = $val;
  }

  /**
   * Gets stored value in the registry.
   * @param string $key
   * @param mixed $default
   * @return mixed stored val
   */
  public static function get($key, $default = null) {
    return isset($_SESSION[self::PREFIX][$key]) ? $_SESSION[self::PREFIX][$key] : $default;
  }

  /**
   * Destry a registerd key.
   * @param string $key
   * @return void
   */
  public static function destroy($key) {
    if (!isset($_SESSION[self::PREFIX][$key]))
      return;
    if (is_object($_SESSION[self::PREFIX][$key]) && method_exists($_SESSION[self::PREFIX][$key], __destruct)) {
      $_SESSION[self::PREFIX][$key]->__destruct();
    }
    unset($_SESSION[self::PREFIX][$key]);
  }

}

?>
