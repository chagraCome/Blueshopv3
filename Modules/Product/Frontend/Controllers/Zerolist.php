<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Zerolist.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Frontend_Zerolist_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_Model_Adapter  $productModelAdapter */
  protected $productModelAdapter;
  protected $productModel;

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $this->productModelAdapter = new Product_Product_Model_Adapter();
    $this->productModelAdapter->where('price is NULL');
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('submit')) {
      $productIds = array();
      $productIds = $this->getRequest()->postInts('product_id');
      $productArray = array();
      if (count($productIds) > 0) {
	foreach ($productIds as $id) {
	  $productArray[] = array("id" => $id, "qnt" => 1);
	}
	Amhsoft_Registry::register('quotation_products', $productArray);
	$this->getRedirector()->go('index.php?module=quotation&page=preview');
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $products = $this->productModelAdapter->fetch();
    $this->getView()->assign('products', $products);
    $this->show();
  }

}

?>
