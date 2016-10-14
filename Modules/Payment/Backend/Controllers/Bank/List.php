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
class Payment_Backend_Bank_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Bank_DataGridView $paymentBankDataGridView */
  protected $paymentBankDataGridView;

  /** @var Payment_Bank_Model_Adapter $paymentBankModelAdapter */
  protected $paymentBankModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->paymentBankModelAdapter = new Payment_Bank_Model_Adapter();
    $this->paymentBankDataGridView = new Payment_Bank_DataGridView();
    $this->paymentBankDataGridView->Sortable = true;
    $this->paymentBankDataGridView->Searchable = true;
    $this->paymentBankDataGridView->setWithPagination(true);
    $this->paymentBankModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List All Account source'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->paymentBankDataGridView->performSort($this->getRequest(), $this->paymentBankModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $items = $this->paymentBankModelAdapter->fetch();
    $this->paymentBankDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->paymentBankDataGridView);
    $this->show();
  }

}
?>

