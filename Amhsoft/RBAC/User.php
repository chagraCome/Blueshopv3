<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: User.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_RBAC_User {

  private $roleId;
  private $roles = array();

  public function __construct($roleId = null) {
    $this->roleId = $roleId;
  }

  public function initRbac() {
    if (!Amhsoft_System_Config::getProperty('rbac.enabled', false)) {
      return;
    }

    if ($this->roleId < 1) {
      throw new Amhsoft_RBAC_Exception();
    }

    $role = new Amhsoft_RBAC_Role('current');

    $default_allowed_rules = Amhsoft_System_Config::getProperty('rbac.privilege.allowtoall', array());

    foreach ($default_allowed_rules as $r) {
      $role->addPrivilege(new Amhsoft_RBAC_Privilege($r));
    }

    $rabc_privielege_table = Amhsoft_System_Config::getProperty('rbac.privilege.table', 'rbac_privilege');
    $rabc_privielege_name = Amhsoft_System_Config::getProperty('rbac.privilege.table.name', 'name');

    $sql = "SELECT $rabc_privielege_name FROM $rabc_privielege_table WHERE role_id = :role_id";
    $stmt = Amhsoft_Database::getInstance()->prepare($sql);
    $stmt->bindParam(':role_id', $this->roleId);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $key => $val) {
      $role->addPrivilege(new Amhsoft_RBAC_Privilege($val['name']));
    }
    $this->addRole($role);
  }

  public function addRole(Amhsoft_RBAC_Role $role) {
    $this->roles[] = $role;
    return $this;
  }

  public function setRoles(array $roles) {
    $this->roles = array();
    foreach ($roles as $role) {
      if ($role instanceof Amhsoft_RBAC_Role) {
        $this->addRole($role);
      }
      if (is_string($role)) {
        $_role = new Amhsoft_Acl_Role();
        $_role->setName($role);
        $this->addRole($_role);
      }
    }
  }

  public function getRoles() {
    return $this->roles;
  }

  public function deny($task) {
    foreach ($this->getRoles() as $role) {
      $role->deny($task);
    }
  }

  public static function isModulePresent($name, $roleid) {
    if (!$name || $roleid <= 0) {
      return true;
    }
    $rabc_privielege_table = Amhsoft_System_Config::getProperty('rbac.privilege.table', 'rbac_privilege');
    $rabc_privielege_name = Amhsoft_System_Config::getProperty('rbac.privilege.table.name', 'name');

    $sql = "SELECT $rabc_privielege_name FROM $rabc_privielege_table WHERE $rabc_privielege_name LIKE '$name%' AND role_id = :role_id";
    $stmt = Amhsoft_Database::getInstance()->prepare($sql);
    $stmt->bindParam(':role_id', $roleid);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  public function hasPermission($task) {

    if (!Amhsoft_System_Config::getProperty('rbac.enabled', 0)) {
      return true;
    }
    if (Amhsoft_System::getLevel() == 'Dealer') {
      $task = str_replace('Dealer', 'Backend', $task);
    }
    foreach ($this->getRoles() as $role) {

      if ($role->hasPermission($task)) {
        return true;
      }
    }
    return false;
  }

}

?>
