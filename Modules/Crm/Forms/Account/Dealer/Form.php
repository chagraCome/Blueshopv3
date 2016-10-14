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
class Crm_Account_Dealer_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $nameInput */
  public $nameInput;

  /** @var Input $passwordInput */
  public $passwordInput;

  /** @var Input $passwordInput */
  public $rePasswordInput;

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
    $this->passwordInput = new Amhsoft_Password_Control('password', _t('Password'));
    $this->passwordInput->DataBinding = new Amhsoft_Data_Binding('password');
    $this->passwordInput->addValidator('String|4');
    $this->passwordInput->setSize(32);
    $this->passwordInput->setRequired(true);
    $this->rePasswordInput = new Amhsoft_Password_Control('repassword', _t('Re-Password'));
    $this->rePasswordInput->DataBinding = new Amhsoft_Data_Binding('repassword');
    $this->rePasswordInput->addValidator('String|4');
    $this->rePasswordInput->setSize(32);
    $this->rePasswordInput->setRequired(true);
    $this->rePasswordInput->onValidate->registerEvent($this, 'validateRepasswortd_CallBack');
    $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
    $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
    $this->mobileInput->setRequired(true);
    $this->email1Input = new Amhsoft_Input_Control('email1', _t('Email'));
    $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email1');
    $this->email1Input->addValidator('Email');
    $this->email1Input->addValidator('Unique|account|email1');
    $this->email1Input->Required = true;
    $this->email1Input->setSize(64);
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Register Now!'));
    $regPanel = new Amhsoft_Widget_Panel(_t('Registration Informations'));
    $regPanel->setWidth('25%');
    $regPanel->addComponent($this->email1Input);
    $regPanel->addComponent($this->passwordInput);
    $regPanel->addComponent($this->rePasswordInput);
    $regPanel->addComponent($this->nameInput);
    $regPanel->addComponent($this->mobileInput);
    $regPanel->addComponent($this->captcha);
    $regPanel->addComponent($this->submitButton);
    $c = new Cms_Page_Model_Adapter();
    $page = $c->fetchByAlias('crm.register.default');
    if ($page instanceof Cms_Page_Model) {
      $infoPanel = new Amhsoft_Widget_Panel($page->getTitle());
      $htmlInfo = new Amhsoft_Html_Control($page->getContent());
    } else {
      $infoPanel = new Amhsoft_Widget_Panel(_t('Why Registration'));
      $htmlInfo = new Amhsoft_Html_Control("<br/>
                  Register for new account to:<br/>

                  1. View, edit, update your account information's.<br/>
                  2. Change your password.<br/>
                  3. view, edit your Car.<br/>
                  4. Add car to Motors Souq free of charge.<br/>
                  5. Request Car from owners and dealers.<br/>
                  6. View, edit your Motorbike.<br/>
                  7. Add motorbike to Motors Souq free of charge.<br/>
                  8. Request motorbike from owners and dealers.<br/>
                  <br/>
                  And more service's, features are coming very soon...<br/>
          ");
    }
    $infoPanel->addComponent($htmlInfo);
    $advertisePanel = new Amhsoft_Widget_Panel(_t('Advertise'));
    $gridLayout = new Amhsoft_Grid_Layout(3);
    $panel = new Amhsoft_Widget_Panel();
    $panel->setLayout($gridLayout);
    $panel->addComponent($regPanel);
    $this->addComponent($panel);
  }

  public static function validateRepasswortd_CallBack(Amhsoft_Abstract_Control $component) {
    $result = Amhsoft_Web_Request::post('password') == $component->getValue();
    $component->setErrorMessage(_t('Passwords are not identicals'));
    return $result;
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
