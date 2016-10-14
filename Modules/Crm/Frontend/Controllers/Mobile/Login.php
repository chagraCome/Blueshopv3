<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Login.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
Application::import('modules.crm.models.AccountModel');
Application::import('Amhsoft.Core.Controls.JQMControl');

class loginController extends Amhsoft_Front_Controller implements IController {

  /** @var Crm_Account_Model_Adapter $accountModelAdapter */
  public $accountModelAdapter;

  /** @var JQMDocument $jqueryMobileDocument */
  protected $jqueryMobileDocument;
  protected $inputPassword;
  protected $inputEmail;
  protected $message;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->accountModelAdapter = new Crm_Account_Model_Adapter();
    $this->jqueryMobileDocument = new JQMDocument();
    $currentCustomer = Crm_Account_Model::getInstance();
    if ($currentCustomer > 0) {
      navigator::go('index.php?module=crm&page=intern-mobile', false);
    }
    $this->inputEmail = $this->getRequest()->post('email');
    $this->inputPassword = $this->getRequest()->post('password');
    if ($this->getRequest()->isPost('submit')) {
      if ($this->isValid()) {
	$this->Login($this->inputEmail, $this->inputPassword);
      } else {
	$this->message = _t('Login or password incorrect!');
      }
    }
  }

  public function isValid() {
    Application::import('Amhsoft.Core.Controls.Control');
    Application::import('Amhsoft.Core.Controls.Control.Validators.EmailValidator');
    Application::import('Amhsoft.Core.Controls.Control.Validators.StringValidator');
    $emailValidator = new EmailValidator();
    $emailValidator->setValue($this->inputEmail);
    $stringValidator = new StringValidator();
    $stringValidator->setValue($this->inputPassword);
    return ($emailValidator->isValid() & $stringValidator->isValid());
  }

  protected function Login($username, $password) {
    $lang = request::post('lang');
    if ($lang == 'ar' || $lang == 'en') { // only two languages
      Session::write('current_front_end_lang', $lang);
    }
    $this->accountModelAdapter->where('email1 = ?', $username, PDO::PARAM_STR);
    $this->accountModelAdapter->where('password = ?', sha1($password), PDO::PARAM_STR);
    $this->accountModelAdapter->limit(1);
    $result = $this->accountModelAdapter->fetch();
    if (is_object($result) && $result->rowCount() == 1) {
      $user = $result->fetch();
      Session::write('logged_customer', $user->id);
      Session::write('sessioncheck', true);
      navigator::go('index.php?module=crm&page=intern-mobile');
    } else {
      $this->message = _t('Login or password incorrect!');
    }
  }

  /**
   * Default event
   */
  public function __default() {
    $jqueryMobilePage = new JQMPage();
    //header
    $jqueryMobileHeader = new JQMHeader();
    $jqueryMobileHeader->addAttribute("style", "background: url('images/motors_souq_logo_mobile_slide.png'); margin-top:0; padding-top:0; height:110px; box-shadow: 0 0 8px 2px rgba(0, 0, 0, 0.1); border-bottom:1px solid silver");
    $jqueryMobileTitle = new JQMH1("<img src='images/motors_souq_logo_mobile.png' height='110px' align='left' />");
    $jqueryMobileTitle->addAttribute("style", "margin:0");
    $jqueryMobileHeader->addComponent($jqueryMobileTitle);
    //back button
    $jqueryMobilePage->addComponent($jqueryMobileHeader);
    //content
    $jqMobileContent = new JQMContent();
    $jqMobileContent->addComponent($this->getLoginContentFromTemplate());
    $jqueryMobilePage->addComponent($jqMobileContent);
    //footer
    $jqueryMobileFooter = new JQMFooter();
    $jqueryMobileFooter->addComponent(new JQMHtml("&copy; 2012 motorssouq bahrain. All rights protected<br />Powered & Managed by AMHSOFT"));
    $jqueryMobileFooter->setFixedPosition();
    $jqueryMobilePage->addComponent($jqueryMobileFooter);
    $this->jqueryMobileDocument->addComponent($jqueryMobilePage);
  }

  protected function getLoginContentFromTemplate() {
    template::getInstance()->assign('message', $this->message);
    $form = template::getInstance()->fetch("modules/crm/frontend/views/mobile/login.tpl.html");
    return new JQMHtml($form);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    echo $this->jqueryMobileDocument->Render();
  }

}
?>

