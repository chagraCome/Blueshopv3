<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Role_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $state;

  /** @var User_Role_Model * */
  public $parent;

  /**
   * Sets id.
   * @return void
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets id
   * @param type $id
   * @return User_Role_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Sets name.
   * @return string name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets Role name.
   * @param string $name
   * @return User_Role_Model
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Sets parent.
   * @param User_Role_Model $parent
   * @return User_Role_Model
   */
  public function setParent(User_Role_Model $parent) {
    $this->parent = $parent;
    return $this;
  }

  /*   * *
   * Gets Role state.
   * @return Integer state
   */

  public function getState() {
    return $this->state;
  }

  /**
   * Sets Role state.
   * @param Integer $state
   * @return User_Role_Model
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets parent.
   * @return User_Role_Model parent
   */
  public function getParent() {
    return $this->parent;
  }

  public function hasChidrens() {
    $userRoleModelAdapter = new User_Role_Model_Adapter();
    $userRoleModelAdapter->where('parent_id = ?', $this->getId());
    return $userRoleModelAdapter->getCount() > 0;
  }

  /**
   * Gets Role Childrens
   * @return type
   */
  public function getChildrens() {
    $userRoleModelAdapter = new User_Role_Model_Adapter();
    $userRoleModelAdapter->where('parent_id = ?', $this->getId());
    return $userRoleModelAdapter->fetch();
  }

  public function __toString() {
    return $this->name;
  }

}

?>
