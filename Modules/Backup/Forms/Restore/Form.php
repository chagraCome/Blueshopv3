<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 455 2016-02-24 12:38:27Z imen.amhsoft $
 * $Rev: 455 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-24 13:38:27 +0100 (mer., 24 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Backup_Restore_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_ListBox_Control $modulesListBox * */
  public $modulesListBox;
  public $restoreTypeListBox;
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
    $this->modulesListBox = new Amhsoft_ListBox_Control('modules[]', _t('Select Modules'));
    $this->modulesListBox->DataBinding = new Amhsoft_Data_Binding('modules');
    $this->modulesListBox->setWidth(300);
    $this->modulesListBox->Size = 10;
    $this->modulesListBox->multiple = true;
    $this->restoreTypeListBox = new Amhsoft_ListBox_Control('restore_type', _t('Restore Type'));
    $this->restoreTypeListBox->DataBinding = new Amhsoft_Data_Binding('restore_type', 'id', 'name');
    $types = array(
	array('id' => 'restore_all', 'name' => _t('Restore database and media')),
	array('id' => 'restore_media_only', 'name' => _t('Restore media only')),
	array('id' => 'restore_database_only', 'name' => _t('Restore database only')),
    );
    $this->restoreTypeListBox->DataSource = new Amhsoft_Data_Set($types);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Restore'));
    $this->submitButton->Class = 'ButtonSave';
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->modulesListBox);
    $generalPanel->addComponent($this->restoreTypeListBox);
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
