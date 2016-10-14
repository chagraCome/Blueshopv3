<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Double.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_Double_Validator
 *
 * @author cherif
 */
class Amhsoft_Double_Validator extends Amhsoft_Abstract_Validator {

  protected $_val;
  protected $_decimals;

  public function __construct($decimals = 2) {
    $this->_decimals = $decimals;
  }

  public function setValue($value) {
    $this->_val = $value;
  }

  public function isValid() {
    if (is_float($this->_val) || is_double($this->_val)) {
      return true;
    }
    if (filter_var($this->_val, FILTER_VALIDATE_FLOAT) !== true) {
      return true;
    }
    return false;
  }

  public function getErrorMessage() {
    return _t('does not appear to be a float');
  }

}

?>
