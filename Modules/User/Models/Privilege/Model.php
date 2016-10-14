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
class User_Privilege_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $role_id;

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   * @return User_Privilege_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Name
   * @return type
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name
   * @param type $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Gets Role Id
   * @return type
   */
  public function getRoleId() {
    return $this->role_id;
  }

  /**
   * Set Role Id
   * @param type $role_id
   */
  public function setRoleId($role_id) {
    $this->role_id = $role_id;
  }

}

?>
