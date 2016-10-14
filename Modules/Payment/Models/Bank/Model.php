<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Bank_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;

  public function __toString() {
    return $this->name;
  }

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return Crm_Account_Source_Model
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets name.
   * @return 
   * */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name.
   * @param  name 
   * @return Crm_Account_Source_Model
   * */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

}

?>
