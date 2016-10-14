<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Read.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Backend_Inbox_Email_Read_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Panel $panel * */
  public $panel;
  public $id;

  /** @var Webmail_Inbox_Email_Model_Adapter $adapter */
  public $adapter;
  public $settingid;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->settingid = $this->getRequest()->getInt('settingid');
    if ($this->settingid <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->adapter = new Webmail_Inbox_Email_Model_Adapter($this->settingid);
    $this->getView()->setMessage(_t('Read Email'), View_Message_Type::INFO);
    $this->panel = new Webmail_Inbox_Email_Panel(_t('Email Details'));
  }

  /**
   * Default Event
   */
  public function __default() {
    $accountid = Amhsoft_Registry::get('selected_account_id');
    if (intval($accountid) > 0) {
      $accountAdapter = new Crm_Account_Model_Adapter();
      $account = $accountAdapter->fetchById($accountid);
      if ($account instanceof Crm_Account_Model) {
	$email = $this->adapter->fetchById($this->id);
	$email->getFromEmail();
	$email->assignEmailToAccount($account, $this->adapter->getSettingModel());
	$this->getView()->setMessage(_t('Email was assigned to account'), View_Message_Type::SUCCESS);
      }
    }
    Amhsoft_Registry::destroy('selected_account_id');
    $contactid = Amhsoft_Registry::get('selected_contact_id');
    if (intval($contactid) > 0) {
      $contactAdapter = new Crm_Contact_Model_Adapter();
      $contact = $contactAdapter->fetchById($contactid);
      if ($contact instanceof Crm_Contact_Model) {
	$email = $this->adapter->fetchById($this->id);
	$email->getFromEmail();
	$email->assignEmailToContact($contact, $this->adapter->getSettingModel());
	$this->getView()->setMessage(_t('Email was assigned to contact'), View_Message_Type::SUCCESS);
      }
    }
    Amhsoft_Registry::destroy('selected_contact_id');
  }

  /**
   * Panel Draw
   */
  protected function drawPanel() {
    
  }

  /**
   * Download Event
   */
  public function __download() {
    $model = $this->adapter->fetchById($this->id);
    $part = $this->getRequest()->getInt('part');
    $enc = $this->getRequest()->getInt('enc');
    if ($enc > 0 && $part > 0)
      $this->adapter->downloadAttachment($model->uid, $part, $enc);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $model = $this->adapter->fetchById($this->id);
    if (!empty($model->attachements)) {
      $this->panel->attachementPanel->setLabel(_t('Attachements'));
      foreach ($model->attachements as $att) {
	$link = 'admin.php?module=webmail&page=inbox-email-read&id=' . $model->id;
	$link .= '&part=' . $att["partNum"];
	$link .= '&enc=' . $att["enc"];
	$link .= '&event=download';
	$att['name'] = imap_utf8($att['name']);
	$this->panel->attachementPanel->addComponent(new Amhsoft_File_Link_Control($att['name'], $link));
      }
    }
    $this->panel->setDataSource(new Amhsoft_Data_Set($model));
    $this->panel->Bind();
    $e = Amhsoft_Database::querySingle("SELECT COUNT(*) FROM webmail_email WHERE from_email = '" . $model->getFromEmail() . "' AND remote_id = " . $model->id);
    if ($e) {
      $this->panel->removeByName('assignButton');
    }
    $this->getView()->assign('grid', $this->panel);
    $this->show();
  }

}

?>
