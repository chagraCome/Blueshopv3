<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Myproduct.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Frontend_Myproduct_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_View_Model_Adapter $productViewModelAdapter */
  private $productViewModelAdapter;
  private $start;
  private $mem;
  private $attributeFilter;
  protected $sort_by = 'new';
  protected $item_layout;
  protected $items_per_page = 12;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $auth = Amhsoft_Authentication::getInstance();
    if (!$auth->isAuthenticated()) {
      $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
    }
    $this->productViewModelAdapter = new Product_Product_Model_Adapter();
    $this->productViewModelAdapter->leftJoin('sale_order_item', 'id', 'item_id');
    $this->productViewModelAdapter->leftJoinWithoutCardinality('sale_order', 'sale_order_item.sale_order_id', 'sale_order.id');
    $this->productViewModelAdapter->leftJoin('quotation_item', 'id', 'product_id');
    $this->productViewModelAdapter->leftJoinWithoutCardinality('quotation', 'quotation_item.quotation_id', 'quotation.id');
    $this->productViewModelAdapter->leftJoin('invoice_item', 'id', 'item_id');
    $this->productViewModelAdapter->leftJoinWithoutCardinality('invoice', 'invoice_item.invoice_id', 'invoice.id');
    $id = Amhsoft_Authentication::getInstance()->getObject()->id;
    $this->productViewModelAdapter->where('( (sale_order.account_id = ' . $id . ' OR quotation.account_id = ' . $id . ') OR (invoice.account_id = ' . $id . '))');
    $this->productViewModelAdapter->groupBy("product.id");
  }

  /**
   * Default Event
   */
  public function __default() {
    //$this->setUpToolBar();
  }

  /*
   * Finalize event
   */

  public function __finalize() {
    $re = $this->productViewModelAdapter->fetch();
    $totalCount = $re->rowCount();
    $this->getView()->assign('total_result', $totalCount);
    // pagination setup
    $pager = new Amhsoft_Paginate();
    $this->getView()->assign('total_result', $totalCount);
    $pager->Pager($totalCount, $this->items_per_page, 10);
    // calculate limit
    $limit = $pager->getLimit($this->getRequest()->getCurrentPage());
    // use limit
    $this->productViewModelAdapter->limit($limit);
    // design limit
    $this->getView()->assign("pager", $pager->ToHtml());
    $this->productViewModelAdapter->orderBy('price DESC');
    $this->getView()->assign('items', $this->productViewModelAdapter->fetch());
    $this->getView()->assign('layout', $this->item_layout);
    $this->show();
  }

}

?>