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
class Crm_Account_Activation_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $inputEmail */
  public $inputEmail;

  /** @var Amhsoft_Password_Control $activationCode */
  public $activationCode;

  /** @var Button $activateButton */
  public $activateButton;
  public $captcha;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    //email
    $this->inputEmail = new Amhsoft_Input_Control('email', _t('Email Adress'));
    $this->inputEmail->setRequired(true);
    $this->inputEmail->addValidator('Email');
    $this->inputEmail->DataBinding = new Amhsoft_Data_Binding('email');
    $this->inputEmail->setErrorMessage(_t('Required'));
    //password
    $this->activationCode = new Amhsoft_Password_Control('activation_code', _t('Activation Code'));
    $this->activationCode->DataBinding = new Amhsoft_Data_Binding('activation_code');
    $this->activationCode->setRequired(true);
    $this->activationCode->setErrorMessage(_t('Required'));
    //link forgot password
    $link = new Amhsoft_Link_Control(_t('Resend Activation Code ?'), 'index.php?module=crm&page=intern-shop-resend');
    $link->Name = "link";
    //activateButton
    $this->activateButton = new Amhsoft_Button_Submit_Control('submit', _t('Activate'));
    $this->addComponent($this->inputEmail);
    $this->addComponent($this->activationCode);
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);
    $this->addComponent($link);
    $this->addComponent(new Amhsoft_Html_Control('<br />'));
    $this->addComponent(new Amhsoft_Html_Control('<br />'));
    $this->addComponent($this->captcha);
    $this->addComponent($this->activateButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>