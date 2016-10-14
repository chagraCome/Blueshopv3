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

class Webmail_Backend_Setting_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Setting_DataGridView $webmailSettingDataGridView */
  protected $webmailSettingDataGridView;

  /** @var Webmail_Setting_Model_Adapter $webmailSettingModelAdapter */
  protected $webmailSettingModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->webmailSettingModelAdapter = new Webmail_Setting_Model_Adapter();
    $this->webmailSettingDataGridView = new Webmail_Setting_DataGridView();
    $this->webmailSettingDataGridView->Sortable = true;
    $this->webmailSettingDataGridView->Searchable = true;
    $this->webmailSettingDataGridView->setWithPagination(true);
    $this->webmailSettingModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List of Webmail Acounts'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->webmailSettingDataGridView->performSort($this->getRequest(), $this->webmailSettingModelAdapter);
    $this->webmailSettingDataGridView->performSearch($this->getRequest(), $this->webmailSettingModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $items = $this->webmailSettingModelAdapter->fetch();
    $this->webmailSettingDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->webmailSettingDataGridView);
    $this->show();
  }

}
?>

