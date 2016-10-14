<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Shipping_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * Create Menu Containet.
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $admin = $system->getMenuContainer()->findMenuByName("Shipping");
    $admin->setLabel(_t("Shipping"));
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("List Shipping Methods"), "admin.php?module=shipping&page=shipping-list"));
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Shipping Method"), "admin.php?module=shipping&page=shipping-add"));
  }

  /**
   * Init RBAC Rules.
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping', _t('Shipping Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_List_Controller', _t('List Shippings Methods'), 'Shipping'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_Add_Controller', _t('Add new Shipping Method'), 'Shipping'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_Modify_Controller', _t('Modify Shipping Method'), 'Shipping'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_Delete_Controller', _t('Delete Shipping Method'), 'Shipping'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_Offline_Controller', _t('Set Shipping Method Offline'), 'Shipping'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Shipping_Backend_Shipping_Online_Controller', _t('Set Shipping Method Online'), 'Shipping'));
  }

  /**
   * Module Install.
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
   * Update Module
   * @param Amhsoft_System $system
   * @param type $installedVersion
   * @return boolean
   */
  public function onUpdate(Amhsoft_System $system, $installedVersion) {
    if (version_compare('1.8.0', $installedVersion, '>')) {
      try {
	$this->executeSQLFile(dirname(dirname(__FILE__)) . '/Install/product_shipping.sql');
	return true;
      } catch (Exception $ex) {
	return false;
      }
    }
  }

  /**
   * Folder To Backup
   * @return type
   */
  public function getFolderToBackup() {
    return array('media/shipping');
  }

  /**
   * Table To Backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'shipping',
	'shipping_has_country',
	'shipping_lang',
	'shipping_type',
	'shipping_type_lang',
	'product_has_shipping',
    );
  }

}

?>
