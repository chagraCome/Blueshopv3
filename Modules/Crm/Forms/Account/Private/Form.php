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
class Crm_Account_Private_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $nameInput */
  public $nameInput;

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

  /** @var SubmitButton $submitbutton */
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
    $this->mobileInput->setWidth(120);
    $this->mobileInput->setRequired(true);
    $this->email1Input = new Amhsoft_Input_Control('email2', _t('Email'));
    $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email2');
    $this->email1Input->setSize(64);
    $this->countryInput = new Amhsoft_Input_Control('country', _t('Country'));
    $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country');
    $this->countryInput->setWidth(240);
    $this->provinceInput = new Amhsoft_Input_Control('province', _t('Province'));
    $this->provinceInput->DataBinding = new Amhsoft_Data_Binding('province');
    $this->provinceInput->setWidth(240);
    $this->cityInput = new Amhsoft_Input_Control('city', _t('City'));
    $this->cityInput->DataBinding = new Amhsoft_Data_Binding('city');
    $this->cityInput->setWidth(240);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save Contact Informations!'));
    $regPanel = new Amhsoft_Widget_Panel(_t('Registration Informations'));
    $regPanel->setWidth('25%');
    $this->addComponent($this->nameInput);
    $this->addComponent($this->email1Input);
    $this->addComponent($this->mobileInput);
    $this->addComponent($this->countryInput);
    $this->addComponent($this->provinceInput);
    $this->addComponent($this->cityInput);
    $this->addComponent(new Amhsoft_Html_Control('<br />'));
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
