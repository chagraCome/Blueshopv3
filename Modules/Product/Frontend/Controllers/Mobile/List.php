<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Frontend_Mobile_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_View_Model_Adapter $productViewModelAdapter */
  protected $productViewModelAdapter;
  protected $start;
  protected $mem;
  protected $attributeFilter;
  protected $sort_by = 'new';
  protected $item_layout;
  protected $items_per_page = 16;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->productViewModelAdapter = new Product_Product_Model_Adapter('product');
    $this->productViewModelAdapter->where('online = 1');
    
    
  }

  /**
   * Default event
   */
  public function __default() {
  }

  /**
   * Finalize event
   */
  public function __finalize() {
   
    $this->getView()->assign('items', $this->productViewModelAdapter->fetch());
    $this->getView()->display('Modules/Product/Frontend/Views/Mobile/List.html');
  }

 

}

?>