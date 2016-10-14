<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Coupon.php 363 2016-02-09 14:56:46Z imen.amhsoft $
 * $Rev: 363 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:56:46 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:56:46 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Coupon_Backend_Coupon_Controller extends Amhsoft_System_Web_Controller {

  public $Model;
  public $mainpanel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainpanel = new Coupon_Code_Execute_Panel();
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $ModelAdapter = new Coupon_Model_Adapter();
      $this->Model = $ModelAdapter->fetchById($id);
      if (!$this->Model instanceof Coupon_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
      if (!Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    Amhsoft_Registry::register('coupon_id_for_replace', $this->Model->id);
    $this->getView()->setMessage(_t('Send Coupon'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->generateEmailSendForm();

    if ($this->getRequest()->isPost('send')) {
      if ($this->form->isFormValid()) {

	$values = $this->form->getValues();
	$this->handleEmails($values);
      }
    }
  }

  protected function generateEmailSendForm() {
    $this->form = new Amhsoft_Widget_Form('form', 'POST');

    $emailPanel = new Amhsoft_Widget_Panel(_t('Send Coupon Email'));
//    $useCoupon = new Amhsoft_ListBox_Control('coupon', _t('Coupon'));
//    $useCoupon->DataBinding = new Amhsoft_Data_Binding('coupon', 'id', 'name');
//    $useCoupon->DataSource = new Amhsoft_Data_Set(new Coupon_Model_Adapter);
//    $useCoupon->setWidth(250);
//    $useCoupon->Required = TRUE;

    $useEmailOnRegistration = new Amhsoft_ListBox_Control('email_from', _t('From'));
    $useEmailOnRegistration->DataBinding = new Amhsoft_Data_Binding('email_from', 'id', 'email');
    $adapter = new Webmail_Setting_Model_Adapter();
    $adapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
    $useEmailOnRegistration->DataSource = new Amhsoft_Data_Set($adapter);
    $useEmailOnRegistration->setWidth(250);
    $useEmailOnRegistration->Required = TRUE;

    //$emailPanel->addComponent($useCoupon);
    $emailPanel->addComponent($useEmailOnRegistration);
    $content = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
    $content->DataBinding = new Amhsoft_Data_Binding('content');
    $content->Required = true;
    $templateDirectoryInput = new Amhsoft_DirectoryInput_Control('emailtemplate', _t('Select from template'));
    $templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist';
    $templateDirectoryInput->OnlyIcon = true;
    $subject = new Amhsoft_Input_Control('subject', _t('Subject'));
    $subject->DataBinding = new Amhsoft_Data_Binding('subject');
    $subject->setWidth(400);
    $subject->Required = true;
    $panelSubject = new Amhsoft_Widget_Panel();
    $panelSubject->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Abstract_Layout::APPEND));
    $panelSubject->addComponent($subject);
    $panelSubject->addComponent($templateDirectoryInput);
    $emailPanel->addComponent($panelSubject);
    $variableList = new Amhsoft_WorkFlow_Attribute_ListBox_Control('variablelist', 'variablelist', _t('Variables'));
    $variableList->JavaScript = 'appendToTinyMce(this.value)';
    $emailPanel->addComponent($variableList);
    $emailPanel->addComponent($content);
    $panelAction = new Amhsoft_Widget_Panel(_t('Action'));
    $panelAction->setLayout(new Amhsoft_Grid_Layout(2), Amhsoft_Abstract_Layout::APPEND);
    $sendButton = new Amhsoft_Button_Submit_Control("send", _t("Send Email"));
    $sendButton->Class = "ButtonEmail";
    $panelAction->addComponent($sendButton);
    $this->form->addComponent($emailPanel);
    $this->form->addComponent($panelAction);
    $this->mainpanel->addComponent($this->form);
  }

  protected function handleEmails($values) {
    $this->handleSuccess($values['subject'], $values['content'], $values['email_from'], $this->Model->id);
  }

  function remove_duplicate($items) {
    $count = count($items);
    $names = array();
    $items1 = array();
    for ($i = 0; $i < $count; $i++) {
      if ($items[$i] instanceof Crm_Account_Model) {
	if (!in_array($items[$i]->email1, $names)) {
	  $names[] = $items[$i]->email1;
	  $items1[] = $items[$i];
	}
      } elseif ($items[$i] instanceof Crm_Contact_Model) {
	if (!in_array($items[$i]->email, $names)) {
	  $names[] = $items[$i]->email;
	  $items1[] = $items[$i];
	}
      }
    }
    return $items1;
  }

  protected function handleSuccess($subject, $content, $from, $coupon) {

    $id = $coupon;
    $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
    $crmAccountModelAdapter->leftJoinWithoutCardinality('coupon_account', 'id', 'coupon_account.account_id');
    $crmAccountModelAdapter->where('coupon_account.coupon_id = ?', $id);
    $crmAccountModelAdapter->groupBy('email1');
    $accounts = $crmAccountModelAdapter->fetch();
    $crmContactModelAdapter = new Crm_Contact_Model_Adapter();
    $crmContactModelAdapter->leftJoinWithoutCardinality('coupon_contact', 'id', 'contact_id');
    $crmContactModelAdapter->where('coupon_contact.coupon_id = ?', $id);
    $crmContactModelAdapter->groupBy('email');
    $contacts = $crmContactModelAdapter->fetch();


    $count = 0;
    $count = $crmAccountModelAdapter->getCount() + $crmContactModelAdapter->getCount();
    if ($count == 0) {
      return;
    }
    $attachmentArr = Coupon_Code_Model::generateCodeForMarketing($coupon);
    if ($attachmentArr == 0) {
      return;
    }
    $waitTime = rand(1, 3); //anti spam wait a time between 1 and 3 sec.
    $emaiTemplateModel = new Setting_Template_Email_Model();
    $emaiTemplateModel->setContent($content);

    foreach ($accounts as $account) {
      $this->sendEmail($account->getEmail(), $subject, $emaiTemplateModel->getFilledContent(array($account, $attachmentArr[1])), $from, $attachmentArr[0]);
      sleep($waitTime);
    }
    foreach ($contacts as $contact) {
      $this->sendEmail($contact->getEmail(), $subject, $emaiTemplateModel->getFilledContent(array($contact, $attachmentArr[1])), $from, $attachmentArr[0]);
      sleep($waitTime);
    }
    $this->getView()->setMessage(_t('Coupon E-Mails sent'), View_Message_Type::SUCCESS);
  }

  public function sendEmail($to, $subject, $message, $from, $attachment) {
    $mailClient = new Amhsoft_Mail_Client(null, $from);
    $data = Webmail_Setting_Model::getMailClientOptionsById($from);
    $mailClient->AddAddress($to);
    $mailClient->setSubject($subject);
    $mailClient->SetFrom(@$data['From']);
    if (file_exists($attachment)) {
      $mailClient->AddAttachment($attachment);
    }
    $mailClient->SetHtmlBody(htmlspecialchars_decode($message));
    $mailClient->Send();
    if ($mailClient->IsError()) {
      Amhsoft_Log::error('cannot send email', $mailClient);
      return FALSE;
    }
    return true;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->mainpanel->DataSource = new Amhsoft_Data_Set($this->Model);
    $this->mainpanel->Bind();
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
      $this->getView()->assign('coupon', TRUE);
    }
    $this->getView()->assign('widget', $this->mainpanel);
    $this->show();
  }

}

?>
