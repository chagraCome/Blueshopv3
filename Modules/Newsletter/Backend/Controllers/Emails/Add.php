<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Emails_Form newsletterEmailsForm */
  protected $newsletterEmailsForm;

  /** @var Newsletter_Email_Model newsletterEmailModel */
  protected $newsletterEmailModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->newsletterEmailsForm = new Newsletter_Emails_Form('newsletterEmailsForm_form', 'POST');
    $this->newsletterEmailsForm->findByName('email')->addValidator('Unique|newsletter_emails|email');
    $this->getView()->setMessage(_t('Add Email'), View_Message_Type::INFO);
   $this->newsletterEmailModel = new Newsletter_Email_Model();
   $this->newsletterEmailModel->setState(true);
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->newsletterEmailsForm->isSend()) {
      if ($this->newsletterEmailsForm->isFormValid()) {
	$this->newsletterEmailsForm->DataBinding = $this->newsletterEmailModel;
	$newsletterEmailModelAdapter = new Newsletter_Email_Model_Adapter();
	$this->newsletterEmailModel = $this->newsletterEmailsForm->getDataBindItem();
	$newsletterEmailModelAdapter->save($this->newsletterEmailModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    Amhsoft_Navigator::go('admin.php?module=newsletter&page=emails-list&ret=true');
  }

  /**
   * Finalize Controller
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->newsletterEmailsForm);
    $this->show();
  }

}
?>