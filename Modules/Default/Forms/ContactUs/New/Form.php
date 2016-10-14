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
class Default_ContactUs_New_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $nameInput */
  public $nameInput;

  /** @var Input $telefonInput */
  public $telefonInput;

  /** @var Input $mobileInput */
  public $mobileInput;

  /** @var Input $email1Input */
  public $email1Input;

  /** @var Input $countryInput */
  public $countryInput;

  /** @var Input $provinceInput */
  public $provinceInput;

  /** @var Input $cityInput */
  public $cityInput;

  /** @var Input $streetInput */
  public $streetInput;

  /** @var Input $messageInput */
  public $messageInput;

  /** @var Input $zipcodeInput */
  public $zipcodeInput;
  public $submitbutton;
  public $captcha;
  public $htmlInfo;
  public $infoPanel;

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
    $this->messageInput = new Amhsoft_TextArea_Control('message', _t('Message'));
    $this->messageInput->DataBinding = new Amhsoft_Data_Binding('message');
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('SEND'));
    $this->submitButton->Class="Button2";
    $regPanel = new Amhsoft_Widget_Panel(_t(''));
    $regPanel->setWidth('25%');
    $regPanel->addComponent($this->nameInput);
    $regPanel->addComponent($this->email1Input);
    $regPanel->addComponent($this->mobileInput);
    $regPanel->addComponent($this->messageInput);
    $regPanel->addComponent($this->captcha);
    $regPanel->addComponent($this->submitButton);
    $this->infoPanel = new Amhsoft_Widget_Panel(_t(''));
    $this->htmlInfo = new Amhsoft_Html_Control(_t(''));
    $this->infoPanel->addComponent($this->htmlInfo);
    $gridLayout = new Amhsoft_Grid_Layout(2);
    $panel = new Amhsoft_Widget_Panel();
    $panel->setLayout($gridLayout);
    $panel->addComponent($this->infoPanel);
    $panel->addComponent($regPanel);
    $this->addComponent($panel);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
