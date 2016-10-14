<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Download.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Backup_Backend_Download_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $name = $this->getRequest()->get('name');
    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
    $backupPath = $backupConfiguration->getValue('backup_local_path', 'backups');
    if (file_exists(rtrim($backupPath, '/') . '/' . $name)) {
      Amhsoft_Common::force_download($name, file_get_contents(rtrim($backupPath, '/') . '/' . $name));
    } else {
      $this->getRedirector()->go('?module=backup&page=list&ret=false');
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    
  }

}

?>
