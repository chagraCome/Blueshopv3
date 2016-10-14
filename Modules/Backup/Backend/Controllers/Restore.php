<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Restore.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Backup_Backend_Restore_Controller extends Amhsoft_System_Web_Controller {

  public $backupForm;
  public $backupName;
  public $backupPath;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->backupName = $this->getRequest()->get('name');
    if (!$this->backupName) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
    $this->backupPath = rtrim($backupConfiguration->getValue('backup_local_path', 'backups'), '/');
    if (!file_exists($this->backupPath . '/' . $this->backupName)) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->backupForm = new Backup_Restore_Form('restore_backup', 'POST');
    $this->getView()->setMessage(_t('Restore Backup'));
  }

  /**
   * Default Event
   * @return type
   */
  public function __default() {
    $backupManager = new Amhsoft_System_Backup_Manager(new Amhsoft_System_Backup_Xml_Handler());
    $handler = $backupManager->getHandler($this->backupPath . '/' . $this->backupName);
    if (!$handler instanceof Amhsoft_System_Backup_Abstract_Handler) {
      $this->getView()->setMessage(_t('Zip Archive is not valid backup'), View_Message_Type::ERROR);
      return;
    }
    $modules = $handler->getModuleNames();
    $this->backupForm->modulesListBox->DataSource = new Amhsoft_Data_Set($modules);
    if ($this->backupForm->isSend()) {
      if ($this->backupForm->isFormValid()) {
	$data = $this->backupForm->getValues();
	$modules = $data['modules[]'];
	$restore_type = $data['restore_type'];
	$backupdatabase = ($restore_type == 'restore_all' || $restore_type == 'restore_database_only') ? true : false;
	$backupdata = ($restore_type == 'restore_all' || $restore_type == 'restore_media_only') ? true : false;
	try {
	  $backupManager->restore($this->backupPath . '/' . $this->backupName, $modules, $backupdatabase, $backupdata);
	  $this->getRedirector()->go('?module=backup&page=list&ret=true');
	} catch (Exception $e) {
	  $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
	}
      }
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->backupForm);
    $this->show();
  }

}

?>
