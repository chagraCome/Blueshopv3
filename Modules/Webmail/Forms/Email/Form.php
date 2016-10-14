<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Email_Form extends Amhsoft_Widget_Form {

  public $from_email;
  public $to_emails;
  public $cc_emails;
  public $bcc_emails;
  public $subject;
  public $content;
  public $submitButton;
  public $sendButton;

  /** @var Amhsoft_Widget_Panel $attachementPanel */
  public $attachementPanel;

  /** @var Amhsoft_DirectoryInput_Control $templateDirectoryInput */
  public $templateDirectoryInput;
  public $target;
  public $target_id;
  public $attachement;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Set Target
   * @param type $target
   */
  public function setTarget($target) {
    $this->target = $target;
    $this->templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist&target=' . $this->target . '&target_id=' . $this->target_id;
  }

  /**
   * Set Target Id
   * @param type $target_id
   */
  public function setTargetId($target_id) {
    $this->target_id = $target_id;
    $this->templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist&target=' . $this->target . '&target_id=' . $this->target_id;
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->templateDirectoryInput = new Amhsoft_DirectoryInput_Control('emailtemplate', _t('Select from template'));
    $this->templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist&target=' . $this->target . '&target_id=' . $this->target_id;
    $this->templateDirectoryInput->OnlyIcon = true;
    $panel = new Amhsoft_Widget_Panel(_t('Header'));
    $fromDataSource = array();
    $webmailSettingAdapter = new Webmail_Setting_Model_Adapter();
    $webmailSettingAdapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
    $result = $webmailSettingAdapter->fetch();
    foreach ($result as $r) {
      $fromDataSource[] = array('id' => $r->getId(), 'name' => $r->getName() . '<' . $r->getEmail() . '>');
    }
    $this->from_email = new Amhsoft_ListBox_Control('from_email', _t('From'));
    $this->from_email->DataBinding = new Amhsoft_Data_Binding('from_email', 'id', 'name');
    $this->from_email->DataSource = new Amhsoft_Data_Set($fromDataSource);
    $this->from_email->setWidth(400);
    $this->from_email->Required = true;
    $panel->addComponent($this->from_email);
    $this->to_emails = new Amhsoft_Input_Control('to_emails', _t('To'));
    $this->to_emails->DataBinding = new Amhsoft_Data_Binding('to_emails');
    $this->to_emails->setWidth(400);
    $this->to_emails->Required = true;
    $panel->addComponent($this->to_emails);
    $this->cc_emails = new Amhsoft_Input_Control('cc_emails', _t('Cc'));
    $this->cc_emails->DataBinding = new Amhsoft_Data_Binding('cc_emails');
    $this->cc_emails->setWidth(400);
    $panel->addComponent($this->cc_emails);
    $this->bcc_emails = new Amhsoft_Input_Control('bcc_emails', _t('Bcc'));
    $this->bcc_emails->DataBinding = new Amhsoft_Data_Binding('bcc_emails');
    $this->bcc_emails->setWidth(400);
    $panel->addComponent($this->bcc_emails);
    $this->addComponent($panel);
    $panelContent = new Amhsoft_Widget_Panel(_t('Email Content'));
    $panelSubject = new Amhsoft_Widget_Panel(_t('Subject'));
    $panelSubject->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Abstract_Layout::APPEND));
    $this->subject = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subject->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subject->setWidth(400);
    $this->subject->Required = true;
    $panelSubject->addComponent($this->subject);
    $panelSubject->addComponent($this->templateDirectoryInput);
    $this->addComponent($panelSubject);
    $docid = Amhsoft_Web_Request::get('docid');
    $this->attachementPanel = new Amhsoft_Widget_Panel(_t('Attachement'));
    $docids = explode("/", $docid);
    if (file_exists($docid) && count($docids) > 0 && $docids[0] == 'media' && !preg_match("/\.\./", $docid)) {
      $name = end($docids);
      $this->attachement = new Amhsoft_Link_Control($name, $docid);
      $this->attachementPanel = new Amhsoft_Widget_Panel(_t('Attachement'));
      $this->attachementPanel->setLayout(new Amhsoft_Grid_Layout(2));
      $this->attachementPanel->addComponent(new Amhsoft_Label_Control(_t('Attachement')));
      $this->attachementPanel->addComponent($this->attachement);
    }
    $this->addComponent($this->attachementPanel);
    $this->content = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
    $this->content->DataBinding = new Amhsoft_Data_Binding('content');
    $this->content->Required = true;
    $panelContent->addComponent($this->content);
    $this->addComponent($panelContent);
    $panelAction = new Amhsoft_Widget_Panel(_t('Action'));
    $panelAction->setLayout(new Amhsoft_Grid_Layout(2), Amhsoft_Abstract_Layout::APPEND);
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save Email"));
    $this->submitButton->Class = "ButtonSave";
    $panelAction->addComponent($this->submitButton);
    $this->sendButton = new Amhsoft_Button_Submit_Control("send", _t("Send Email"));
    $this->sendButton->Class = "ButtonSave";
    $panelAction->addComponent($this->sendButton);
    $this->addComponent($panelAction);
  }

  /**
   * Send Form
   * @return type
   */
  public function isSend() {
    return isset($_POST["send"]);
  }

  /**
   * Submit Form
   * @return type
   */
  public function isSubmit() {
    return isset($_POST["submit"]);
  }

}

?>