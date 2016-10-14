<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: String.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_String_Validator
 *
 * @author cherif
 */
class Amhsoft_String_Validator extends Amhsoft_Abstract_Validator {

  protected $_value;
  protected $_min;
  protected $_max;
  protected $message = '';

  public function __construct($min = 0, $max = 0) {
    $this->_min = intval($min);
    $this->_max = intval($max);
  }

  public function setValue($value) {
    $this->_value = $value;
  }

  public function getErrorMessage() {
    return $this->message;
  }

  public function isValid() {
    $this->_value = ltrim($this->_value);
    if (!is_string($this->_value)) {
      $this->message = _t('is invalid');
      return false;
    }
    if (strlen($this->_value) == 0) {
      $this->message = _t('is empty');
      return false;
    }
    if ($this->_min > 0 && $this->_max > 0 && ((strlen($this->_value) <= $this->_min) || strlen($this->_value) >= $this->_max)) {
      $this->message = _t('must between %s and %s', array($this->_min, $this->_max));
      return false;
    }
    if ($this->_min > 0 && strlen($this->_value) <= $this->_min) {
      $this->message = _t('is too short, minimun character is %s', $this->_min);
      return false;
    }
    if ($this->_max > 0 && strlen($this->_value) >= $this->_max) {
      $this->message = _t('is too long, maximum character is %s', $this->_max);
      return false;
    }
    return true;
  }

}

?>
