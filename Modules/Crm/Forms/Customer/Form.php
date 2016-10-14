<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 383 2016-02-10 14:43:34Z montassar.amhsoft $
 * $Rev: 383 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-10 15:43:34 +0100 (mer., 10 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Crm_Customer_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Input $nameInput */
    public $nameInput;

    /** @var Input $passwordInput */
    public $passwordInput;

    /** @var Input $passwordInput */
    public $rePasswordInput;

    /** @var Input $telefonInput */
    public $telefonInput;

    /** @var Input $mobileInput */
    public $mobileInput;

    /** @var Input $email1Input */
    public $email1Input;

    /** @var Amhsoft_ListBox_Control $countryInput */
    public $countryInput;

    /** @var Input $provinceInput */
    public $provinceInput;

    /** @var Input $cityInput */
    public $cityInput;

    /** @var Input $streetInput */
    public $streetInput;

    /** @var Input $zipcodeInput */
    public $zipCodeInput;
    public $submitbutton;
    public $captcha;
    public $entitySetModel;

    /** @var Amhsoft_ListBox_Control $accountSourceListBox */
    public $accountSourceListBox;

    public function __construct($name, $model, $method = 'POST') {
        parent::__construct($name, $method);
        $this->entitySetModel = $model;
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Contact Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;
        $this->nameInput->addValidator('String|2');
        $this->nameInput->setWidth(250);
        $this->nameInput->setClass('form-element');

        $this->passwordInput = new Amhsoft_Password_Control('password', _t('Password'));
        $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
        $this->passwordInput->addValidator('String|4');
        $this->passwordInput->setWidth(150);
        $this->passwordInput->setRequired(true);
        $this->passwordInput->setClass('form-element');
        
        $this->rePasswordInput = new Amhsoft_Password_Control('repassword', _t('Re-Password'));
        $this->rePasswordInput->DataBinding = new Amhsoft_Data_Binding('repassword');
        $this->rePasswordInput->addValidator('String|4');
        $this->rePasswordInput->setWidth(150);
        $this->rePasswordInput->setRequired(true);
        $this->rePasswordInput->onValidate->registerEvent($this, 'validateRepasswortd_CallBack');
        
        $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
        $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
        $this->email1Input = new Amhsoft_Input_Control('email1', _t('Email'));
        $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email1');
        $this->email1Input->addValidator('Email');
        $this->email1Input->Required = true;
        $this->email1Input->setWidth(350);
        $this->email1Input->setClass('form-element');
        
        $this->countryInput = new Amhsoft_ListBox_Control('country', _t('Country'));
        $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country', 'iso', 'name', Amhsoft_Locale::getCountryIso3());
        $this->countryInput->DataSource = new Amhsoft_Data_Set(Amhsoft_Locale::getCountryArray());
        $this->countryInput->setRequired(true);
        $this->countryInput->setWidth(240);
        $this->countryInput->setRequired(true);
        $this->provinceInput = new Amhsoft_Input_Control('province', _t('Province'));
        $this->provinceInput->DataBinding = new Amhsoft_Data_Binding('province');
        $this->provinceInput->setWidth(240);
        $this->provinceInput->setRequired(true);
        $this->cityInput = new Amhsoft_Input_Control('city', _t('City'));
        $this->cityInput->DataBinding = new Amhsoft_Data_Binding('city');
        $this->cityInput->setWidth(240);
        $this->cityInput->setRequired(true);
        $this->zipCodeInput = new Amhsoft_Input_Control('zipcode', _t('Postal Code'));
        $this->zipCodeInput->DataBinding = new Amhsoft_Data_Binding('zipcode');
        $this->zipCodeInput->setWidth(100);
        $this->zipCodeInput->setRequired(true);
        $this->streetInput = new Amhsoft_Input_Control('street', _t('Street Name /House Nr.'));
        $this->streetInput->DataBinding = new Amhsoft_Data_Binding('street');
        $this->streetInput->setWidth(450);
        $this->streetInput->setRequired(true);
        $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
        $this->captcha->setRequired(true);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save and Continue!'));
        $personalDetailsPanel = new Amhsoft_Widget_Panel(_t('Your Personal Details'));
        $personalDetailsPanel->addComponent($this->nameInput);
        $personalDetailsPanel->addComponent($this->email1Input);
        $personalDetailsPanel->addComponent($this->mobileInput);
        $addressDetailsPanel = new Amhsoft_Widget_Panel(_t('Your Address Details'));
        $addressDetailsPanel->addComponent($this->streetInput);
        $addressDetailsPanel->addComponent($this->cityInput);
        $addressDetailsPanel->addComponent($this->zipCodeInput);
        $addressDetailsPanel->addComponent($this->provinceInput);
        $addressDetailsPanel->addComponent($this->countryInput);
        $passwordDetailsPanel = new Amhsoft_Widget_Panel(_t('Your Password'));
        $passwordDetailsPanel->addComponent($this->passwordInput);
        $passwordDetailsPanel->addComponent($this->rePasswordInput);
        $passwordDetailsPanel->addComponent($this->captcha);
        $this->addComponent($personalDetailsPanel);
        $this->addComponent($addressDetailsPanel);
        $this->addComponent($passwordDetailsPanel);
        $checkBoxPrivacyPolicy = new Amhsoft_CheckBox_Control('privacy_policy_accepted', _t('I have read the Privacy Policy.'), '1');
        $checkBoxPrivacyPolicy->setRequired(true);
        $checkBoxPrivacyPolicy->DataBinding = new Amhsoft_Data_Binding('privacy_policy_accepted');
        $checkBoxPrivacyPolicy->setErrorMessage(_t('Please confirm the privacy poilicy'));
        $crmAccountSetting = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $textAreaPrivacyPolicy = new Amhsoft_Label_Control('');
        $textAreaPrivacyPolicy->setValue('<div style="scrollbar:both; min-height: 150px; border:1px solid gray; background-color:white; max-height: 150px; padding:5px; width: 80%">' . nl2br($crmAccountSetting->getValue(Crm_Account_Model::PRIVACY_POLICY_TEXT)));
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Register Now'));
        if ($crmAccountSetting->getValue(Crm_Account_Model::PRIVACY_POLICY_STATUS)) {
            $navigationPanel->addComponent($checkBoxPrivacyPolicy);
            $navigationPanel->addComponent($textAreaPrivacyPolicy);
        }
        $this->accountSourceListBox = new Amhsoft_ListBox_Control('account_source_id', _t('Source'));
        $this->accountSourceListBox->DataBinding = new Amhsoft_Data_Binding('account_source_id', 'id', 'name');
        $this->accountSourceListBox->DataSource = new Amhsoft_Data_Set(new Crm_Account_Source_Model_Adapter());
        $this->accountSourceListBox->WithNullOption = true;
        $this->accountSourceListBox->setWidth(200);
        $this->accountSourceListBox->NullOptionLabel = _t('Please select');
        $this->addCustomComponents();
        $navigationPanel->addComponent($this->accountSourceListBox);
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
    }

    public static function validateRepasswortd_CallBack(Amhsoft_Abstract_Control $component) {
        $result = Amhsoft_Web_Request::post('password') == $component->getValue();
        $component->setErrorMessage(_t('Passwords are not identicals'));
        return $result;
    }

    public function isSend() {
        return isset($_POST['submit']);
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

}

?>
