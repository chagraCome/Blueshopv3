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
class Crm_Resetpassword_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $email1Input */
  public $emailInput;
  public $passwordInput;
  public $repasswordInput;
  public $stampInput;

  /** @var Amhsoft_Button_Submit_Control $submitButton * */
  public $submitButton;
  public $captcha;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->emailInput = new Amhsoft_Input_Control('email', _t('Email'));
    $this->emailInput->DataBinding = new Amhsoft_Data_Binding('email');
    $this->emailInput->addValidator('Email');
    $this->emailInput->Required = true;
    $this->emailInput->setSize(64);
    $this->passwordInput = new Amhsoft_Password_Control('password', _t('New Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->setSize(64);
    $this->repasswordInput = new Amhsoft_Password_Control('repassword', _t('Re-enter Password'));
    $this->repasswordInput->DataBinding = new Amhsoft_Data_Binding('repassword');
    $this->repasswordInput->setSize(64);
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Submit'));
    $this->addComponent($this->emailInput);
    $this->addComponent($this->passwordInput);
    $this->addComponent($this->repasswordInput);
    $this->addComponent($this->captcha);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
