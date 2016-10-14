<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_ChangePassword_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $passwordInput */
  public $passwordInput;

  /** @var Amhsoft_Input_Control $newPasswordInput */
  public $newPasswordInput;

  /** @var Amhsoft_Input_Control $confirmPasswordInput */
  public $confirmPasswordInput;

  /** @var Amhsoft_SubmitButton $submitButton */
  public $submitButton;

  /**
   * Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $tPanel = new Amhsoft_Widget_Panel(_t('General Information'));
    $this->passwordInput = new Amhsoft_Password_Control('old_password', _t('Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->Required = true;
    $this->newPasswordInput = new Amhsoft_Password_Control('new_password', _t('New Password'));
    $this->newPasswordInput->DataBinding = new Amhsoft_Data_Binding('new_password');
    $this->newPasswordInput->Required = true;
    $this->newPasswordInput->addValidator(new Amhsoft_String_Validator(4));
    $this->confirmPasswordInput = new Amhsoft_Password_Control('confirm_password', _t('Confirm Password'));
    $this->confirmPasswordInput->DataBinding = new Amhsoft_Data_Binding('confirm_password');
    $this->confirmPasswordInput->Required = true;
    $this->confirmPasswordInput->addValidator(new Amhsoft_String_Validator(4));
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit_change_password', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $tPanel->addComponent($this->passwordInput);
    $tPanel->addComponent($this->newPasswordInput);
    $tPanel->addComponent($this->confirmPasswordInput);
    $navPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navPanel->addComponent($this->submitButton);

    $this->addComponent($tPanel);
    $this->addComponent($navPanel);
  }

  /**
   * Form send method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit_change_password']);
  }

}

?>
