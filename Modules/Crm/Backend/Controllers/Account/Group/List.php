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
class Crm_Backend_Account_Group_List_Controller extends Amhsoft_System_Web_Controller {

  protected $crmGroupDataGridView;
  protected $crmGroupModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    if ($this->getRequest()->get('ret') == true) {
      $this->getView()->setMessage(_t('Action successfuly executed'), View_Message_Type::SUCCESS);
    } else {
      $this->getView()->setMessage(_t('Cannot Execute Action'), View_Message_Type::ERROR);
    }
    $this->crmGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
    $this->crmGroupDataGridView = new Crm_Account_Group_DataGridView();
    $this->crmGroupDataGridView->Sortable = true;
    $this->crmGroupDataGridView->setWithPagination(true);
    $this->crmGroupDataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
    $this->crmGroupDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
    $this->getView()->setMessage(_t('List Account Groups'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->crmGroupDataGridView->performSort($this->getRequest(), $this->crmGroupModelAdapter);
  }

  public function __asdefault() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $db = Amhsoft_Database::getInstance();
    $db->beginTransaction();
    try {
      $db->exec('UPDATE `account_group` SET as_default = 0');
      $db->exec('UPDATE `account_group` SET as_default = 1 WHERE id = ' . $id);
      $db->commit();
      $this->handleSuccess();
    } catch (Exception $e) {
      var_dump($e->getMessage());
      exit;
      $db->rollBack();
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=crm&page=group-account&ret=true');
  }

  public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
    if ($colName == 'name') {
      $accountgroup = $req->get('name');
      $adapter->where("account_group LIKE '%$accountgroup%' ");
      return true;
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $projects = $this->crmGroupModelAdapter->fetch();
    $this->crmGroupDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->crmGroupDataGridView);
    $this->show();
  }

}

?>
