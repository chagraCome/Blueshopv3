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
class Crm_ChangePassword_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $passwordInput */
  public $passwordInput;

  /** @var Amhsoft_Input_Control $newPasswordInput */
  public $newPasswordInput;

  /** @var Amhsoft_Input_Control $confirmPasswordInput */
  public $confirmPasswordInput;

  /** @var Amhsoft_SubmitButton $submitButton */
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->passwordInput = new Amhsoft_Input_Control('password', _t('Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->Required = true;
    $this->newPasswordInput = new Amhsoft_Input_Control('new_password', _t('New Password'));
    $this->newPasswordInput->DataBinding = new Amhsoft_Data_Binding('new_password');
    $this->newPasswordInput->Required = true;
    $this->newPasswordInput->addValidator(new Amhsoft_String_Validator(4));
    $this->confirmPasswordInput = new Amhsoft_Input_Control('confirm_password', _t('Confirm Password'));
    $this->confirmPasswordInput->DataBinding = new Amhsoft_Data_Binding('confirm_password');
    $this->confirmPasswordInput->Required = true;
    $this->confirmPasswordInput->addValidator(new Amhsoft_String_Validator(4));
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit_change_password', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->addComponent($this->passwordInput);
    $this->addComponent($this->newPasswordInput);
    $this->addComponent($this->confirmPasswordInput);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit_change_password']);
  }

}

?>
