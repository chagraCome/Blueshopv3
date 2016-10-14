<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
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
class Crm_Backend_Inbox_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var MailInboxForm $mailInboxForm */
  protected $mailInboxForm;

  /** @var Crm_MailInbox_Model $mailInboxModel */
  protected $mailInboxModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mailInboxForm = new Crm_MailInbox_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Inbox'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $mailInboxModelAdapter = new Crm_MailInbox_Model_Adapter();
      $this->mailInboxModel = $mailInboxModelAdapter->fetchById($id);
    }
    if (!$this->mailInboxModel instanceof Crm_MailInbox_Model) {
      die('Requested Inbox not found');
    }
    $this->mailInboxForm->DataSource = new Amhsoft_Data_Set($this->mailInboxModel);
    $this->mailInboxForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {

    if ($this->mailInboxForm->isSend()) {
      $this->mailInboxForm->DataSource = Amhsoft_Data_Source::Post();
      $this->mailInboxForm->Bind();
      if ($this->mailInboxForm->isValid()) {
	$this->mailInboxForm->DataBinding = $this->mailInboxModel;
	$mailInboxModelAdapter = new Crm_MailInbox_Model_Adapter();
	$this->mailInboxModel = $this->mailInboxForm->getDataBindItem();
	$mailInboxModelAdapter->save($this->mailInboxModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back());
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
