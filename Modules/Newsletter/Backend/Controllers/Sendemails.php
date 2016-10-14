<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Sendemails.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    Newsletter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    19.11.2010 - 17:37:07
 * @encoding   UTF-8
 */
class Newsletter_Backend_Sendemails_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Email_Model newsletterEmailsModel */
  protected $newsletterEmailsModel;

  /** @var Newsletter_Email_Model_Adapter newsletterEmailsModelAdapter */
  protected $newsletterEmailsModelAdapter;

  /** @var Newsletter_Email_Group_Model groupModel */
  protected $emailGroupsModel;

  /** @var Newsletter_Template_Model temlpatesModel */
  protected $templatesModel;

  /**
   * Initialize Components.
   */
  public function __initialize() {
    $this->newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
    if ($this->newsletterEmailsModel == null) {
      $this->newsletterEmailsModel = new Newsletter_Email_Model();
      $this->newsletterEmailGroupsModel = new Newsletter_Email_Group_Model();
      $this->newsletterTemplatessModel = new Newsletter_Template_Model();
    }
  }

  /**
   * Default Event.
   */
  public function __default() {
    if ($this->getRequest()->isPost('save')) {
      $this->save_Click();
    } else {
      $this->getView()->setMessage(_t('Send E-Mails'), View_Message_Type::INFO);
    }
  }

  /**
   * handle input
   */
  public function save_Click() {
    $Configuration = new Amhsoft_Config_Table_Adapter('newsletter');
    $Configuration->setValue('newsletter_sendfrom', $this->getRequest()->post('outgoing_id'));
    $this->emailGroupsModelAdapter = new Newsletter_Email_Group_Model_Adapter();
    $this->templatesModelAdapter = new Newsletter_Template_Model_Adapter();
    $this->groupModel = $this->emailGroupsModelAdapter->fetchById($this->getRequest()->postInt('newsletter_email_groups_id'));
    $this->templateModel = $this->templatesModelAdapter->fetchById($this->getRequest()->postInt('newsletter_templates_id'));
    if ($this->isValid()) {
      $this->handleSuccess();
    } else {
      $this->handleError();
    }
  }

  /**
   * handle success
   */
  protected function handleSuccess() {
    $newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
    $newsletterEmailsModelAdapter->where('state = ?', true);
    $newsletterEmailsModelAdapter->where('newsletter_email_groups_id = ?', $this->getRequest()->postInt('newsletter_email_groups_id'));
    $emails = $newsletterEmailsModelAdapter->fetch();
    $Configuration = new Amhsoft_Config_Table_Adapter('newsletter');
    $phpmailer = new Amhsoft_Mail_Client(null, $Configuration->getValue('newsletter_sendfrom'));
    $phpmailer->setSubject($this->templateModel->title);
    $phpmailer->setHTMLBody(htmlspecialchars_decode($this->templateModel->content));
    
    $i = 0;
    foreach ($emails as $email) {
      $phpmailer->AddBCC($email->email);
      $i++;
      if($i % 50 == 0){
        $phpmailer->Send();
        sleep(rand(6, 12));
      }
    }
    
    $phpmailer->Send();
    $this->getView()->setMessage(_t('E-Mails sent'), View_Message_Type::SUCCESS);
  }

  /**
   * handle error
   */
  protected function handleError() {
    $this->getView()->setMessage(_t('Error by sending E-Mails'), View_Message_Type::ERROR);
  }

  /**
   * is valid if template != null && groups != null
   * @return boolean valid or not
   */
  protected function isValid() {
    return !($this->groupModel == null || $this->templateModel == null);
  }

  /**
   * Finalize.
   */
  public function __finalize() {
    $newsletterTemplatesModelAdapter = new Newsletter_Template_Model_Adapter();
    $newsletterEmailGroupsModelAdapter = new Newsletter_Email_Group_Model_Adapter();
    $webmailemailModelAdapter = new Webmail_Setting_Model_Adapter();
    $templates = $newsletterTemplatesModelAdapter->fetch();
    $groups = $newsletterEmailGroupsModelAdapter->fetch();
    $outgoing = $webmailemailModelAdapter->fetch();
    $this->getView()->assign('templates', $templates);
    $this->getView()->assign('groups', $groups);
    $this->getView()->assign('outgoing', $outgoing);
    $this->show();
  }

}
