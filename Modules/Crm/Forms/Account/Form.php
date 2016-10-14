<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Account_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Input $nameInput */
    public $nameInput;

    /** @var Input $companynameInput */
    public $companynameInput;

    /** @var Input $companywebsiteInput */
    public $companywebsiteInput;

    /** @var Input $passwordInput */
    public $passwordInput;

    /** @var Listbox $testOption */
    public $testOption;

    /** @var Input $numberInput */
    public $numberInput;

    /** @var Input $telefonInput */
    public $telefonInput;

    /** @var Input $mobileInput */
    public $mobileInput;

    /** @var Input $email1Input */
    public $email1Input;

    /** @var Input $email2Input */
    public $email2Input;

    /** @var Input $countryInput */
    public $countryInput;

    /** @var Input $provinceInput */
    public $provinceInput;

    /** @var Input $cityInput */
    public $cityInput;

    /** @var Input $streetInput */
    public $streetInput;

    /** @var Input $zipcodeInput */
    public $zipcodeInput;

    /** @var Amhsoft_ListBox_Control $groupListBox */
    public $groupListBox;
    public $submitButton;

    /** @var Amhsoft_FileInput_Control $dealerLogo */
    public $dealerLogo;

    /** @var Amhsoft_CheckBox_Control $sendPasswordCheckBox */
    public $sendPasswordCheckBox;

    /** @var Amhsoft_CheckBox_Control $canLoginCheckBox */
    public $canLoginCheckBox;

    /** @var Amhsoft_ImageControl_Control $dealerBanner */
    public $dealerBanner;
    public $noticeTextArea;
    public $accountSourceListBox;
    public $created;
    public $updated;
    public $entitySetModel;

    public function __construct($name, $model, $method = null) {
        parent::__construct($name, $method);
        $this->entitySetModel = $model;
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->dealerLogo = new Amhsoft_ImageControl_Control('logosrc');
        $fileUpload = new Amhsoft_FileInput_Control('logo', _t('Dealer Logo'));
        $this->dealerLogo->setUploadControl($fileUpload);
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
        $fileUpload->addValidator($ImageValidator);
        $this->dealerLogo->setWidth(200);
        $this->dealerLogo->DataBinding = new Amhsoft_Data_Binding('logosrc');
        $this->numberInput = new Amhsoft_Input_Control('number', _t('Number'));
        $this->numberInput->DataBinding = new Amhsoft_Data_Binding('number');
        $this->numberInput->Required = true;
        $this->dealerLogo = new Amhsoft_ImageControl_Control('logosrc');
        $fileUpload = new Amhsoft_FileInput_Control('logo', _t('Dealer Logo'));
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
        $fileUpload->addValidator($ImageValidator);
        $this->dealerLogo->setUploadControl($fileUpload);
        $this->dealerLogo->setWidth(200);
        $this->dealerLogo->DataBinding = new Amhsoft_Data_Binding('logosrc');
        $this->groupListBox = new Amhsoft_ListBox_Control('group_id', _t('Account Group'));
        $this->groupListBox->DataBinding = new Amhsoft_Data_Binding('group_id', 'id', 'name');
        $this->groupListBox->DataSource = new Amhsoft_Data_Set(new Crm_Account_Group_Model_Adapter());
        $this->accountSourceListBox = new Amhsoft_ListBox_Control('account_source_id', _t('Source'));
        $this->accountSourceListBox->DataBinding = new Amhsoft_Data_Binding('account_source_id', 'id', 'name');
        $this->accountSourceListBox->DataSource = new Amhsoft_Data_Set(new Crm_Account_Source_Model_Adapter());
        $this->accountSourceListBox->WithNullOption = true;
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Fullname'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->setWidth(250);
        $this->nameInput->Required = true;
        $this->nameInput->addValidator('String|2');
        $this->companynameInput = new Amhsoft_Input_Control('company_name', _t('Company Name'));
        $this->companynameInput->DataBinding = new Amhsoft_Data_Binding('company_name');
        $this->companynameInput->setWidth(250);
        $this->companywebsiteInput = new Amhsoft_Input_Control('company_website', _t('Company Web Site'));
        $this->companywebsiteInput->DataBinding = new Amhsoft_Data_Binding('company_website');
        $this->companywebsiteInput->setWidth(250);
        $this->passwordInput = new Amhsoft_Password_Control('password', _t('Password'));
        $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
        $this->telefonInput = new Amhsoft_Input_Control('telefon', _t('Telefon'));
        $this->telefonInput->DataBinding = new Amhsoft_Data_Binding('telefon');
        $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
        $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
        $this->email1Input = new Amhsoft_Input_Control('email1', _t('Email'));
        $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email1');
        $this->email1Input->setWidth(300);
        $this->email1Input->addValidator('Email');
        $this->email1Input->Required = true;
        $this->email2Input = new Amhsoft_Input_Control('email2', _t('E-mail2'));
        $this->email2Input->DataBinding = new Amhsoft_Data_Binding('email2');
        $this->email2Input->setWidth(300);
        $this->countryInput = new Amhsoft_ListBox_Control('country', _t('Country'));
        $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country', 'iso', 'name', Amhsoft_Locale::getCountryIso3());
        $this->countryInput->DataSource = new Amhsoft_Data_Set(Amhsoft_Locale::getCountryArray());
        $this->countryInput->setRequired(true);
        $this->countryInput->setWidth(240);
        $this->countryInput->setRequired(true);
        $this->provinceInput = new Amhsoft_Input_Control('province', _t('Province'));
        $this->provinceInput->DataBinding = new Amhsoft_Data_Binding('province');
        $this->cityInput = new Amhsoft_Input_Control('city', _t('City'));
        $this->cityInput->DataBinding = new Amhsoft_Data_Binding('city');
        $this->streetInput = new Amhsoft_Input_Control('street', _t('Street'));
        $this->streetInput->DataBinding = new Amhsoft_Data_Binding('street');
        $this->streetInput->setWidth(300);
        $this->zipcodeInput = new Amhsoft_Input_Control('zipcode', _t('ZipCode'));
        $this->zipcodeInput->DataBinding = new Amhsoft_Data_Binding('zipcode');
        $this->zipcodeInput->setWidth(100);
        $this->noticeTextArea = new Amhsoft_TextArea_Control('notice', _t('Notices'));
        $this->noticeTextArea->DataBinding = new Amhsoft_Data_Binding('notice');
        $this->sendPasswordCheckBox = new Amhsoft_CheckBox_Control('send_password', _t('Send Password'), 1);
        $this->canLoginCheckBox = new Amhsoft_CheckBox_Control('can_login', _t('Can Login'), 1);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $generealInformationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
        $generealInformationPanel->addComponent($this->numberInput);
        $generealInformationPanel->addComponent($this->groupListBox);
        $generealInformationPanel->addComponent($this->accountSourceListBox);
        $generealInformationPanel->addComponent($this->nameInput);
        $generealInformationPanel->addComponent($this->passwordInput);
        $generealInformationPanel->addComponent($this->companynameInput);
        $generealInformationPanel->addComponent($this->companywebsiteInput);
        $generealInformationPanel->addComponent($this->telefonInput);
        $generealInformationPanel->addComponent($this->mobileInput);
        $generealInformationPanel->addComponent($this->email1Input);
        $generealInformationPanel->addComponent($this->email2Input);
        $generealInformationPanel->addComponent($this->noticeTextArea);
        $addressPanel = new Amhsoft_Widget_Panel(_t('Address Informations'));
        $addressPanel->addComponent($this->countryInput);
        $addressPanel->addComponent($this->provinceInput);
        $addressPanel->addComponent($this->cityInput);
        $addressPanel->addComponent($this->streetInput);
        $addressPanel->addComponent($this->zipcodeInput);
        $picturesPanel = new Amhsoft_Widget_Panel(_t('Picture'));
        $picturesPanel->addComponent($this->dealerLogo);
        $this->addComponent($generealInformationPanel);
        $this->addComponent($addressPanel);
        $this->addComponent($picturesPanel);
        $this->addCustomComponents();
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
    }

    /**
     * Add Custom Component
     * @return type
     */
    protected function addCustomComponents() {
        if (!$this->entitySetModel instanceof Eav_Set_Model) {
            return;
        }
        $attributes = $this->entitySetModel->getGeneralAttributes();
        if (count($attributes) == 0) {
            
        }
        $panel = new Amhsoft_Widget_Panel($this->entitySetModel->getName() . ' ' . _t('Attributes'));
        foreach ($attributes as $attribute) {
            $component = $attribute->getControlComponent($this->entitySetModel->getEntity()->table);
            Amhsoft_Event_Handler::trigger('accountform.before.add.component', $this, $component);
            $panel->addComponent($component);
        }
        $this->addComponent($panel);
        foreach ($this->entitySetModel->getViews() as $view) {
            $panelView = new Amhsoft_Widget_Panel($view->getName());
            foreach ($view->attributes as $attribute) {
                $component = $attribute->getControlComponent($this->entitySetModel->getEntity()->table);
                Amhsoft_Event_Handler::trigger('accountform.before.add.component', $this, $component);
                $panelView->addComponent($component);
            }
            $this->addComponent($panelView);
        }
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
