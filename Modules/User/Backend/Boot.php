<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_User_Backend_Boot extends Amhsoft_System_Module_Abstract {

  public function __construct() {
    Amhsoft_System_Boot_Event_Handler::attach($this, 'boot');
  }

  /**
   * Boot event
   * @param Amhsoft_System $system
   */
  public function onBoot(Amhsoft_System $system) {
    $auth = Amhsoft_Authentication::getInstance();
    if ($auth->isAuthenticated()) {
      $system->getView()->assign('loggedusername', $auth->getIdentity());
      $system->getView()->assign('lastlogindate', Amhsoft_Locale::DateTime($auth->getObject()->lastLoginDate));
      $system->getView()->assign('lastloginhost', $auth->getObject()->lastLoginHost);
      $system->getView()->assign('loggeduserfullname', $auth->getObject()->getFullName());
    } else {
      $nologinControllers = array(
	  'User_Backend_User_Login_Controller',
	  'User_Backend_User_Logout_Controller',
	  'User_Backend_User_Forgotpassword_Controller',
	  'User_Backend_User_Resetpassword_Controller');
      $nologinControllersIni = (array) Amhsoft_System_Config::getProperty('nologin_controller');
      $nologinControllers = array_merge($nologinControllers, $nologinControllersIni);
      $nologinControllers = array_unique($nologinControllers);
      if (!in_array($system->getRooter()->getRoot(), $nologinControllers)) {
	Amhsoft_Navigator::go('admin.php?module=user&page=user-login');
      }
    }
    $system->publishModel('User_User_Model', 'System User');
  }

  /**
   * run RBAC
   * @param Amhsoft_System $system
   * @return type
   */
  private function runRbac(Amhsoft_System $system) {
    $auth = Amhsoft_Authentication::getInstance();
    if ($system->getRooter()->getRoot() != 'User_Backend_User_Login_Controller') {
      if (!$auth->isAuthenticated()) {
	return;
      } else {
	if (Amhsoft_System_Config::getProperty('rabac.nochecks.for.admin', 0) && $auth->getObject()->admin) {
	  return;
	}
	$roleId = 0;
	if ($auth->getObject() && isset($auth->getObject()->role_id)) {
	  $roleId = $auth->getObject()->role_id;
	}
	if ($roleId <= 0) {
	  return;
	}
	$rbacaUser = new Amhsoft_RBAC_User($roleId);
	$myCustomRole = new Amhsoft_RBAC_Role();
	$myCustomRole->addPrivilege(new Amhsoft_RBAC_Privilege('Default_Notfound_Controller'));
	$myCustomRole->addPrivilege(new Amhsoft_RBAC_Privilege('Default_Permission_Controller'));
	$rbacaUser->addRole($myCustomRole);
	$rbacaUser->initRbac();
	//TODO @cherif use $system->getRooter()->getChannel() instate of getRoot()
	if (!$rbacaUser->hasPermission($system->getRooter()->getRoot())) {
	  Amhsoft_Navigator::go('admin.php?module=default&page=nopermission');
	}
      }
    }
  }

  /**
   * Menu Container
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $administration = $system->getMenuContainer()->findMenuByName('User');
    $administration->setLabel(_t("Administration"));
    $administration
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Roles"), "admin.php?module=user&page=role-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Users"), "admin.php?module=user&page=user-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add new User"), "admin.php?module=user&page=user-add"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Groups"), "admin.php?module=user&page=group-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Departments"), "admin.php?module=user&page=department-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Change Password"), "admin.php?module=user&page=user-changepassword"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("My Profile"), "admin.php?module=user&page=user-profile"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Setup Dashboard"), "admin.php?module=default&page=portlet-list"));
  }

  /**
   * Translation
   * @param Amhsoft_System $system
   */
  public function initTranslation(Amhsoft_System $system) {
    if ($system->getCurrentLang() == 'ar') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/User/I18N/ar.po');
      $system->appendToTranslation($arabic->getDataAsArray());
    }
    if ($system->getCurrentLang() == 'de') {
      $transConfig = new Amhsoft_Config_Po_Adapter(dirname(__FILE__) . '/Lang/de.po');
      $system->appendToTranslation($transConfig->getConfiguration());
    }
    if ($system->getCurrentLang() == 'fr') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/User/I18N/fr.po');
      $system->appendToTranslation($arabic->getDataAsArray());
    }
  }

  /**
   * Rbac Rules.
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User', _t('User Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Setting_Controller', _t('Manage Users Settings'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Profile_Controller', _t('Show Profile'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Group_List_Controller', _t('List all Groups'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Group_Add_Controller', _t('Add new Group'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Group_Detail_Controller', _t('Show Group Information'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Group_Modify_Controller', _t('Modify Group'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Group_Delete_Controller', _t('Delete Group'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Privilege_Modify_Controller', _t('Modify Users Privileges'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_List_Controller', _t('List Roles'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_Add_Controller', _t('Add new Role'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_Modify_Controller', _t('Modify Role'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_Delete_Controller', _t('Delete Role'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_Online_Controller', _t('Set Role Online'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_Role_Offline_Controller', _t('Set Role Offline'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_User_List_Controller', _t('List Users'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_User_Add_Controller', _t('Add new User'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_User_Modify_Controller', _t('Modify User'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_User_Delete_Controller', _t('Delete User'), 'User'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('User_Backend_User_Quicklist_Controller', _t('Show Users Quicklist'), 'User'));
  }

  /**
   * Observer system and run rbac
   * @param string $eventName
   * @param Amhsoft_System $system
   */
  public function receive($eventName, Amhsoft_System $system) {
    if ($eventName == 'boot') {
      $this->runRbac($system);
    }
  }

  /**
   * Install instructions
   * @param Amhsoft_System $system
   * @return boolean
   */
  public function onInstall(Amhsoft_System $system) {
    $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
    try {
      $this->executeSQLFile($file);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
  
   /**
     * Folder to backup
     * @return type
     */
    public function getFolderToBackup() {
        return array('media/user/picture');
    }

  /**
   * Table to backup
   * 
   */
  public function getTablesToBackup() {
    return array(
	'user',
	'user_group',
	'user_group_has_user',
	'rbac_privilege',
	'rbac_role',
	'rbac_role_lang',
	'department',
    );
  }
  
  public static function whoIsOnline(){
    $stmt = Amhsoft_Database::getInstance()->query("SELECT session_value from session WHERE session_key = 'Backend.logged_user_idententity'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usernames = array();
    foreach($result as $item){
      $usernames[] = $item['session_value'];
    }
          
    return $usernames;
  }

}

?>
