<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Config.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_System_Config {

  /** @var Amhsoft_Config_Abstract $adapter */
  protected $data;
  protected static $instance;

  /**
   * Get System Configuration
   * @return Amhsoft_System_Config
   */
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Amhsoft_System_Config();
    }
    return self::$instance;
  }

  public static function getProperty($name, $defaultValue = null) {
    $val = self::getInstance()->$name;
    if (!isset($val)) {
      return $defaultValue;
    }
    return $val;
  }

  public function getProperties() {
    return $this->data;
  }

  public function merge(Amhsoft_Config_Abstract $adapter) {
    $this->data = array_merge((array) $this->data, $adapter->getConfiguration());
  }

  public function setAdapter(Amhsoft_Config_Abstract $adapter) {
    $this->data = (array) $adapter->getConfiguration();
  }

  public function hasKey($key) {
    return isset($this->data[$key]);
  }

  public function __get($key) {
    if ($this->hasKey($key)) {
      return $this->data[$key];
    }
  }

  public function setProperty($name, $value) {
    $this->data[$name] = $value;
  }

  public static function getSalt($duration = 'd') {
    if ($duration == 'd') {
      $key = date('ymd');
    } elseif ($duration == 'h') {
      $key = date('ymdH');
    }
    $randomKey = $key;
    return $randomKey;
  }

}

?>
