<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 449 2016-02-23 08:14:06Z imen.amhsoft $
 * $Rev: 449 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Backup_Local_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    public $nameInput;

    /** @var Amhsoft_ListBox_Control $modulesListBox * */
    public $modulesListBox;
    public $backupTypeListBox;
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
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Generate'));
        $this->submitButton->Class = 'ButtonSave';
        $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
        $generalPanel->addComponent($this->nameInput);
        $generalPanel->addComponent($this->modulesListBox);
        $generalPanel->addComponent($this->backupTypeListBox);
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
