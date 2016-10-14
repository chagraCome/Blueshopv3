<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Most.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Report_Sales_Most_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_DataGridView $productDataGridView * */
  protected $productDataGridView;

  /** @ var ProductModelAdapter $productModelAdapter * */
  protected $productModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->productModelAdapter = new Product_Product_Model_Adapter();
    $this->productModelAdapter->select('*');
    $this->productModelAdapter->select('SUM(1) as sale');
    $this->productModelAdapter->leftJoin('sale_order_item', 'id', 'item_id');
    $this->productModelAdapter->where('item_id IS NOT NULL');
    $this->productModelAdapter->groupBy('product.id');
    $this->productModelAdapter->orderBy('sale DESC');
    $this->productDataGridView = new Product_Product_DataGridView();
    $this->productDataGridView->setWithPagination(true);
    $this->productDataGridView->Sortable = true;
    $this->productDataGridView->Searchable = true;
    $this->productDataGridView->removeByIdentName('online');
    $this->productDataGridView->removeByIdentName('edit');
    $sumCol = new Amhsoft_Label_Control(_t('Sales Count'), new Amhsoft_Data_Binding('sale'));
    $this->productDataGridView->AddColumn($sumCol);
    $this->productDataGridView->performSort($this->getRequest(), $this->productModelAdapter);
    $this->productDataGridView->performSearch($this->getRequest(), $this->productModelAdapter);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('List all products'), View_Message_Type::INFO);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->productDataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter);
    $this->getView()->assign('grid', $this->productDataGridView);
    $this->show();
  }

}
?>



