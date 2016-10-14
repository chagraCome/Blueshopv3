<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Abstract.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_Config_Abstract {

  /**
   * Get all pair key, value as associative array
   * example array('config_key_1' => 'config_key1_value, ....);
   */
  abstract function getConfiguration();

  /**
   * getValue('your key')
   * @param $key String
   * @return mixed value
   */
  abstract function getValue($key, $defaultValue = null);

  /**
   * Check if key $key exists in the configuration
   */
  abstract function hasKey($key);

  abstract function getIntValue($key);

  abstract function getDoubleValue($key);

  abstract function getStringValue($key);

  abstract function getArrayValue($key);

  public function __get($key) {
    if ($this->hasKey($key)) {
      return $this->data[$key];
    }
  }

  public function __set($key, $value) {
    return $this->data[$key] = $value;
  }

}

?>
