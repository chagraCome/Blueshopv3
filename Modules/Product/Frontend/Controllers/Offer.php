<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Offer.php 466 2016-03-02 16:57:53Z imen.amhsoft $
 * $Rev: 466 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-03-02 17:57:53 +0100 (mer., 02 mars 2016) $
 * $LastChangedDate: 2016-03-02 17:57:53 +0100 (mer., 02 mars 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Frontend_Offer_Controller extends Amhsoft_System_Web_Controller {

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
    $this->productViewModelAdapter = new Product_Product_Model_Adapter();
    $this->productViewModelAdapter->where('online = 1');
    $this->productViewModelAdapter->where('special_price > 0');
    $this->productViewModelAdapter->where('special_price_date_from <= NOW()');
    $this->productViewModelAdapter->where('special_price_date_to >= NOW()');
    $this->productViewModelAdapter->orderBy('id DESC');
    $this->productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
    $this->productViewModelAdapter->select('*');
    $this->productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
    $this->productViewModelAdapter->groupBy('gr');
  }

  /**
   * Default event
   */
  public function __default() {
    $this->setUpToolBar();
  }

  /*
   * Finalize event
   */

  public function __finalize() {
    $re = $this->productViewModelAdapter->fetch();
    $totalCount = $re->rowCount();
    $pager = new Amhsoft_Paginate();
    $this->getView()->assign('total_result', $totalCount);
    $pager->Pager($totalCount, $this->items_per_page, $this->items_per_page);
    // calculate limit
    $limit = $pager->getLimit(Amhsoft_Web_Request::getCurrentPage());
    // use limit
    $this->productViewModelAdapter->limit($limit);
    // design limit
    $this->getView()->assign("pager", $pager->ToHtml('index.php'));
    $this->getView()->assign('items', $this->productViewModelAdapter->fetch());
    $this->show();
  }

  /**
   * Set ToolBar
   */
  protected function setUpToolBar() {
    $this->item_layout = Amhsoft_Session::read('layout');
    $mode = 1;
    if (!$this->item_layout) {
      $productConfig = new Amhsoft_Config_Table_Adapter('product');
      $mode = $productConfig->getIntValue('product_default_display_mode');
    }
    $this->item_layout = Amhsoft_Session::read('layout', $mode);
    $layout = $this->getRequest()->getInt('layout');
    if ($layout == 1 || $layout == 2) {
      $this->item_layout = $layout;
      Amhsoft_Session::write('layout', $this->item_layout);
    }
    $array_sortby = array('priceasc', 'pricedesc');
    if ($this->getRequest()->isGet('sort_by') && in_array($this->getRequest()->get('sort_by'), $array_sortby)) {
      $this->sort_by = $this->getRequest()->get('sort_by');
    }
    switch ($this->sort_by) {
      case 'priceasc':
	$this->productViewModelAdapter->orderBy('price ASC');
	break;
      case 'pricedesc':
	$this->productViewModelAdapter->orderBy('price DESC');
	break;
      default:
	$this->productViewModelAdapter->orderBy('id DESC');
	break;
    }
    if ($this->getRequest()->get('products_per_page')) {
      $this->items_per_page = $this->getRequest()->getInt('products_per_page');
    } else {
      $this->items_per_page = intval(Amhsoft_Session::read('products_per_page', 12));
    }
    $sort_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('sort_by'), true);
    $product_per_page_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('products_per_page'), true);
    $layout_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('layout'), true);
    $this->getView()->assign('sort_url', $sort_url);
    $this->getView()->assign('product_per_page_url', $product_per_page_url);
    $this->getView()->assign('layout_url', $layout_url);
    $this->getView()->assign('layout', $this->item_layout);
    $this->getView()->assign('sort_by', $this->sort_by);
    $this->getView()->assign('products_per_page', $this->items_per_page);
  }

}

?>