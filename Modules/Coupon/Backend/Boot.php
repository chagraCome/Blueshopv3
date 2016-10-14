<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Revision: 362 $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 16:23:21
 * @encoding   UTF-8
 */
// imports

class Modules_Coupon_Backend_Boot extends Amhsoft_System_Module_Abstract {

  public function onInitMenuContainer(Amhsoft_System $system) {
  
      $system->publishModel('Coupon_Code_Model', 'Coupon');
    
      $admin = $system->getMenuContainer()->findMenuByName("Coupon");
      $admin->setLabel(_t("Coupon"));
      $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Coupons"), "admin.php?module=coupon&page=list"))
              ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Statistics"), "admin.php?module=coupon&page=statistics"))
              ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Settings"), "admin.php?module=coupon&page=setting"));
  }
 public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon', _t('Coupon Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_List_Controller', _t('List all Coupon'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Add_Controller', _t('Add new Coupon'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Detail_Controller', _t('Show Coupon Information'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Modify_Controller', _t('Modify Coupon'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Delete_Controller', _t('Delete Coupon'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Offline_Controller', _t('Set Coupon Offline'), 'Coupon'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Coupon_Backend_Online_Controller', _t('Set Coupon Online'), 'Coupon'));
  }

  public function initTranslation(Amhsoft_System $system) {
    if ($system->getCurrentLang() == 'de') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Coupon/I18N/de.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
     if ($system->getCurrentLang() == 'ar') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Coupon/I18N/ar.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
    if ($system->getCurrentLang() == 'fr') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Coupon/I18N/fr.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
  }

  public function onInstall(Amhsoft_System $system) {
    $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
    try {
      $this->executeSQLFile($file);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
  
    
     public function onUpdate(Amhsoft_System $system, $installedVersion) {
    if (version_compare('1.0', $installedVersion, ">")) {
      $file = dirname(dirname(__FILE__)) . '/Install/update_1.1.sql';
      $this->executeSQLFile($file);
    }
    if (version_compare('1.2', $installedVersion, ">")) {
      $file = dirname(dirname(__FILE__)) . '/Install/update_1.2.sql';
      $this->executeSQLFile($file);
    }
    
    
    
  }

  public function getFolderToBackup() {
    return array('media/coupon');
  }

  public function getTablesToBackup() {
    return array(
        'coupon',
        'coupon_code',
        'coupon_code_has_account',
        'coupon_code_has_saleorder',
        'coupon_code_state',
        'coupon_code_state_lang',
        'coupon_type',
        'coupon_type_lang',
	'coupon_account',
	'coupon_contact',
    );
  }
  public function onBoot(Amhsoft_System $system) {
     $system->publishForImport('Coupon_Import_Code_Model', 'Code Coupon');
  }

}
