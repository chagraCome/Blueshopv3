<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cashu
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Modules_Cashu_Backend_Boot extends Amhsoft_System_Module_Abstract {
  /*
   * Initialize Menu Container
   */

  public function onInitMenuContainer(Amhsoft_System $system) {
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Payment')) {
      $admin = $system->getMenuContainer()->findMenuByName('Payment');
      $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Cashu Settings"), "admin.php?module=cashu&page=settings"));
    }
  }

  /**
   * On Module Install
   * @param Amhsoft_System $system
   * @return boolean
   */
  public function onInstall(Amhsoft_System $system) {
    $paymentMethodAdapter = new Payment_Payment_Model_Adapter();
    $paymentMethod = new Payment_Payment_Model();
    $paymentMethod->setName('Cashu');
    $paymentMethod->setDescription("Cashu Payement Method");
    $paymentMethod->setModulename('Cashu');
    $paymentMethod->setOnline(0);
    $paymentMethodAdapter->save($paymentMethod);
    return true;
  }

  /**
   * Init RBAC Rules.
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cashu', _t('Cashu Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cashu_Backend_Settings_Controller', _t('Manage Cashu Settings'), 'Cashu'));
  }

  /**
   * After Module Install
   * @param Amhsoft_System $system
   */
  public function afterInstall(Amhsoft_System $system) {
    Amhsoft_Navigator::go('admin.php?module=cashu&page=settings');
  }

}

?>
