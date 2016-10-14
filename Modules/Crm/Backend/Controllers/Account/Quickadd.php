<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quickadd.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of add
 *
 * @author cherif
 */
class Crm_Backend_Account_Quickadd_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_Form $accountForm */
  public $accountForm;

  /** @var Crm_Account_Model $accountModel */
  public $accountModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->accountForm = new Crm_Account_Form('account_form', 'POST');
    $this->accountForm->removeByName('can_login');
    $this->accountForm->removeByName('send_password');
    $this->accountForm->removeByName('logosrc');
    $this->accountForm->removeByName('zipcode');
    $this->accountForm->removeByName('street');
    $this->accountForm->removeByName('city');
    $this->accountForm->removeByName('province');
    $this->accountForm->removeByName('notice');
    $this->accountForm->removeByName('email2');
    $this->accountForm->removeByName('mobile');
    $this->accountForm->removeByName('telefon');
    $this->accountForm->removeByName('company_website');
    $this->accountForm->removeByName('company_name');
    $this->getView()->setMessage(_t('Add Account'), View_Message_Type::INFO);
    $accountModel = new Crm_Account_Model();
    $this->accountForm->numberInput->Value = $accountModel->getNextAccountNumber();
  }

  /**
   * Default event
   */
  public function __default() {
    $this->accountForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->accountForm->isSend()) {
      if ($this->accountForm->isFormValid()) {
	$data = $this->accountForm->getValues();
	$this->accountModel = new Crm_Account_Model();
	$this->accountForm->DataBinding = $this->accountModel;
	$this->accountForm->Bind();
	$this->accountModel = $this->accountForm->getDataBindItem();
	$accountModelAdapter = new Crm_Account_Model_Adapter();
	$this->accountModel->register_date_time = Amhsoft_Locale::UCTDateTime();
	if (!$this->accountModel->password) {
	  $this->accountModel->password = Amhsoft_Common::randomPassword(6);
	}
	$decryptedPassword = $this->accountModel->getPassword();
	$this->accountModel->password = sha1($decryptedPassword);
	if (@$_POST['can_login']) {
	  $this->accountModel->setState(1);
	}
	$accountModelAdapter->save($this->accountModel);
	if ($this->accountModel->getId() > 0) {
	  $this->createContact();
	  if ($_POST['send_password'] == 1) {
	    $notificationModel = new Crm_Notification_Account_Model($this->accountModel);
	    $notificationModel->sendPassword($decryptedPassword);
	  }
	  @unlink('media/dealer/' . $this->accountModel->getId() . '.jpg'); //remove it if exists
	  $this->accountForm->dealerLogo->getUploadControl()->uploadTo('media/dealer/' . $this->accountModel->getId() . '.jpg');
	}
	$this->handleSucces();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  protected function handleSucces() {
    if ($this->getRequest()->get('refresh') == 'true') {
      Amhsoft_Registry::register('selected_account_id', $this->accountModel->getId());
      $this->close();
    } else {
      $this->close(array('account' => $this->accountModel->getName(), 'account_id' => $this->accountModel->getId()));
    }
  }

  protected function createContact() {
    $contactModel = new Crm_Contact_Model();
    $contactModel->number = $contactModel->getNextContactNumber();
    $contactModel->setFirstname($this->accountModel->getName());
    $contactModel->setCreatedatetime(Amhsoft_Locale::UCTDateTime());
    $contactModel->setEmail($this->accountModel->getEmail());
    $contactModel->setMobile($this->accountModel->getMobile());
    $contactModel->setPhone($this->accountModel->getPhone());
    $contactModel->setState($this->accountModel->getState());
    $contactModel->account = $this->accountModel;
    $contactModel->account_id = $this->accountModel->getId();
    $contactModel->company = $this->accountModel->getCompany_name();
    $contactModel->company_website = $this->accountModel->getCompany_website();
    $contactModelAdaprer = new Crm_Contact_Model_Adapter();
    $contactModelAdaprer->save($contactModel);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->accountForm);
    $this->popup();
  }

}

?>
