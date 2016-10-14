<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eqv
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Eav_Attribute_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Amhsoft_Input_Control $nameInput */
    public $nameInput;

    /** @var Amhsoft_Input_Control $defaultvalueInput */
    public $defaultvalueInput;

    /** @var Amhsoft_Input_Control $searchableYesNoListBox */
    public $searchableYesNoListBox;

    /** @var Amhsoft_Input_Control $validatorInput */
    public $validatorInput;

    /** @var Amhsoft_YesNo_ListBox_Control $requiredYesNoListBox */
    public $requiredYesNoListBox;

    /** @var Amhsoft_ListBox_Control $typeListBox */
    public $typeListBox;

    /** @var Amhsoft_ListBox_Control $productSetListBox */
    public $productSetListBox;

    /** @var Amhsoft_Input_Control $labelInput */
    public $labelInput;

    /** @var Amhsoft_TextArea_Control $datasourceTextArea */
    public $datasourceTextArea;

    /** @var Amhsoft_Input_Control $errorMessageInput */
    public $errorMessageInput;
    public $submitButton;

    /**
     * For; Construct
     */
    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    /**
     * Initialize Form Components
     */
    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;
        $this->nameInput->setWidth(300);
        $this->nameInput->addValidator('Alpha');
        $this->labelInput = new Amhsoft_Input_Control('label', _t('Label'));
        $this->labelInput->DataBinding = new Amhsoft_Data_Binding('label');
        $this->labelInput->setWidth(300);
        $this->labelInput->Required = true;
        $this->errorMessageInput = new Amhsoft_Input_Control('errormessage', _t('Error Message'));
        $this->errorMessageInput->DataBinding = new Amhsoft_Data_Binding('errormessage');
        $this->errorMessageInput->setWidth(450);
        $this->defaultvalueInput = new Amhsoft_Input_Control('defaultvalue', _t('Default Value'));
        $this->defaultvalueInput->DataBinding = new Amhsoft_Data_Binding('defaultvalue');
        $this->defaultvalueInput->setWidth(200);
        $this->validatorInput = new Amhsoft_Input_Control('validator', _t('Validator'));
        $this->validatorInput->DataBinding = new Amhsoft_Data_Binding('validator');
        $this->requiredYesNoListBox = new Amhsoft_YesNo_ListBox_Control('required', _t('Required'), 'required');
        $this->searchableYesNoListBox = new Amhsoft_YesNo_ListBox_Control('searchable', _t('Searchable'), 'searchable');
        $this->typeListBox = new Amhsoft_ListBox_Control('entity_attribute_type_backend_id', _t('Entity Attribute type BackEnd'));
        $this->typeListBox->DataBinding = new Amhsoft_Data_Binding('entity_attribute_type_backend_id', 'id', 'name');
        $this->typeListBox->DataSource = new Amhsoft_Data_Set(new Eav_Attribute_Type_Model_Adapter());
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $this->addComponent($this->nameInput);
        $this->addComponent($this->defaultvalueInput);
        $this->addComponent($this->validatorInput);
        $this->addComponent($this->labelInput);
        $this->addComponent($this->errorMessageInput);
        $this->addComponent($this->typeListBox);
        $this->addComponent($this->searchableYesNoListBox);
        $this->addComponent($this->requiredYesNoListBox);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
    }

    /*
     * Send Form
     */

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
