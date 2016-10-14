<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of list
 *
 * @author cherif
 */
class Crm_Backend_Account_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var Crm_Account_Model_Adapter $accountModelAdapter */
  protected $accountModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->accountModelAdapter = new Crm_Account_Model_Adapter();
    $this->accountModelAdapter->orderBy('id DESC');
    $this->dataGridView = new Crm_Account_DataGridView();
    $this->dataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
    $this->dataGridView->onRowDraw->registerEvent($this, 'onRowDraw_CallBack');
    $this->dataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
    $this->dataGridView->Sortable = true;
    $this->dataGridView->Searchable = true;
    $this->dataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('Manage Accounts'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->dataGridView->performSort($this->getRequest(), $this->accountModelAdapter);
    $this->dataGridView->performSearch($this->getRequest(), $this->accountModelAdapter);
  }

  public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
    if ($colName == 'email1') {
      $email = $req->get('email1');
      $adapter->where("(email1 LIKE '%$email%'  OR email2 LIKE '%$email%')");
      return true;
    }
  }

  public static function onRowDraw_CallBack($columnIndex, Amhsoft_Abstract_Control $column, $model) {
    if ($column->DataBinding->Value == 'email1') {
      $column->Value = $model->getEmail();
    }
  }

  public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
    if ($columName == 'account_source') {
      $adapter->orderBy("account.account_source_id $sortOrder");
      return true;
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->accountModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->show();
  }

}

?>
