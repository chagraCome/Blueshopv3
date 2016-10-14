<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Import.php 409 2016-02-11 13:06:36Z imen.amhsoft $
 * $Revision: 409 $
 * $LastChangedDate: 2016-02-11 14:06:36 +0100 (jeu., 11 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Newsletter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    19.11.2010 - 11:18:34
 * @encoding   UTF-8
 */
class Newsletter_Backend_Import_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Email_Model newsletterEmailsModel */
  protected $newsletterEmailsModel;

  /** @var Newsletter_Email_Model_Adapter newsletterEmailsModelAdapter */
  protected $newsletterEmailsModelAdapter;

  /** @var boolean is update false or delete true */
  protected $is_delete = false;

  /**
   * Initialize Components.
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    $this->newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
    if ($this->id > 0) {
      $this->newsletterEmailsModel = $this->newsletterEmailsModelAdapter->fetchById($this->id);
    }
    if ($this->newsletterEmailsModel == null) {
      $this->newsletterEmailsModel = new Newsletter_Email_Model();
    }
  }

  /**
   * Default Event.
   */
  public function __default() {
    if ($this->getRequest()->isPost('save')) {
      $this->save_Click();
    } else {
      $this->getView()->setMessage(_t('Import'), View_Message_Type::INFO);
    }
  }

  /**
   * handle input
   */
  public function save_Click() {
    $this->is_delete = (bool) $this->getRequest()->postInt('is_delete');
    $group = $this->getRequest()->postInt('newsletter_email_groups_id');
    if ($group <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->newsletterEmailsModel->group = new Newsletter_Email_Group_Model($group);
    if ($this->isValid()) {
      $this->handleSuccess();
    } else {
      $this->handleError();
    }
  }

  protected function handleUpload() {
    
  }

  /**
   * handle success
   */
  protected function handleSuccess() {
    $group = new Newsletter_Email_Group_Model($this->getRequest()->postInt('newsletter_email_groups_id'));
    $csvreader = new Amhsoft_Csv_Reader($_FILES['csvfile']['tmp_name']);
    if ($csvreader->getLength() == 0) {
      $this->getView()->setMessage(_t('Invalid File Format!'), View_Message_Type::ERROR);
      return;
    }
    if ($this->is_delete == true) {
      $newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
      $newsletterEmailsModelAdapter->deleteById($this->getRequest()->postInt('newsletter_email_groups_id'));
    }
    $emailValidator = new Amhsoft_Email_Validator();
    $csvreader->rewind();
    foreach ($csvreader as $row) {
      $email_address = trim($row[0]);
      $emailValidator->setValue($email_address);
      if ($emailValidator->isValid()) {
        $newsletterEmailsModel = new Newsletter_Email_Model();
        $newsletterEmailsModel->setGroup($group);
        $newsletterEmailsModel->email =$email_address;
        $newsletterEmailsModel->state = true;
        $this->newsletterEmailsModelAdapter->save($newsletterEmailsModel);
      }
    }
    $this->getView()->setMessage(_t('Import saved'), View_Message_Type::SUCCESS);
  }

  /**
   * handle error
   */
  protected function handleError() {
    $this->getView()->setMessage(_t('Import not saved'), View_Message_Type::ERROR);
  }

  /**
   * is valid file && are valid email && groups<>0
   * @return boolean valid or not
   */
  protected function isValid() {
    return !($this->newsletterEmailsModel->group == null || is_uploaded_file($_FILES['csvfile']['tmp_name']) == false);
  }

  /**
   * Finalize.
   */
  public function __finalize() {
    $this->getView()->assign('is_delete', $this->is_delete);
    $this->getView()->assign('item', $this->newsletterEmailsModel);
    $newsletterEmailGroupsModelAdapter = new Newsletter_Email_Group_Model_Adapter();
    $groups = $newsletterEmailGroupsModelAdapter->fetch();
    $this->getView()->assign('groups', $groups);
    $this->show();
  }

}
