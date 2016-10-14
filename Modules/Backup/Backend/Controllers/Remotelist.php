<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Remotelist.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Backup_Backend_Remotelist_Controller extends Amhsoft_System_Web_Controller {

  /** @var Backup_DataGridView $backupDataGridView */
  protected $backupDataGridView;
  public $backupConfiguration;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->backupDataGridView = new Backup_Remote_DataGridView();
    $this->backupDataGridView->Sortable = false;
    $this->backupDataGridView->Searchable = false;
    $this->backupDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Backups'), View_Message_Type::INFO);
    $this->backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
  }

  /**
   * Default Event
   */
  public function __default() {
    $backups = array();
    $backupPath = $this->backupConfiguration->getValue('backup_local_path', 'backups');
    $allFiles = array();
    try {
      $ftpClient = new Amhsoft_Ftp_Client();
      $host = $this->backupConfiguration->getValue('last_ftp_host');
      $user = $this->backupConfiguration->getValue('last_ftp_username');
      $pass = Amhsoft_Common::decrypt($this->backupConfiguration->getValue('last_ftp_password'), 'SkXWLd!?45#*/]dWAqpIIqAwx');
      $dir = $this->backupConfiguration->getValue('last_ftp_path');
      $ftpClient->login($host, $user, $pass);
      if ($ftpClient->isConnected()) {
	$ftpClient->changeDir($dir);
	$allFiles = $ftpClient->listDetailed();
      }
    } catch (Exception $e) {
      $this->getView()->setMessage(_t($e->getMessage()), View_Message_Type::ERROR);
    }
    foreach ($allFiles as $key => $file) {
      $filename = $key;
      $filesize = $file['size'];
      $filesize = Amhsoft_Common::convertToByteUnit($filesize);
      $dateTime = $file['time'] . '-' . $file['month'] . '-' . $file['day'];
      $backups[] = array("name" => $filename, "filesize" => $filesize, 'insertat' => date("Y-m-d H:i:s", strtotime($dateTime)));
    }
    $this->backupDataGridView->DataSource = new Amhsoft_Data_Set($backups);
  }

  /**
   * Restore Backup Event
   */
  public function __restore() {
    $name = $this->getRequest()->get('name');
    if ($name) {
      $backupPath = $this->backupConfiguration->getValue('backup_local_path', 'backups');
      try {
	$ftpClient = new Amhsoft_Ftp_Client();
	$host = $this->backupConfiguration->getValue('last_ftp_host');
	$user = $this->backupConfiguration->getValue('last_ftp_username');
	$pass = Amhsoft_Common::decrypt($this->backupConfiguration->getValue('last_ftp_password'), 'SkXWLd!?45#*/]dWAqpIIqAwx');
	$dir = $this->backupConfiguration->getValue('last_ftp_path');
	$ftpClient->login($host, $user, $pass);
	if ($ftpClient->isConnected()) {
	  $ftpClient->changeDir($dir);
	  $ftpClient->downloadfile(rtrim($backupPath, '/') . '/' . $name, $name, FTP_BINARY);
	  $this->getRedirector()->go('admin.php?module=backup&page=restore&name=' . $name);
	}
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Download Event
   */
  public function __download() {
    $name = $this->getRequest()->get('name');
    if ($name) {
      $backupPath = $this->backupConfiguration->getValue('backup_local_path', 'backups');
      try {
	$ftpClient = new Amhsoft_Ftp_Client();
	$host = $this->backupConfiguration->getValue('last_ftp_host');
	$user = $this->backupConfiguration->getValue('last_ftp_username');
	$pass = Amhsoft_Common::decrypt($this->backupConfiguration->getValue('last_ftp_password'), 'SkXWLd!?45#*/]dWAqpIIqAwx');
	$dir = $this->backupConfiguration->getValue('last_ftp_path');
	$ftpClient->login($host, $user, $pass);
	if ($ftpClient->isConnected()) {
	  $ftpClient->changeDir($dir);
	  $ftpClient->downloadfile(rtrim($backupPath, '/') . '/' . $name, $name);
	  $this->getRedirector()->go('?module=backup&page=download&name=' . $name);
	}
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Delete Event
   */
  public function __delete() {
    $name = $this->getRequest()->get('name');
    if ($name) {
      try {
	$ftpClient = new Amhsoft_Ftp_Client();
	$host = $this->backupConfiguration->getValue('last_ftp_host');
	$user = $this->backupConfiguration->getValue('last_ftp_username');
	$pass = Amhsoft_Common::decrypt($this->backupConfiguration->getValue('last_ftp_password'), 'SkXWLd!?45#*/]dWAqpIIqAwx');
	$dir = $this->backupConfiguration->getValue('last_ftp_path');
	$ftpClient->login($host, $user, $pass);
	if ($ftpClient->isConnected()) {
	  $ftpClient->changeDir($dir);
	  $ftpClient->deleteFile($name);
	  $this->getRedirector()->go('?module=backup&page=remotelist&ret=true');
	}
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('grid', $this->backupDataGridView);
    $this->show();
  }

}

?>
