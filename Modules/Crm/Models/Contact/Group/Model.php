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
class Crm_Contact_Group_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $alias;

  /**
   * Gets Crm_ Contact_Groupid.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Crm_ Contact_Groupid.
   * @param Integer $id
   * @return Crm_ Contact_Group_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Crm_ Contact_Groupname.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets Crm_ Contact_Groupname.
   * @param String $name
   * @return Crm_ Contact_Group_Model
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets Crm_ Contact_Groupalias.
   * @return String $alias
   */
  public function getAlias() {
    return $this->alias;
  }

  /**
   * Sets Crm_ Contact_Groupalias.
   * @param String $alias
   * @return Crm_ Contact_Group_Model
   */
  public function setAlias($alias) {
    $this->alias = $alias;
    return $this;
  }

  public function __toString() {
    return $this->getName();
  }

}

?>
