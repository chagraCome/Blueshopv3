<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Modules_Webmail_Backend_Boot extends Amhsoft_System_Module_Abstract {

  public function __construct() {
    
  }

  /**
   * Initialize Menu Container
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $menu = $system->getMenuContainer()->findMenuByName("Setting");

    $menu->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Server Settings"), "admin.php?module=webmail&page=setting-list"));
  }

  /**
   * Initialize RBAC
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail', _t('Webmail Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Email_Add_Controller', _t('Add Email'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Email_Delete_Controller', _t('Delete Email'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Email_List_Controller', _t('List Emails'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Email_Modify_Controller', _t('Modify Email'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Inbox_Email_List_Controller', _t('List Emails Inbox'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Inbox_Email_Read_Controller', _t('Read Emails Inbox'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Setting_Add_Controller', _t('Add Webmail Setting'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Setting_Delete_Controller', _t('Delete Webmail Setting'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Setting_List_Controller', _t('List all Webmail Setting'), 'Webmail'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Webmail_Backend_Setting_Modify_Controller', _t('Modify Webmail Setting'), 'Webmail'));
  }

  /**
   * On Module Install
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
   * On Module Update
   * @param \Amhsoft_System $system
   * @param type $installedVersion
   * @return boolean
   */
  public function onUpdate(\Amhsoft_System $system, $installedVersion) {
    //versions less than 1.0.1
    if (version_compare('1.0.1', $installedVersion)) {
      try {
	Amhsoft_Database::getInstance()->exec('ALTER TABLE  `webmail_server_setting` ADD  `lastupdate` DATETIME NULL');
	return true;
      } catch (Exception $e) {
	return false;
      }
    }
    return true;
  }

  /**
   * Table To Backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'webmail_server_setting',
	'webmail_email',
	'webmail_attchment',
    );
  }

}

?>
