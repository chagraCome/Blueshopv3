<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 449 2016-02-23 08:14:06Z imen.amhsoft $
 * $Rev: 449 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $LastChangedDate: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Backup_Backend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Backup_DataGridView $backupDataGridView */
  protected $backupDataGridView;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->backupDataGridView = new Backup_DataGridView();
    $this->backupDataGridView->Sortable = false;
    $this->backupDataGridView->Searchable = false;
    $this->backupDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Backups'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $backups = array();
    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
    $backupPath = $backupConfiguration->getValue('backup_local_path', 'backups');
    $allFiles = glob("$backupPath/*.zip");
	if ($allFiles != 0 ){
    foreach ($allFiles as $filename) {
      $filesize = filesize($filename);
      $filesize = Amhsoft_Common::convertToByteUnit($filesize);
      $backups[] = array("name" => str_replace($backupPath . '/', '', $filename), "filesize" => $filesize, 'insertat' => date("Y-m-d H:i:s", filemtime($filename)));
    }
	}
    $this->backupDataGridView->DataSource = new Amhsoft_Data_Set($backups);
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
