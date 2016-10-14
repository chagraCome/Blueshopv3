<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Webmail_Backend_Inbox_Email_List_Controller extends Amhsoft_System_Web_Controller implements Amhsoft_System_Runnable {

  protected $dataGridView;
  protected $set;
  protected $settingid;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->settingid = $this->getRequest()->getInt('settingid');
    $this->getView()->setMessage(_t('List Inbox Emails'), View_Message_Type::INFO);
    $this->dataGridView = new Amhsoft_Widget_DataGridView(array(
	'from' => _t('From'),
	'subject' => _t('Subject'),
	'date' => _t('Date')
    ));
    $startCol = new Amhsoft_YesNo_Star_Control(_t('Assigned'), new Amhsoft_Data_Binding('star'));
    $startCol->Tag = $this->settingid;
    $startCol->Value = 0;
    $this->dataGridView->addColum($startCol);
    $detailsLink = new Amhsoft_Link_Control(_t('Open'), '?module=webmail&page=inbox-email-read&settingid=' . $this->settingid);
    $detailsLink->DataBinding = new Amhsoft_Data_Binding('id');
    $detailsLink->Class = 'details';
    $this->dataGridView->AddColumn($detailsLink);
    $inboxModelAdapter = new Webmail_Inbox_Email_Model_Adapter($this->settingid);
    try {
      $cache_file = 'cache/lastupdate_account_' . $this->settingid;
      $date = false;
      if (file_exists($cache_file)) {
	$date = @file_get_contents($cache_file);
      }
      if (!$date) {
	$date = date("d-M-Y", strtotime("-14 days"));
      }
      $this->set = $inboxModelAdapter->fetch("SINCE $date", 'Inbox');
     
     
      $sent = $inboxModelAdapter->fetch("SINCE $date", 'Inbox.Sent');
       $inboxModelAdapter->close();
      $this->set = array_merge(is_array($this->set) ? $this->set : array(), is_array($sent) ? $sent : array());

      foreach ($this->set as $s) {
	$account = $s->findAccount();
	if ($account instanceof Crm_Account_Model) {
	  $s->assignEmailToAccount($account, $inboxModelAdapter->getSettingModel());
	}
	$contact = $s->findContact();
	if ($contact instanceof Crm_Contact_Model) {
	  $s->assignEmailToContact($contact, $inboxModelAdapter->getSettingModel());
	}
      }
      $date = date("d-M-Y", strtotime("-3 days"));
      file_put_contents($cache_file, $date);
      $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->set);
      $this->dataGridView->onRowDraw->registerEvent($this, 'onRowDraw_CallBack');
    } catch (Exception $e) {
      $this->getView()->setMessage(_t("No Server Settings found"), View_Message_Type::ERROR);
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  /**
   * Scan Email Event
   */
  public function __scan() {
    $thread = new Amhsoft_System_Thread($this);
    $thread->execute();
    $this->getView()->setMessage(_t('Email will be scanned'), View_Message_Type::SUCCESS);
  }

  /**
   * On RowDraw 
   * @param type $colIndex
   * @param Amhsoft_Abstract_Control $control
   * @param type $object
   */
  public static function onRowDraw_CallBack($colIndex, Amhsoft_Abstract_Control $control, $object) {
    if ($control->DataBinding->Value == 'star') {
      $control->Value = Amhsoft_Database::querySingle("SELECT COUNT(*) FROM webmail_email WHERE from_email = '" . $object->getFromEmail() . "' AND remote_id = " . $object->id);
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('grid', $this->dataGridView);
    $this->show();
  }

  /**
   * Run Thread
   * @param Amhsoft_System_Thread_Progress $progress
   * @param type $parms
   */
  public function run(Amhsoft_System_Thread_Progress $progress, $parms = array()) {
    $inboxModelAdapter = new Webmail_Inbox_Email_Model_Adapter();
    $this->set = $inboxModelAdapter->fetch("ALL");
    Webmail_Inbox_Email_Model_Adapter::scan($this->set);
  }

}

?>
