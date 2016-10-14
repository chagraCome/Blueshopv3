<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Email.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_Email_Validator
 *
 * @author cherif
 */
class Amhsoft_Email_Validator extends Amhsoft_Abstract_Validator {

  protected $_value;

  public function __construct($value = null) {
    $this->_value = $value;
  }

  public function setValue($value) {
    $this->_value = $value;
  }

  public function getErrorMessage() {
    return _t('is not a valid email address');
  }

  public function isValid() {
    if (!is_string($this->_value)) {
      return false;
    }
    return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i', $this->_value) == TRUE;
  }

}

?>
