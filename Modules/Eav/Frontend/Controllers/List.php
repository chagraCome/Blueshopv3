<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

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
    $this->productViewModelAdapter = new Product_View_Model_Adapter();
    if ($this->getRequest()->getInt('cat') > 0) {
      $this->productViewModelAdapter->where('category_id = ? ', $this->getRequest()->getInt('cat'));
    }
    $this->attributeFilter = new Modules_Product_Filter_Attribute_Filter($this->productViewModelAdapter);
    foreach ((array) $this->attributeFilter->getQueryParamsOnlyAttributes() as $key => $val) {
      $exp = @explode('-', $val);
      if (count($exp) == 2) {
	$from = floatval($exp[0]);
	$to = floatval($exp[1]);
	$this->productViewModelAdapter->where($key . " BETWEEN $from AND $to");
      } else {
	$this->productViewModelAdapter->where($key . ' = ? ', urldecode($val), PDO::PARAM_STR);
      }
    }
  }

  /**
   * Default event
   */
  public function __default() {
    $this->setUpToolBar();
  }

  /**
   * Set ToolBar
   */
  protected function setUpToolBar() {
    $this->item_layout = Amhsoft_Session::read('layout', Amhsoft_System_Config::getProperty('list_product_num_col'));
    if (Amhsoft_Web_Request::get('sort_by')) {
      $this->sort_by = Amhsoft_Web_Request::get('sort_by');
    } else {
      
    }
    if (Amhsoft_Web_Request::get('products_per_page')) {
      $this->items_per_page = Amhsoft_Web_Request::get('products_per_page');
    } else {
      $this->items_per_page = Amhsoft_Session::read('products_per_page', 12);
    }
    $sort_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('sort_by'), true);
    $product_per_page_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('products_per_page'), true);
    $layout_url = 'index.php?' . Amhsoft_Common::GetQueryString($_GET, array('layout'), true);
    $this->getView()->assign('sort_url', $sort_url);
    $this->getView()->assign('product_per_page_url', $product_per_page_url);
    $this->getView()->assign('layout_url', $layout_url);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $re = $this->productViewModelAdapter->fetch();
    $totalCount = $re->rowCount();
    $this->attributeFilter->calculateAttributes($re);
    $this->getView()->assign('filter_attributes', $this->attributeFilter->getAttributes());
    $this->getView()->assign('total_result', $totalCount);
    // pagination setup
    $pager = new Amhsoft_Paginate();
    $this->getView()->assign('total_result', $totalCount);
    $pager->Pager($totalCount, $this->items_per_page, 10);
    // calculate limit
    $limit = $pager->getLimit($this->getRequest->getCurrentPage());
    // use limit
    $this->productViewModelAdapter->limit($limit);
    // design limit
    $this->getView()->assign("pager", $pager->ToHtml());
    $this->productViewModelAdapter->orderBy('price DESC');
    $this->getView()->assign('items', $this->productViewModelAdapter->fetch());
    $this->getView()->assign('layout', $this->item_layout);
    $this->show();
    echo microtime(true) - $this->start;
    echo "<br />";
  }

}

?>