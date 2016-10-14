<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 449 2016-02-23 08:14:06Z imen.amhsoft $
 * $Rev: 449 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Backup_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

  protected $mainPanel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Backup Settings'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->getSetupForm();
  }

  /**
   * Setup Setting Form
   */
  protected function getSetupForm() {
    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
    $panel = new Amhsoft_Widget_Panel(_t('Backup Settings'));
    $form = new Amhsoft_Widget_Form('setup_form', 'POST');
    $backupLocalPath = new Amhsoft_Input_Control('backup_local_path', _t('Backup Local Path'));
    $backupLocalPath->Value = 'backups';
    $backupLocalPath->DataBinding = new Amhsoft_Data_Binding('backup_local_path', null, null, $backupConfiguration->getValue('backup_local_path'));
    $panel->addComponent($backupLocalPath);
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $submitButton->setClass('Button Save');
    $nav = new Amhsoft_Widget_Panel(_t('Navigation'));
    
    $nav->addComponent($submitButton);
    $form->addComponent($panel);
    $form->addComponent($nav);
    $this->mainPanel->addComponent($form);
    //$this->mainPanel->addComponent($nav);
    if ($this->getRequest()->isPost('submit')) {
      $form->DataSource = Amhsoft_Data_Source::Post();
      $form->Bind();
      $values = $form->getValues();
      $backupConfiguration->setValue('backup_local_path', $values['backup_local_path']);
      $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
    }
    $form->DataSource = new Amhsoft_Data_Set($backupConfiguration->getConfiguration());
    $form->Bind();
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show();
  }

}

?>
