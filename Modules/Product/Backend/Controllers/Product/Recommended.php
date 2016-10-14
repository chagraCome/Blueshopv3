<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Recommended.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Product_Recommended_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_DataGridView $productDataGridView * */
  protected $productDataGridView;

  /** @ var ProductModelAdapter $productModelAdapter * */
  protected $productModelAdapter;

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('List Recommended products'), View_Message_Type::INFO);
    $this->productModelAdapter = new Product_Product_Model_Adapter();
    $this->productModelAdapter->leftJoin("product_recommended", 'id', 'product_id');
    $this->productModelAdapter->where('product_recommended.product_id = product.id');
    $this->productModelAdapter->orderBy('id DESC');
    $this->productDataGridView = new Product_Product_DataGridView();
    $this->productDataGridView->setWithPagination(true);
    $this->productDataGridView->Sortable = true;
    $this->productDataGridView->Searchable = true;
    $delCol = new Amhsoft_Link_Control(_t('Unassign'), 'admin.php?module=product&page=product-recommended&event=unassign');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth('60');
    $this->productDataGridView->AddColumn($delCol);
    $this->productDataGridView->performSort($this->getRequest(), $this->productModelAdapter);
    $this->productDataGridView->performSearch($this->getRequest(), $this->productModelAdapter);
    $addNewProductLink = new Amhsoft_Link_Control(_t('Add Product'), 'admin.php?module=product&page=product-quicklist');
    $addNewProductLink->onClickOpenInPopUp(640, 480);
    $addNewProductLink->setClass('add');
    $panel = new Amhsoft_Widget_Panel();
    $panel->addComponent($addNewProductLink);
    $this->getView()->assign('panel', $panel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->handleSelectedProduct();
    $this->getView()->setMessage(_t('List Recommended products'), View_Message_Type::INFO);
  }

  /**
   * Handle selected product
   */
  protected function handleSelectedProduct() {
    //check if a product is selected!
    $selectedproduct = Amhsoft_Registry::get('product_quick_list_selected_id');
    if (intval($selectedproduct) > 0) {
      Amhsoft_Database::getInstance()->exec('INSERT INTO `product_recommended` (product_id) VALUES (' . $selectedproduct . ') ');
    }
    //destroy session after adding product to quotation
    Amhsoft_Registry::destroy('product_quick_list_selected_id');
  }

  /**
   * Unassign Recomented Product
   */
  public function __unassign() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      try {
	Amhsoft_Database::getInstance()->exec("DELETE FROM `product_recommended` WHERE product_id = $id");
	$this->getRedirector()->go('?module=product&page=product-recommended&ret=true');
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
      }
    }
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
