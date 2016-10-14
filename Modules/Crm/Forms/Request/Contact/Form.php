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
class Crm_Request_Contact_Form extends Amhsoft_Widget_Form {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_Input_Control $telefonInput */
  public $telefonInput;

  /** @var Amhsoft_Input_Control $mobileInput */
  public $mobileInput;

  /** @var Amhsoft_Input_Control $email1Input */
  public $email1Input;

  /** @var Amhsoft_Input_Control $countryInput */
  public $countryInput;

  /** @var Amhsoft_Input_Control $provinceInput */
  public $provinceInput;

  /** @var Amhsoft_Input_Control $cityInput */
  public $cityInput;

  /** @var Amhsoft_Input_Control $streetInput */
  public $streetInput;

  /** @var Amhsoft_Input_Control $messageInput */
  public $messageInput;
  public $callTime;
  public $companyUrl;
  public $companyName;

  /** @var Amhsoft_Input_Control $zipcodeInput */
  public $zipcodeInput;
  public $submitbutton;
  public $captcha;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Contact Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->Required = true;
    $this->nameInput->addValidator('String|2');
    $this->nameInput->setSize(64);
    $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
    $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
    $this->mobileInput->setRequired(true);
    $this->email1Input = new Amhsoft_Input_Control('email1', _t('Email'));
    $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email1');
    $this->email1Input->addValidator('Email');
    $this->email1Input->Required = true;
    $this->email1Input->setSize(64);
    $this->companyName = new Amhsoft_Input_Control('company_name', _t('Company Name'));
    $this->companyName->DataBinding = new Amhsoft_Data_Binding('company_name');
    $this->callTime = new Amhsoft_Date_Time_Input_Control('calltime', _t('Best Call Time'));
    $this->callTime->DataBinding = new Amhsoft_Data_Binding('company_name');
    $this->messageInput = new Amhsoft_TextArea_Control('message', _t('Message'));
    $this->messageInput->DataBinding = new Amhsoft_Data_Binding('message');
    $this->companyUrl = new Amhsoft_Input_Control('company_url', _t('Company Url'));
    $this->companyUrl->DataBinding = new Amhsoft_Data_Binding('company_url');
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Send'));
    $this->submitButton->Class = 'Button';
    $generalInformations = new Amhsoft_Widget_Panel(_t('Person Informations'));
    $generalInformations->addComponent($this->nameInput);
    $generalInformations->addComponent($this->email1Input);
    $generalInformations->addComponent($this->mobileInput);
    $generalInformations->addComponent($this->callTime);
    $companyInformations = new Amhsoft_Widget_Panel(_t('Company Informations'));
    $companyInformations->addComponent($this->companyName);
    $companyInformations->addComponent($this->companyUrl);
    $messageInformations = new Amhsoft_Widget_Panel(_t('Messages'));
    $messageInformations->addComponent($this->messageInput);
    $actionPanel = new Amhsoft_Widget_Panel(_t('Security Code'));
    $actionPanel->addComponent($this->captcha);
    $actionPanel->addComponent($this->submitButton);
    $this->addComponent($generalInformations);
    $this->addComponent($companyInformations);
    $this->addComponent($messageInformations);
    $this->addComponent($actionPanel);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
