<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Role.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_RBAC_Role {

  private $name;

  /** @var Amhsoft_RBAC_Role $parent * */
  private $parent;

  /** @var Amhsoft_RBAC_Privilege_Collection $privilegeCollection */
  private $privilegeCollection;
  private $removedPrivileges = array();

  public function __construct($name=null) {
    $this->privilegeCollection = new Amhsoft_RBAC_Privilege_Collection();
    if($name){
      $this->name = $name;
    }
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function getParent() {
    return $this->parent;
  }

  public function setParent($parent) {
    $this->parent = $parent;
    return $this;
  }

  public function addPrivilege(Amhsoft_RBAC_Privilege $privilege) {
    $this->privilegeCollection->add($privilege);
  }

  public function removePrivilege(Amhsoft_RBAC_Privilege $privilege) {
    $this->removedPrivileges[] = $privilege->getName();
  }

  public function hasPrivilege(Amhsoft_RBAC_Privilege $privilege) {
    return $this->privilegeCollection->exists($privilege) && !in_array($privilege->getName(), $this->removedPrivileges);
  }

  public function getPrivilegeCollection() {
    return $this->privilegeCollection;
  }

  public function hasPermission($privilege) {
    if (!$privilege instanceof Amhsoft_RBAC_Privilege) {
      $privilege = new Amhsoft_RBAC_Privilege($privilege);
    }
    if ($this->parent instanceof Amhsoft_RBAC_Role) {
      return $this->hasPrivilege($privilege) | $this->parent->hasPermission($privilege);
    } else {
      return $this->hasPrivilege($privilege);
    }
  }

}

?>
