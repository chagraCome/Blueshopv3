<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Backup_Upload_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_FileInput_Control $backupfileInput */
  public $backupfileInput;
  public $submitButton;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->setMultipart(true);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->backupfileInput = new Amhsoft_FileInput_Control('backup_file', _t('Select Backup to upload'));
    $this->backupfileInput->Required = true;
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Upload'));
    $this->submitButton->Class = 'ButtonSave';
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->backupfileInput);
    $this->addComponent($generalPanel);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Action'));
    $navigationPanel->addComponent($this->submitButton);
    $this->addComponent($navigationPanel);
  }

  /**
   * Send Form
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
