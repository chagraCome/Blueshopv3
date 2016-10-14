<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Remote.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Backup_Backend_Remote_Controller extends Amhsoft_System_Web_Controller {

  public $backupForm;
  public $backupConfiguration;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->backupForm = new Backup_Remote_Form('remote_backup', 'POST');
    $this->getView()->setMessage(_t('Generate Remote Backup'));
    $this->backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
  }

  /**
   * Default Event
   * @return type
   */
  public function __default() {
    if ($this->backupForm->isSend()) {
      if ($this->backupForm->isFormValid()) {
	$data = $this->backupForm->getValues();
	$modules = $data['modules[]'];
	$filename = $data['name'];
	$ftpHost = $data['hostname'];
	$ftpUser = $data['username'];
	$ftpPassword = $data['password'];
	$ftpPort = $data['port'];
	$ftpPath = $data['path'];
	$ftpClient = new Amhsoft_Ftp_Client();
	try {
	  $ftpClient->login($ftpHost, $ftpUser, $ftpPassword, $ftpPort);
	  if ($ftpClient->isConnected()) {
	    $this->getView()->setMessage(_t('Logged to FTP Server Successfully'), View_Message_Type::SUCCESS);
	    $ftpClient->changeDir($ftpPath);
	    $type = $data['backup_type'];
	    $backupdatabase = ($type == 'backup_all' || $type == 'backup_database_only') ? true : false;
	    $backupdata = ($type == 'backup_all' || $type == 'backup_media_only') ? true : false;
	    $backupManager = new Amhsoft_System_Backup_Manager(new Amhsoft_System_Backup_Xml_Handler());
	    foreach ($modules as $module) {
	      $backupManager->addModule($module);
	    }
	    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
	    $backuppath = $backupConfiguration->getValue('backup_local_path');
	    $backupManager->backup(rtrim($backuppath, '/') . '/' . $filename, $backupdatabase, $backupdata);
	    $this->getView()->setMessage(_t('Backup was successully done!'), View_Message_Type::SUCCESS);
	    $ftpClient->upload(rtrim($backuppath, '/') . '/' . $filename, $filename, FTP_BINARY);
	    $this->backupConfiguration->setValue('last_ftp_host', $ftpHost);
	    $this->backupConfiguration->setValue('last_ftp_username', $ftpUser);
	    $this->backupConfiguration->setValue('last_ftp_password', Amhsoft_Common::encrypt($ftpPassword, 'SkXWLd!?45#*/]dWAqpIIqAwx'));
	    $this->backupConfiguration->setValue('last_ftp_port', $ftpPort);
	    $this->backupConfiguration->setValue('last_ftp_path', $ftpPath);
	  } else {
	    $this->getView()->setMessage(_t('Cannot connect to ftp host'), View_Message_Type::ERROR);
	  }
	} catch (Exception $e) {
	  $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
	  return;
	}
      } else {
	$this->getView()->setMessage(_t('Please Verify Input'), View_Message_Type::ERROR);
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
