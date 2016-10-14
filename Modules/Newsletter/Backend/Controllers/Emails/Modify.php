<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_Modify_Controller extends Amhsoft_System_Web_Controller {

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
    $this->getView()->setMessage(_t('Modify Email'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $newsletterEmailModelAdapter = new Newsletter_Email_Model_Adapter();
      $this->newsletterEmailModel = $newsletterEmailModelAdapter->fetchById($id);
    }
    if (!$this->newsletterEmailModel instanceof Newsletter_Email_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->newsletterEmailsForm->DataSource = new Amhsoft_Data_Set($this->newsletterEmailModel);
    $this->newsletterEmailsForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->newsletterEmailsForm->isSend()) {
      $this->newsletterEmailsForm->DataSource = Amhsoft_Data_Source::Post();
      $this->newsletterEmailsForm->Bind();
      if ($this->newsletterEmailsForm->isValid()) {
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

