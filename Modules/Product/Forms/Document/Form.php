<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Document_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Input $nameInput * */
    public $nameInput;

    /** @var ListBox $typeInput * */
    public $typeInput;

    /** @var Input extensionInput * */
    public $extensionInput;

    /** @var Amhsoft_FileInput_Control $documentfileInput */
    public $documentfileInput;

    /** @var ListBox $publicYesNoListBox * */
    public $publicYesNoListBox;
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
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;
        $types = array(_t('Document'), _t('Image'), _t('Zip File'), _t('Software'));
        $this->typeInput = new Amhsoft_ListBox_Control('type', _t('Type'));
        $this->typeInput->DataBinding = new Amhsoft_Data_Binding('type');
        $this->typeInput->DataSource = new Amhsoft_Data_Set($types);
        $this->publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 1);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $this->documentfileInput = new Amhsoft_FileInput_Control('project_file', _t('File to upload'), 'Add Document');
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::DOC . ';' . Amhsoft_Mimetype::PDF . ';' . Amhsoft_Mimetype::ZIP . ';' . Amhsoft_Mimetype::EXCEL);
        $this->documentfileInput->addValidator($ImageValidator);
        $this->documentfileInput->Required = true;
        $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
        $generalPanel->addComponent($this->nameInput);
        $generalPanel->addComponent($this->typeInput);
        $generalPanel->addComponent($this->publicYesNoListBox);
        $generalPanel->addComponent($this->documentfileInput);
        $this->addComponent($generalPanel);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
    }

    /**
     * Send Form Method
     * @return type
     */
    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
