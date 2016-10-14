<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Installer
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created
 */
class Modules_Installer_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * On Module Boot
   * @param Amhsoft_System $system
   */
  public function onBoot(Amhsoft_System $system) {
    
  }

  /**
   * Initialize Menu Container
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $settingsMenu = $system->getMenuContainer()->findMenuByName("Setting");
    $settingsMenu
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Module Management"), "admin.php?module=installer&page=list"));
  }

  /**
   * Initialize RBAC
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Installer', _t('Installer Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Installer_Backend_List_Controller', _t('List Modules'), 'Installer'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Installer_Backend_Details_Controller', _t('Show Module Information'), 'Installer'));
  }

  /**
   * On Module Install 
   * @param Amhsoft_System $system
   * @return boolean
   */
  public function onInstall(Amhsoft_System $system) {

    return true;
  }

  /**
   * On Module Update
   * @param Amhsoft_System $system
   * @param type $installedVersion
   * @return boolean
   */
  public function onUpdate(Amhsoft_System $system, $installedVersion) {
    return true;
  }

}

