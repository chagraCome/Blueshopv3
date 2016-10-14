<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Banner
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Banner_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * On Module Boot
   * @param Amhsoft_System $system
   */
  public function onBoot(Amhsoft_System $system) {
    
  }

  /**
   * Create Menu Container.
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $admin = $system->getMenuContainer()->findMenuByName("Banner");
    $admin->setLabel(_t("Banner"));
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("List Banners"), "admin.php?module=banner&page=list"));
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add new Banner"), "admin.php?module=banner&page=add"));
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Banner Setting"), "admin.php?module=banner&page=setting"));
  }

  /**
   * Initialize RBAC
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner', _t('Banner Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner_Backend_List_Controller', _t('List Banners'), 'Banner'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner_Backend_Add_Controller', _t('Add new Banner'), 'Banner'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner_Backend_Modify_Controller', _t('Edit Banner'), 'Banner'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner_Backend_Delete_Controller', _t('Delete Banner'), 'Banner'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Banner_Backend_Setting_Controller', _t('Banner Settings'), 'Banner'));
  }

  /**
   * Translation
   * @param Amhsoft_System $system
   */
  public function initTranslation(Amhsoft_System $system) {
    $filename = 'Modules/Banner/I18N/' . strtolower($system->getCurrentLang()) . '.po';
    if (file_exists($filename)) {
      $arabic = new Amhsoft_Config_Po_Adapter($filename);
      $system->appendToTranslation($arabic->getConfiguration());
    }
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
   * On update Module
   * @param Amhsoft_System $system
   * @param type $installedVersion
   */
  public function onUpdate(Amhsoft_System $system, $installedVersion) {
    if (version_compare('2.0', $installedVersion, '>')) {
      $file = dirname(dirname(__FILE__)) . '/Install/upgrade-2.0.sql';
      $this->executeSQLFile($file);
    }
	}

  /**
   * Folder to Backup
   * @return type
   */
  public function getFolderToBackup() {
    return array('media/banner');
  }

  /**
   * Tables To Backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'banner',
    );
  }

}

?>
