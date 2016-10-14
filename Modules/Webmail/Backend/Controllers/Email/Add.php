<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Webmail_Backend_Email_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Email_Form webmailEmailForm */
  protected $webmailEmailForm;

  /** @var Webmail_Email_Model webmailEmailModel */
  protected $webmailEmailModel;
  protected $targetId;
  protected $target;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->target = $this->getRequest()->get('target');
    $this->targetId = $this->getRequest()->getInt('targetid');
    if (!$this->target || $this->targetId <= 0) {
      Amhsoft_Log::error("Webmail add: target not found");
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->webmailEmailForm = new Webmail_Email_Form('webmailEmailForm_form', 'POST');
    $this->webmailEmailForm->setTarget($this->target);
    $this->webmailEmailForm->setTargetId($this->targetId);
    $this->webmailEmailForm->to_emails->Value = $this->getRequest()->get('to');
    $this->webmailEmailModel = new Webmail_Email_Model();
    $this->webmailEmailModel = new Webmail_Email_Model();
    $this->getView()->setMessage(_t('Add Email'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->webmailEmailForm->isSend()) {
      $this->webmailEmailModel->state = Webmail_Email_Model::SEND;
      $this->sendEmailCallBack();
      $this->handleSuccess();
    }
    if ($this->webmailEmailForm->isSubmit()) {
      $this->webmailEmailModel->state = Webmail_Email_Model::DRAFT;
      $this->saveCallBack();
      $this->handleSuccess();
    }
  }

  /**
   * Get Mail Setting
   * @return type
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
   * Send Email
   * @return type
   */
  protected function sendEmailCallBack() {
    $this->saveCallBack();
    if ($this->webmailEmailModel->getId() > 0) {
      $webmailModelAdapter = new Webmail_Email_Model_Adapter();
      $this->webmailEmailModel = $webmailModelAdapter->fetchById($this->webmailEmailModel->getId());
    }
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
  
    $attachements = $this->webmailEmailModel->getAttachements();
    if (count($attachements) > 0) {
      @file_put_contents('cache/' . @$attachements[0]->getName(), @$attachements[0]->getBinary());
      if (file_exists('cache/' . @$attachements[0]->getName())) {
        $mailClient->AddAttachment('cache/' . @$attachements[0]->getName());
      }
      $mailClient->Send();
      if (file_exists('cache/' . @$attachements[0]->getName())) {
        @unlink('cache/' . @$attachements[0]->getName());
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
   * Save CallBack
   * @return type
   */
  protected function saveCallBack() {
    if ($this->webmailEmailForm->isFormValid()) {
      $this->webmailEmailForm->DataBinding = $this->webmailEmailModel;
      $webmailEmailModelAdapter = new Webmail_Email_Model_Adapter();
      $this->webmailEmailModel = $this->webmailEmailForm->getDataBindItem();
      $this->webmailEmailModel->createat = Amhsoft_Locale::UCTDateTime();
      $this->webmailEmailModel->sendat = Amhsoft_Locale::UCTDateTime();
      $webmailSettingAdapter = new Webmail_Setting_Model_Adapter();
      if (intval($this->webmailEmailForm->from_email->Value) > 0) {
        $setting = $webmailSettingAdapter->fetchById($this->webmailEmailForm->from_email->Value);
        if ($setting instanceof Webmail_Setting_Model) {
          $this->webmailEmailModel->from_email = $setting->getEmail();
          $this->webmailEmailModel->from_name = $setting->getName();
        }
      }
      $webmailEmailModelAdapter->save($this->webmailEmailModel);
      $docId = $this->getRequest()->get('docid');
      $docids = explode("/", $docId);
      if (file_exists($docId) && count($docids) > 0 && $docids[0] == 'media' && !preg_match("/\.\./", $docid)) {
        $attachement = Webmail_Email_Attachment_Model::fromFile($docId);
        if ($attachement instanceof Webmail_Email_Attachment_Model) {
          $adapter = new Webmail_Email_Attachment_Model_Adapter();
          $attachement->webmail_email_id = $this->webmailEmailModel->getId();
          $adapter->save($attachement);
        }
      }
      if ($this->webmailEmailModel->getId() > 0) {
        return $this->webmailEmailModel;
      }
    } else {
      $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $db = Amhsoft_Database::getInstance();
    $accountId = $this->getRequest()->getInt('acc_id');
    $contactId = $this->getRequest()->getInt('contact_id');
    try {
      if ($this->target == 'account') {
        $sql = "INSERT INTO `account_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $this->targetId . " )";
        $db->exec($sql);
      }
      if ($this->target == 'contact') {
        $sql = "INSERT INTO `contact_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $this->targetId . " )";
        $db->exec($sql);
      }
      if ($this->target == 'lead') {
        $sql = "INSERT INTO `lead_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $this->targetId . " )";
        $db->exec($sql);
      }
      if ($this->target == 'quotation') {
        if ($accountId > 0) {
          $sql1 = "INSERT INTO `account_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $accountId . " )";
          $db->exec($sql1);
        }
        if ($contactId > 0) {
          $sql1 = "INSERT INTO `contact_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $contactId . " )";
          $db->exec($sql1);
        }
        $sql2 = "INSERT INTO `quotation_has_email` VALUES (" . $this->targetId . "," . $this->webmailEmailModel->getId() . " )";
        $db->exec($sql2);
      }
      if ($this->target == 'saleorder') {
        if ($accountId > 0) {
          $sql1 = "INSERT INTO `account_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $accountId . " )";
          $db->exec($sql1);
        }
        if ($contactId > 0) {
          $sql1 = "INSERT INTO `contact_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $contactId . " )";
          $db->exec($sql1);
        }
        $sql2 = "INSERT INTO `saleorder_has_email` VALUES (" . $this->targetId . "," . $this->webmailEmailModel->getId() . " )";
        $db->exec($sql2);
      }
      if ($this->target == 'invoice') {
        if ($accountId > 0) {
          $sql1 = "INSERT INTO `account_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $accountId . " )";
          $db->exec($sql1);
        }
        if ($contactId > 0) {
          $sql1 = "INSERT INTO `contact_has_email` VALUES (" . $this->webmailEmailModel->getId() . "," . $contactId . " )";
          $db->exec($sql1);
        }
        $sql2 = "INSERT INTO `invoice_has_email` VALUES (" . $this->targetId . "," . $this->webmailEmailModel->getId() . " )";
        $db->exec($sql2);
      }
    } catch (Exception $e) {
      Amhsoft_Log::error($e->getMessage());
    }
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