<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_User_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $usernameInput */
  public $usernameInput;

  /** @var Amhsoft_Input_Control $numberInput */
  public $numberInput;

  /** @var Amhsoft_Input_Control $passwordInput */
  public $passwordInput;

  /** @var Amhsoft_Input_Control $firstnameInput */
  public $firstnameInput;

  /** @var Amhsoft_Input_Control $lastnameInput */
  public $lastnameInput;

  /** @var Amhsoft_Input_Control $dateofbirthInput */
  public $dateofbirthInput;

  /** @var Amhsoft_Input_Control $phoneInput */
  public $phoneInput;

  /** @var Amhsoft_Input_Control $emailInput */
  public $emailInput;

  /** @var Amhsoft_Input_Control $mobileInput */
  public $mobileInput;

  /** @var Amhsoft_Input_Control $faxInput */
  public $faxInput;

  /** @var Amhsoft_YesNoListBox_control $stateYesNoListBox */
  public $stateYesNoListBox;

  /** @var Amhsoft_Input_Control $noticeInput */
  public $noticeInput;

  /** @var Amhsoft_Input_Control $addressInput */
  public $addressInput;

  /** @var Amhsoft_Input_Control $postalcodeInput */
  public $postalcodeInput;

  /** @var Amhsoft_Input_Control $cityInput */
  public $cityInput;

  /** @var Amhsoft_Input_Control $provinceInput */
  public $provinceInput;

  /** @var Amhsoft_Input_Control $countryInput */
  public $countryInput;

  /** @var Amhsoft_Input_Control $remoteidInput */
  public $remoteidInput;

  /** @var Amhsoft_ListBox_Control $departmentListBox */
  public $departmentListBox;

  /** @var Amhsoft_Social_Facebook_Input_Control $facebookInput */
  public $facebookInput;

  /** @var Amhsoft_Social_Twitter_Input_Control $twitterInput */
  public $twitterInput;

  /** @var Amhsoft_Social_Msn_Input_Control $msnInput */
  public $msnInput;

  /** @var Amhsoft_Social_Icq_Input_Control $icqInput */
  public $icqInput;

  /** @var Amhsoft_Social_Blackberry_Input_Control $blackBerryInput */
  public $blackBerryInput;

  /** @var Amhsoft_Social_Whatsapp_Input_Control $whatsapp */
  public $whatsapp;

  /** @var Amhsoft_Social_Googlemail_Input_Controll $gooleInput */
  public $gooleInput;
  public $adminListBox;

  /** @var Amhsoft_ListBox_Control $roleListBox */
  public $roleListBox;

  /** @var Amhsoft_CheckBox_Control $sendPasswordCheckBox */
  public $sendPasswordCheckBox;
  public $submitButton;
  public $picture;

  /**
   * Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->setMultipart(true);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->numberInput = new Amhsoft_Input_Control('number', _t('Number'));
    $this->numberInput->DataBinding = new Amhsoft_Data_Binding('number');
    $this->numberInput->Required = true;
    $this->usernameInput = new Amhsoft_Input_Control('username', _t('User Name'));
    $this->usernameInput->DataBinding = new Amhsoft_Data_Binding('username');
    $this->usernameInput->addValidator(new Amhsoft_Alpha_Validator());
    $this->usernameInput->addValidator(new Amhsoft_String_Validator(3));
    $this->usernameInput->setWidth(300);
    $this->usernameInput->setRequired(true);
    $this->passwordInput = new Amhsoft_Password_Control('password', _t('Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->setWidth(300);
    $this->passwordInput->addValidator(new Amhsoft_String_Validator(5));
    $this->passwordInput->setRequired(true);
    $this->firstnameInput = new Amhsoft_Input_Control('firstname', _t('First Name'));
    $this->firstnameInput->DataBinding = new Amhsoft_Data_Binding('firstname');
    $this->firstnameInput->Required = true;
    $this->firstnameInput->setWidth(300);
    $this->firstnameInput->addValidator('String|3');
    $this->lastnameInput = new Amhsoft_Input_Control('lastname', _t('Last Name'));
    $this->lastnameInput->DataBinding = new Amhsoft_Data_Binding('lastname');
    $this->lastnameInput->setWidth(300);
    $this->phoneInput = new Amhsoft_Input_Control('phone', _t('Phone'));
    $this->phoneInput->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->emailInput = new Amhsoft_Input_Control('email', _t('Email'));
    $this->emailInput->DataBinding = new Amhsoft_Data_Binding('email');
    $this->emailInput->setWidth(300);
    $this->emailInput->addValidator('Email');
    $this->emailInput->Required = true;
    $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
    $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
    $this->faxInput = new Amhsoft_Input_Control('fax', _t('Fax'));
    $this->faxInput->DataBinding = new Amhsoft_Data_Binding('fax');
    $this->stateYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('State'), 'state', 1);
    $this->noticeInput = new Amhsoft_TextArea_Control('notice', _t('Notice'));
    $this->noticeInput->DataBinding = new Amhsoft_Data_Binding('notice');
    $this->addressInput = new Amhsoft_Input_Control('address', _t('Address'));
    $this->addressInput->DataBinding = new Amhsoft_Data_Binding('address');
    $this->addressInput->setWidth(300);
    $this->postalcodeInput = new Amhsoft_Input_Control('postalcode', _t('Postale Code'));
    $this->postalcodeInput->DataBinding = new Amhsoft_Data_Binding('postalcode');
    $this->postalcodeInput->setWidth(50);
    $this->cityInput = new Amhsoft_Input_Control('city', _t('city'));
    $this->cityInput->DataBinding = new Amhsoft_Data_Binding('city');
    $this->cityInput->setWidth(220);
    $this->provinceInput = new Amhsoft_Input_Control('province', _t('Province'));
    $this->provinceInput->DataBinding = new Amhsoft_Data_Binding('province');
    $this->provinceInput->setWidth(220);
    $this->countryInput = new Amhsoft_Input_Control('country', _t('Country'));
    $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country');
    $this->countryInput->setWidth(220);
    $this->remoteidInput = new Amhsoft_Input_Control('remote_id', _t('Code id'));
    $this->remoteidInput->DataBinding = new Amhsoft_Data_Binding('remote_id');
    $this->departmentListBox = new Amhsoft_ListBox_Control('department_id', _t('Department'));
    $this->departmentListBox->DataBinding = new Amhsoft_Data_Binding('department_id', 'id', 'name');
    $this->departmentListBox->DataSource = Amhsoft_Data_Source::Table('department');
    $this->facebookInput = new Amhsoft_Social_Facebook_Input_Control('facebook', _t('Facebook'));
    $this->facebookInput->DataBinding = new Amhsoft_Data_Binding('facebook');
    $this->twitterInput = new Amhsoft_Social_Twitter_Input_Control('twitter', _t('Twitter'));
    $this->twitterInput->DataBinding = new Amhsoft_Data_Binding('twitter');
    $this->gooleInput = new Amhsoft_Social_Googlemail_Input_Control('gmail', _t('Gmail'));
    $this->gooleInput->DataBinding = new Amhsoft_Data_Binding('gmail');
    $this->icqInput = new Amhsoft_Social_Icq_Input_Control('icq', _t('ICQ'));
    $this->icqInput->DataBinding = new Amhsoft_Data_Binding('icq');
    $this->blackBerryInput = new Amhsoft_Social_Blackberry_Input_Control('blackberry', _t('Blackberry PIN'));
    $this->blackBerryInput->DataBinding = new Amhsoft_Data_Binding('blackberry');
    $this->msnInput = new Amhsoft_Social_Msn_Input_Control('msn', _t('MSN'));
    $this->msnInput->DataBinding = new Amhsoft_Data_Binding('msn');
    $this->whatsapp = new Amhsoft_Social_Whatsapp_Input_Control('whatsapp', _t('WhatsApp'));
    $this->whatsapp->DataBinding = new Amhsoft_Data_Binding('whatsapp');
    $this->roleListBox = new Amhsoft_ListBox_Control('role_id', _t('Role'));
    $this->roleListBox->DataBinding = new Amhsoft_Data_Binding('role_id', 'id', 'name');
    $this->roleListBox->DataSource = new Amhsoft_Data_Set(new User_Role_Model_Adapter());
    $this->roleListBox->Required = true;
    $this->picture = new Amhsoft_ImageControl_Control('pic');
    $this->picture->DataBinding = new Amhsoft_Data_Binding('pic');

    $fileUpload = new Amhsoft_FileInput_Control('picture', _t('Picture'));


    $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG);
    $fileUpload->addValidator($ImageValidator);

    $this->picture->uploadControl = $fileUpload;
    $this->picture->setWidth(200);

    $logoPanel = new Amhsoft_Widget_Panel(_t('Picture'));
    $logoPanel->addComponent($this->picture);

    $this->sendPasswordCheckBox = new Amhsoft_YesNo_ListBox_Control('send_password', _t('Send Password'), 'send_password', 1);
    $this->adminListBox = new Amhsoft_YesNo_ListBox_Control('admin', _t('As Admin'), 'admin');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $userLoginPanel = new Amhsoft_Widget_Panel(_t('Login Informations'));
    $userLoginPanel->addComponent($this->numberInput);
    $userLoginPanel->addComponent($this->usernameInput);
    $userLoginPanel->addComponent($this->passwordInput);
    $userLoginPanel->addComponent($this->roleListBox);
    $userLoginPanel->addComponent($this->adminListBox);
    $this->addComponent($userLoginPanel);
    $userInfo = new Amhsoft_Widget_Panel(_t('Contact Informations'));
    $userInfo->addComponent($this->firstnameInput);
    $userInfo->addComponent($this->lastnameInput);
    $userInfo->addComponent($this->emailInput);
    $userInfo->addComponent($this->mobileInput);
    $userInfo->addComponent($this->faxInput);
    $userInfo->addComponent($this->addressInput);
    $userInfo->addComponent($this->postalcodeInput);
    $userInfo->addComponent($this->cityInput);
    $userInfo->addComponent($this->provinceInput);
    $userInfo->addComponent($this->countryInput);
    $userInfo->addComponent($this->remoteidInput);
    $userInfo->addComponent($this->departmentListBox);
    $this->addComponent($userInfo);
    $noticeInfo = new Amhsoft_Widget_Panel(_t('Note'));
    $noticeInfo->addComponent($this->noticeInput);
    $this->addComponent($noticeInfo);
    $this->addComponent($logoPanel);
    $socialInfo = new Amhsoft_Widget_Panel(_t('Social networks Informations'));
    $socialInfo->addComponent($this->facebookInput);
    $socialInfo->addComponent($this->twitterInput);
    $socialInfo->addComponent($this->msnInput);
    $socialInfo->addComponent($this->icqInput);
    $socialInfo->addComponent($this->gooleInput);
    $socialInfo->addComponent($this->blackBerryInput);
    $socialInfo->addComponent($this->whatsapp);
    $this->addComponent($socialInfo);
    $actionsInfo = new Amhsoft_Widget_Panel(_t('Actions'));
    $actionsInfo->addComponent($this->sendPasswordCheckBox);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navigationPanel->addComponent($this->submitButton);
    $this->addComponent($actionsInfo);
    $this->addComponent($navigationPanel);
  }

  /**
   * Form send method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
