<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Url.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_Url_Validator
 *
 * @author cherif
 */
class Amhsoft_Url_Validator extends Amhsoft_Abstract_Validator {

  protected $_value;

  public function __construct() {
    
  }

  public function setValue($value) {
    $this->_value = $value;
  }

  public function getErrorMessage() {
    return _t('is not a valid URL');
  }

  public function isValid() {
    if (!is_string($this->_value)) {
      return false;
    }
    return preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $this->_value);
  }

}

?>
