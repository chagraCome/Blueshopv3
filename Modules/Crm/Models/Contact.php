<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Contact.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Crm_Frontend_Request_Contact_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Request_Contact_Form crmRequestContactForm */
  protected $crmRequestContactForm;

  /** @var Crm_Contact_Model crmContactModel */
  protected $crmContactModel;

  public function __initialize() {
    $this->crmRequestContactForm = new Crm_Request_Contact_Form('crmRequestContactForm_form', 'POST');
    $this->crmContactModel = new Crm_Contact_Model();
    $this->getView()->setMessage(_t('Request Contact'), View_Message_Type::INFO);
  }

  public function __default() {
    $this->crmRequestContactForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->crmRequestContactForm->isSend()) {
      if ($this->crmRequestContactForm->isValid()) {
	$data = $this->crmRequestContactForm->getValues();
	$crmContactModelAdapter = new Crm_Contact_Model_Adapter();
	$this->crmContactModel->setFirstname($data['name']);
	$this->crmContactModel->setMobile($data['mobile']);
	$this->crmContactModel->setEmail($data['email1']);
	$this->crmContactModel->setCompany($data['company_name']);
	$notice = 'Best call time is : ' . $data['calltime'] . "<br/>";
	$notice .= 'Company Name : ' . $data['company_name'] . "<br/>";
	$notice .='Company Url : ' . $data['company_url'] . "<br />";
	$notice .='Message : ' . $data['message'];
	$this->crmContactModel->setNotice($notice);
	$this->crmContactModel->contact_group_id = 326;
	$this->crmContactModel->create_date_time = Amhsoft_Locale::UCTDateTime();
	$this->crmContactModel->update_date_time = Amhsoft_Locale::UCTDateTime();
	$crmContactModelAdapter->save($this->crmContactModel);
	$this->handleSuccess();
      } else {
	//$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $notifier = new Crm_Notification_Contact_Model();
    $notifier->notifyAdminContactAdded($this->crmContactModel);
    $this->getView()->assign('success', true);
  }

  public function __finalize() {
    $this->getView()->assign('widget', $this->crmRequestContactForm);
    $this->show();
  }

}
?>

