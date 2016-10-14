<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Installer
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created
 */
class Installer_Backend_List_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Modules Management'), View_Message_Type::INFO);
  }

  /**
   * Update Module Event
   * @global type $system
   */
  public function __update() {
    $module = trim($this->getRequest()->get("package"));
    try {
      global $system;
      Amhsoft_System_Module_Manager::updateModule($module, $system);
      $this->getView()->setMessage(_t('Module was updated successfully.'), View_Message_Type::SUCCESS);
      sleep(1);
      $this->getRedirector()->go('admin.php?module=installer&page=list&ret=true');
    } catch (Exception $e) {
      $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
    }
  }

  /**
   * Install Modele Event
   * @global type $system
   */
  public function __install() {
    $module = trim($this->getRequest()->get("package"));
    global $system;
    try {
      Amhsoft_System_Module_Manager::installModule($module, $system);
      $this->getView()->setMessage(_t('Module was updated successfully.'), View_Message_Type::SUCCESS);
      sleep(1);
      $this->getRedirector()->go('admin.php?module=installer&page=list&ret=true');
    } catch (Exception $e) {
      $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $modules = Amhsoft_System_Module_Manager::getAvailableModules();
    $installed_modules = Amhsoft_System_Module_Manager::getInstalledModules();
    $new_modules = Amhsoft_System_Module_Manager::compare($modules, $installed_modules);
    $this->getView()->assign("data", $new_modules);
    $this->show();
  }

}

?>
