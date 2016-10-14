<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Local.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Backup_Backend_Local_Controller extends Amhsoft_System_Web_Controller {

  public $backupForm;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->backupForm = new Backup_Local_Form('local_backup', 'POST');
    $this->getView()->setMessage(_t('Generate Local Backup'));
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->backupForm->isSend()) {
      if ($this->backupForm->isFormValid()) {
	$data = $this->backupForm->getValues();
	$modules = $data['modules[]'];
	$filename = $data['name'];
	$type = $data['backup_type'];
	$backupdatabase = ($type == 'backup_all' || $type == 'backup_database_only') ? true : false;
	$backupdata = ($type == 'backup_all' || $type == 'backup_media_only') ? true : false;
	try {
	  $backupManager = new Amhsoft_System_Backup_Manager(new Amhsoft_System_Backup_Xml_Handler());
	  foreach ($modules as $module) {
	    $backupManager->addModule($module);
	  }
	  $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
	  $backuppath = $backupConfiguration->getValue('backup_local_path');
	  $backupManager->backup(rtrim($backuppath, '/') . '/' . $filename, $backupdatabase, $backupdata);
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
