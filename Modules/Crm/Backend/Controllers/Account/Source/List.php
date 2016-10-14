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
 * Description of delete
 *
 * @author cherif
 */
class Crm_Backend_Account_Source_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_Source_DataGridView $crmAccountSourceDataGridView */
  protected $crmAccountSourceDataGridView;

  /** @var Crm_Account_Source_Model_Adapter $crmAccountSourceModelAdapter */
  protected $crmAccountSourceModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->crmAccountSourceModelAdapter = new Crm_Account_Source_Model_Adapter();
    $this->crmAccountSourceDataGridView = new Crm_Account_Source_DataGridView();
    $this->crmAccountSourceDataGridView->Sortable = true;
    $this->crmAccountSourceDataGridView->Searchable = true;
    $this->crmAccountSourceDataGridView->setWithPagination(true);
    $this->crmAccountSourceModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List All Account source'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->crmAccountSourceDataGridView->performSort($this->getRequest(), $this->crmAccountSourceModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $items = $this->crmAccountSourceModelAdapter->fetch();
    $this->crmAccountSourceDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->crmAccountSourceDataGridView);
    $this->show();
  }

}
?>

