<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payfort
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Modules_Payfort_Backend_Boot extends Amhsoft_System_Module_Abstract {

  public function onInitMenuContainer(Amhsoft_System $system) {
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Payment')) {
      $admin = $system->getMenuContainer()->findMenuByName("Payment");
      $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Payfort Settings"), "admin.php?module=payfort&page=settings"));
    }
  }

  public function onInstall(Amhsoft_System $system) {
    $paymentMethodAdapter = new Payment_Payment_Model_Adapter();

    $paymentMethod = new Payment_Payment_Model();
    $paymentMethod->setName('Payfort');
    $paymentMethod->setDescription("Payfort Payement Method");
    $paymentMethod->setModulename('Payfort');
    $paymentMethod->setOnline(0);
    $paymentMethodAdapter->save($paymentMethod);
    return true;
  }

  public function afterInstall(Amhsoft_System $system) {
    Amhsoft_Navigator::go('admin.php?module=payfort&page=settings');
  }

  public function onBoot(Amhsoft_System $system) {
    
  }

}

?>
