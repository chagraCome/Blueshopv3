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
class User_Group_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $alias;
  public $users = array();

  /**
   * Sets UserGroup id.
   * @param integer $id
   * @return UserGroupModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets UserGroup id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets UserGroup name.
   * @param String $name
   * @return UserGroupModel
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets UserGroup name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets UserGroup alias.
   * @param String $alias
   * @return UserGroupModel
   */
  public function setAlias($alias) {
    $this->alias = $alias;
    return $this;
  }

  /**
   * Gets UserGroup alias.
   * @return String $alias
   */
  public function getAlias() {
    return $this->alias;
  }

  /**
   * 
   * @return type
   */
  public function __toString() {
    return $this->getName();
  }

  /**
   * Gets User
   * @return type
   */
  public function getUsers() {
    return $this->users;
  }

  /**
   * Add User
   * @param User_User_Model $user
   */
  public function addUser(User_User_Model $user) {
    $this->users[] = $user;
  }

  /**
   * Set User
   * @param array $users
   */
  public function setUsers(array $users) {
    $this->users = array();
    foreach ($users as $user) {
      $this->addUser($user);
    }
  }

}

?>
