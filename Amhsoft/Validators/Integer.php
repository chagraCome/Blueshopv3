<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Integer.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author cherif
 */
class Amhsoft_Integer_Validator extends Amhsoft_Abstract_Validator {

  protected $_val;
  protected $_min;
  protected $_max;


  /**
   * 
   * @param int $value
   * @param int $min
   * @param int $max
   */
  public function __construct($min=-1, $max=-1) {
    $this->_min = $min;
    $this->_max = $max;
  }

  public function getMin() {
    return $this->_min;
  }

  public function setMin($_min) {
    $this->_min = $_min;
  }

  public function getMax() {
    return $this->_max;
  }

  public function setMax($_max) {
    $this->_max = $_max;
  }

    
  public function setValue($value) {
    $this->_val = $value;
  }

  /**
   * Check if valid or not
   * @return boolean when valid return true otherwise return false.
   */
  public function isValid() {
    $is_int =  (boolean) ((string) intval($this->_val) == (string) $this->_val);
    if(!$is_int){
      return false;
    }
    
    if($this->_min > -1 && intval($this->_val) < $this->_min){
      return false;
    }
    
    if($this->_max > -1 && intval($this->_val) > $this->_max){
      return false;
    }
    
    return true;
  }

  public function getErrorMessage() {
    return _t('is not an number');
  }

}

?>
