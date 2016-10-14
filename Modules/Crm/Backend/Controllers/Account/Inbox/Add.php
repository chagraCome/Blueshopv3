<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
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
class Crm_Backend_Inbox_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_MailInbox_Form $mailInboxForm */
  protected $mailInboxForm;

  /** @var Crm_MailInbox_Model $mailInboxModel */
  protected $mailInboxModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mailInboxForm = new Crm_MailInbox_Form('mailInboxForm_form', 'POST');
    $this->mailInboxModel = new Crm_MailInbox_Model();
    $this->getView()->setMessage(_t('Create new Inbox'), View_Message_Type::INFO);
    $this->mailInboxForm->personTo->Value = $this->getPersonEmail();
    $this->mailInboxForm->personTo->Disabled = true;
  }

  protected function getPersonEmail() {
    $id = $this->getRequest()->getInt('person_id');
    $personModelAdapter = new Crm_Lead_Model_Adapter();
    $personModel = $personModelAdapter->fetchById($id);
    if ($personModel instanceof Crm_Lead_Model) {
      return $personModel->getEmail();
    }
    return null;
  }

  /**
   * Default event
   */
  public function __default() {
    $this->mailInboxForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->mailInboxForm->isSend()) {
      if ($this->mailInboxForm->isValid()) {
	$this->mailInboxForm->DataBinding = $this->mailInboxModel;
	$mailInboxModelAdapter = new Crm_MailInbox_Model_Adapter();
	$this->mailInboxModel = $this->mailInboxForm->getDataBindItem();
	$this->mailInboxModel->user_id = User_User_Model::getInstance();
	$this->mailInboxModel->person_id = $this->getRequest()->getInt('person_id');
	$this->mailInboxModel->setCreateat(date('Y:m:d H:i:s'));
	$mailInboxModelAdapter->save($this->mailInboxModel);
	$this->close();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getView()->setMessage(_t('Inbox was successully added'), 'success');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->mailInboxForm);
    $this->popup();
  }

}

?>
