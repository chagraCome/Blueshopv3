<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Webmail_Backend_Email_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Email_Form webmailEmailForm */
  protected $webmailEmailForm;

  /** @var Webmail_Email_Model webmailEmailModel */
  protected $webmailEmailModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->webmailEmailForm = new Webmail_Email_Form('webmailEmailForm_form', 'POST');
    $this->webmailEmailForm->removeByName('emailtemplate');
    $this->getView()->setMessage(_t('Modify Email'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $webmailEmailModelAdapter = new Webmail_Email_Model_Adapter();
      $this->webmailEmailModel = $webmailEmailModelAdapter->fetchById($id);
    }
    if (!$this->webmailEmailModel instanceof Webmail_Email_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $attachements = $this->webmailEmailModel->getAttachements();
    if (count($attachements) > 0) {
      $attachement = new Amhsoft_Link_Control($attachements[0]->name, '#');
      $this->webmailEmailForm->attachementPanel->setLayout(new Amhsoft_Grid_Layout(2));
      $this->webmailEmailForm->attachementPanel->addComponent(new Amhsoft_Label_Control(_t('Attachement')));
      $this->webmailEmailForm->attachementPanel->addComponent($attachement);
    }
    $this->webmailEmailForm->DataSource = new Amhsoft_Data_Set($this->webmailEmailModel);
    $this->webmailEmailForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->webmailEmailForm->isSubmit()) {
      $this->saveEmail();
      $this->handleSuccess();
    }
    if ($this->webmailEmailForm->isSend()) {
      $this->saveEmail();
      $this->sendEmail();
    }
  }

  /**
   * 
   * @return Webmail_Setting_Model
   */
  public function getSettings() {
    $webmailSettingAdapter = new Webmail_Setting_Model_Adapter();
    if (intval($this->webmailEmailForm->from_email->Value) > 0) {
      $setting = $webmailSettingAdapter->fetchById($this->webmailEmailForm->from_email->Value);
      return $setting;
    } else {
      return Webmail_Setting_Model::getOutgoingSettings();
    }
  }

  /**
   * Save Email
   */
  public function saveEmail() {
    if ($this->webmailEmailForm->isFormValid()) {
      $this->webmailEmailForm->DataBinding = $this->webmailEmailModel;
      $webmailEmailModelAdapter = new Webmail_Email_Model_Adapter();
      $this->webmailEmailModel = $this->webmailEmailForm->getDataBindItem();
      $setting = $this->getSettings();
      if ($setting instanceof Webmail_Setting_Model) {
	if ($setting instanceof Webmail_Setting_Model) {
	  $this->webmailEmailModel->from_email = $setting->getEmail();
	  $this->webmailEmailModel->from_name = $setting->getName();
	}
      }
      $webmailEmailModelAdapter->save($this->webmailEmailModel);
    } else {
      $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
    }
  }

  /**
   * Send Email
   * @return type
   */
  public function sendEmail() {
    $mailClient = new Amhsoft_Mail_Client();
    $setting = $this->getSettings();
    if ($setting instanceof Webmail_Setting_Model) {
      $mailClient->setOptions($setting->getMailClientOptions());
      $mailClient->IsSMTP();
    }
    $emailValidator = new Amhsoft_Email_Validator();
    $emailValidator->setValue($this->webmailEmailModel->getTo_emails());
    if (!$emailValidator->isValid()) {
      $this->getView()->setMessage($this->webmailEmailModel->getTo_emails() . ' ' . _t('is not a valid email address'), View_Message_Type::ERROR);
      return; //nothing to do
    }
    $mailClient->AddAddress($this->webmailEmailModel->getTo_emails());
    if ($this->webmailEmailModel->getBcc_emails()) {
      $mailClient->AddBCC($this->webmailEmailModel->getBcc_emails());
    }
    if ($this->webmailEmailModel->getCc_emails()) {
      $mailClient->AddCC($this->webmailEmailModel->getCc_emails());
    }
    $mailClient->setSubject($this->webmailEmailModel->getSubject());
    $mailClient->SetHtmlBody(@htmlspecialchars_decode($this->webmailEmailModel->getContent()));
    $attachement = $this->getRequest()->get('docid');
    if (file_exists($attachement)) {
      $mailClient->AddAttachment($attachement);
    }
    $attachements = $this->webmailEmailModel->getAttachements();
    if (count($attachements) > 0) {
      @file_put_contents('cache/' . $attachements[0]->getName(), $attachements[0]->getBinary());
      if (file_exists('cache/' . $attachements[0]->getName())) {
	$mailClient->AddAttachment('cache/' . $attachements[0]->getName());
      }
      $mailClient->Send();
      if (file_exists('cache/' . $attachements[0]->getName())) {
	@unlink('cache/' . $attachements[0]->getName());
      }
    } else {
      $mailClient->Send();
    }
    if ($mailClient->IsError()) {
      $this->getView()->setMessage($mailClient->getError(), View_Message_Type::ERROR);
      $this->webmailEmailModel->setState(Webmail_Email_Model::FAILED);
    } else {
      $this->getView()->setMessage(_t('Email was successfully sent!'), View_Message_Type::SUCCESS);
      $this->webmailEmailModel->setState(Webmail_Email_Model::SEND);
    }
    $webmailEmailModelAdapter = new Webmail_Email_Model_Adapter();
    $webmailEmailModelAdapter->save($this->webmailEmailModel);
  }

  /**
   * DownLead Event
   */
  public function __download() {
    
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->webmailEmailForm);
    $this->show();
  }

}

?>