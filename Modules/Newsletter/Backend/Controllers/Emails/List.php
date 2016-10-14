<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Emails_DataGridView $newsletterEmailsDataGridView */
  protected $newsletterEmailsDataGridView;

  /** @var Newsletter_Email_Model_Adapter $newsletterEmailModelAdapter */
  protected $newsletterEmailModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->newsletterEmailModelAdapter = new Newsletter_Email_Model_Adapter();
    $this->newsletterEmailsDataGridView = new Newsletter_Emails_DataGridView();
    $this->newsletterEmailsDataGridView->Sortable = true;
    $this->newsletterEmailsDataGridView->Searchable = true;
    $this->newsletterEmailsDataGridView->setWithPagination(true);
    $this->newsletterEmailModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List Email'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->newsletterEmailsDataGridView->performSort($this->getRequest(), $this->newsletterEmailModelAdapter);
    $this->newsletterEmailsDataGridView->performSearch($this->getRequest(), $this->newsletterEmailModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $items = $this->newsletterEmailModelAdapter->fetch();
    $this->newsletterEmailsDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->newsletterEmailsDataGridView);
    $this->show();
  }

}
?>

