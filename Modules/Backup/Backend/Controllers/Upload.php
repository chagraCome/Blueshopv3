<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Upload.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Backup_Backend_Upload_Controller extends Amhsoft_System_Web_Controller {

  public $backupForm;

  /**
   * Initialize Controllor
   */
  public function __initialize() {
    $this->backupForm = new Backup_Upload_Form('upload_backup', 'POST');
    $this->getView()->setMessage(_t('Upload Backup'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->backupForm->isSend()) {
      if ($this->backupForm->isValid()) {
	try {
	  $filename = $this->backupForm->backupfileInput->Value['name'];
	  $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
	  $backupath = $backupConfiguration->getValue('backup_local_path');
	  $this->backupForm->backupfileInput->uploadTo(rtrim($backupath, '/') . '/' . $filename);
	  $this->getRedirector()->go('?module=backup&page=restore&name=' . $filename);
	} catch (Exception $e) {
	  $this->getView()->setMessage($e->getMessage());
	}
      } else {
	$this->getView()->setMessage(_t('Please check inputs'), View_Message_Type::ERROR);
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