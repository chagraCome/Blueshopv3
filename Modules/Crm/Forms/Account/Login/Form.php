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
class Crm_Account_Login_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $inputEmail */
  public $inputEmail;

  /** @varAmhsoft_Password_Control $inputPassword */
  public $inputPassword;

  /** @var Button $longButton */
  public $loginButton;

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
    $this->inputPassword = new Amhsoft_Password_Control('password', _t('Password'));
    $this->inputPassword->DataBinding = new Amhsoft_Data_Binding('password');
    $this->inputPassword->setRequired(true);
    $this->inputPassword->setErrorMessage(_t('Required'));
    //link forgot password
    $linkForgotPassword = new Amhsoft_Link_Control(_t('Forgot Password?'), 'index.php?module=customer&page=forgotpassword');
    //loginButton
    $this->loginButton = new Amhsoft_Button_Submit_Control('login', _t('Login'));
    $this->addComponent($this->inputEmail);
    $this->addComponent($this->inputPassword);
    $this->addComponent($linkForgotPassword);
    $this->addComponent(new Amhsoft_Html_Control('<br />'));
    $this->addComponent(new Amhsoft_Html_Control('<br />'));
    $this->addComponent($this->loginButton);
  }

  public function isSend() {
    return isset($_POST['login']);
  }

}

?>