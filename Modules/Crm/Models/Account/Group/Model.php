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
class Crm_Account_Group_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $alias;
  public $accounts = array();
  public $as_default;

  /**
   * Sets AccountGroup id.
   * @param integer $id
   * @return AccountGroupModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets AccountGroup id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets AccountGroup name.
   * @param String $name
   * @return AccountGroupModel
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets AccountGroup name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets AccountGroup alias.
   * @param String $alias
   * @return AccountGroupModel
   */
  public function setAlias($alias) {
    $this->alias = $alias;
    return $this;
  }

  /**
   * Gets AccountGroup alias.
   * @return String $alias
   */
  public function getAlias() {
    return $this->alias;
  }

  public function __toString() {
    return $this->getName();
  }

  public function getAccounts() {
    return $this->accounts;
  }

  public function addAccount(Crm_Account_Model $account) {
    $this->accounts[] = $account;
  }

  public function setAccounts(array $accounts) {
    $this->accounts = array();
    foreach ($accounts as $account) {
      $this->addAccount($account);
    }
  }

  public function getAsDefault() {
    return $this->as_default;
  }

  public function setAsDefault($as_default) {
    $this->as_default = $as_default;
  }

  /**
   * Gets Default Accounts Group.
   * @return Crm_Group_Model|null
   */
  public static function getDefault() {
    $adapter = new Crm_Group_Model_Adapter();
    $adapter->where('as_default = ?', 1);
    $model = $adapter->fetch()->fetch();
    if ($model instanceof Crm_Group_Model) {
      return $model;
    } else {
      return null;
    }
  }

}

?>
