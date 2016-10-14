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

class Webmail_Backend_Email_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Email_DataGridView $webmailEmailDataGridView */
  protected $webmailEmailDataGridView;

  /** @var Webmail_Email_Model_Adapter $webmailEmailModelAdapter */
  protected $webmailEmailModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->webmailEmailModelAdapter = new Webmail_Email_Model_Adapter();
    $this->webmailEmailDataGridView = new Webmail_Email_DataGridView();
    $this->webmailEmailDataGridView->Sortable = true;
    $this->webmailEmailDataGridView->Searchable = true;
    $this->webmailEmailDataGridView->setWithPagination(true);
    $this->webmailEmailModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List emails'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->webmailEmailDataGridView->performSort($this->getRequest(), $this->webmailEmailModelAdapter);
    $this->webmailEmailDataGridView->performSearch($this->getRequest(), $this->webmailEmailModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $items = $this->webmailEmailModelAdapter->fetch();
    $this->webmailEmailDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->webmailEmailDataGridView);
    $this->show();
  }

}
?>

