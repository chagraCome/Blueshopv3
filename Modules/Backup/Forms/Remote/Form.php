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
class Backup_Remote_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  public $nameInput;

  /** @var Amhsoft_ListBox_Control $modulesListBox * */
  public $modulesListBox;
  public $backupTypeListBox;
  public $hostnameInput;
  public $usernameInput;
  public $passwordInput;
  public $portInput;
  public $pathInput;
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
    $this->nameInput = new Amhsoft_Input_Control('name', _t('File Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('filename');
    $this->nameInput->setWidth(300);
    $this->nameInput->Required = true;
    $this->nameInput->DefaultValue = Amhsoft_Locale::DateTime(null, 'Y_m_d_H_i_s') . '.zip';
    $this->modulesListBox = new Amhsoft_ListBox_Control('modules[]', _t('Select Modules'));
    $this->modulesListBox->DataBinding = new Amhsoft_Data_Binding('modules', 'name', 'name');
    $this->modulesListBox->setWidth(300);
    $this->modulesListBox->Size = 10;
    $modules = Amhsoft_System_Module_Manager::getInstalledModules();
    $this->modulesListBox->DataSource = new Amhsoft_Data_Set($modules);
    $this->modulesListBox->multiple = true;
    $this->backupTypeListBox = new Amhsoft_ListBox_Control('backup_type', _t('Backup Type'));
    $this->backupTypeListBox->DataBinding = new Amhsoft_Data_Binding('backup_type', 'id', 'name');
    $types = array(
	array('id' => 'backup_all', 'name' => _t('Backup database and media')),
	array('id' => 'backup_media_only', 'name' => _t('Backup media only')),
	array('id' => 'backup_database_only', 'name' => _t('Backup database only')),
    );
    $this->backupTypeListBox->DataSource = new Amhsoft_Data_Set($types);
    $backupConfiguration = new Amhsoft_Config_Table_Adapter('backup');
    $this->hostnameInput = new Amhsoft_Input_Control('hostname', _t('Host Name'));
    $this->hostnameInput->DataBinding = new Amhsoft_Data_Binding('hostname');
    $this->hostnameInput->Required = true;
    $this->hostnameInput->Value = $backupConfiguration->getValue('last_ftp_host');
    $this->usernameInput = new Amhsoft_Input_Control('username', _t('User Name'));
    $this->usernameInput->DataBinding = new Amhsoft_Data_Binding('username');
    $this->usernameInput->Required = true;
    $this->usernameInput->Value = $backupConfiguration->getValue('last_ftp_username');
    $this->passwordInput = new Amhsoft_Password_Control('password', _t('Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->Required = true;
    $this->passwordInput->Value = Amhsoft_Common::decrypt($backupConfiguration->getValue('last_ftp_password'), 'SkXWLd!?45#*/]dWAqpIIqAwx');
    $this->portInput = new Amhsoft_Input_Control('port', _t('Port'));
    $this->portInput->DataBinding = new Amhsoft_Data_Binding('port');
    $this->portInput->Required = true;
    $this->portInput->Value = $backupConfiguration->getValue('last_ftp_port');
    $this->pathInput = new Amhsoft_Input_Control('path', _t('Path'));
    $this->pathInput->DataBinding = new Amhsoft_Data_Binding('path');
    $this->pathInput->Required = true;
    $this->pathInput->Value = $backupConfiguration->getValue('last_ftp_path');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Generate'));
    $this->submitButton->Class = 'ButtonSave';
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->nameInput);
    $generalPanel->addComponent($this->modulesListBox);
    $generalPanel->addComponent($this->backupTypeListBox);
    $this->addComponent($generalPanel);
    $hostPanel = new Amhsoft_Widget_Panel(_t('Ftp Informations'));
    $hostPanel->addComponent($this->hostnameInput);
    $hostPanel->addComponent($this->usernameInput);
    $hostPanel->addComponent($this->passwordInput);
    $hostPanel->addComponent($this->portInput);
    $hostPanel->addComponent($this->pathInput);
    $this->addComponent($hostPanel);
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
