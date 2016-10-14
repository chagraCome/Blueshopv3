<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

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
        /* Amhsoft_Data_Db_Model_Multilanguage_EAV_Adapter::flushEntityPivotView('product', true);
          exit; */
        $this->productViewModelAdapter = new Product_Product_Model_Adapter();
        $this->productViewModelAdapter->where('online = 1');

        $productConfig = new Amhsoft_Config_Table_Adapter('product');

        $displayNoExistProducts = $productConfig->getValue('stock_display_qty_finished');

        if ($displayNoExistProducts == 1 && Product_Product_Model::isGlobalStockManagementEnabled()) {
//            $this->productViewModelAdapter->where('(quantity <=0 OR quantity IS NULL)');
            $this->productViewModelAdapter->where('(quantity <=0 OR quantity >=0)');
        } else {
            $this->productViewModelAdapter->where('(quantity > 0 OR quantity IS NULL)');
        }
        $catid = $this->getRequest()->getInt('cat');
        if ($catid > 0) {
            $id_array = Product_Category_Model_Adapter::getChildrenIdArray($catid);
            if (empty($id_array)) {
                $this->productViewModelAdapter->where('category_id = ? ', $catid);
            } else {
                $id_array[] = $catid;
                $cat_str = implode(', ', $id_array);
                $this->productViewModelAdapter->where('category_id IN  (' . $cat_str . ')');
            }
        }
        $searchKeyword = @addslashes($this->getRequest()->get('q'));
        $arrayKeyword = explode(' ', $searchKeyword);
        $str = "title LIKE '%$arrayKeyword[0]%' ";
        foreach ($arrayKeyword as $key => $search) {
            if ($key > 0 && strlen($search) > 0)
                $str = $str . " OR title LIKE '%$search%' ";
        }
        $this->productViewModelAdapter->where('(' . $str . ')');
        $str_categorytree = "";
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        $selectedCategory = $categoryModelAdapter->fetchById($catid);

        if ($selectedCategory instanceof Product_Category_Model) {
            if ($selectedCategory->getBannerSrc() != null && file_exists($selectedCategory->getBannerSrc())) {
                $this->getView()->assign('category_banner', $selectedCategory->getBannerSrc());
            } else {
                $this->getView()->assign('category_banner', false);
            }
            $str_categorytree = '<h1>' . _t('Categories') . '</h1>';
            $mainCats = Modules_Product_Frontend_Boot::getMainCategories();
            foreach ($mainCats as $mainCat) {
                $str_categorytree .= '<h2 class="cattitle"><a  href="' . $mainCat->getUrl() . '">' . $mainCat->getName() . "</a></h2>\n";
            }
            $this->getView()->assign('category_name', $selectedCategory->getName());
            $str_categorytree;
        } else {
            $str_categorytree = '<h1>' . _t('Categories') . '</h1>';
            $mainCats = Modules_Product_Frontend_Boot::getMainCategories();
            foreach ($mainCats as $mainCat) {
                $str_categorytree .= '<h2 class="cattitle"><a  href="' . $mainCat->getUrl() . '">' . $mainCat->getName() . "</a></h2>\n";
            }
            $str_categorytree;
        }
        $this->getView()->assign('category_tree', $str_categorytree);
        $this->attributeFilter = new Modules_Product_Filter_Attribute_MultiFilter($this->productViewModelAdapter);
        $this->attributeFilter->performSearch();
    }

    /**
     * Default event
     */
    public function __default() {
        $this->setUpToolBar();
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $man_id = $this->getRequest()->getInt('man_id');
        if (intval($man_id) > 0) {
            $this->productViewModelAdapter->where('manufacturer_id = ?', intval($man_id));
        }
        $re = $this->productViewModelAdapter->fetch();
        $totalCount = $re->rowCount();
        $this->attributeFilter->calculateAttributes($re);
        $this->getView()->assign('filter_attributes', $this->attributeFilter->getAttributes($this->productViewModelAdapter));
        // pagination setup
        $pager = new Amhsoft_Paginate();
        $this->getView()->assign('total_result', $totalCount);
        $pager->Pager($totalCount, $this->items_per_page, $this->items_per_page);
        // calculate limit
        $limit = $pager->getLimit(Amhsoft_Web_Request::getCurrentPage());
        // use limit
        $this->productViewModelAdapter->limit($limit);
        // design limit
        $this->getView()->assign("pager", $pager->ToHtml('index.php'));
        $productTableConfg = new Amhsoft_Config_Table_Adapter('product');
        $this->getView()->assign('productconfig', $productTableConfg->getConfiguration());
        $this->getView()->assign('items', $this->productViewModelAdapter->fetch());
        $this->show();
    }

    /**
     * Get Category
     * @param Product_Category_Model $cat
     * @param type $str
     * @param type $build
     */
    /*  protected function getCategoryTree(Product_Category_Model $cat, &$str, $build = true) {
      if ($cat->hasChildern()) {
      $bold = ($cat->getId() == $this->getRequest()->getInt('cat')) ? 'class="current maincat"' : '';
      $str .= '<li> <a ' . $bold . ' href="' . $cat->getUrl() . '">' . $cat->getName() . "</a><ul class='category_filter'>\n";
      foreach ($cat->getChildern() as $child) {
      $this->getCategoryTree($child, $str, false);
      }
      $str .= "</ul></li>\n";
      } else {
      $bold = ($cat->getId() == $this->getRequest()->getInt('cat')) ? 'class="current"' : '';
      $str .= '<li><a ' . $bold . ' href="' . $cat->getUrl() . '">' . $cat->getName() . "</a></li>\n";
      if ($build == false) {
      //$str .= '</ol>';
      }
      }
      }

      /*
     * Set ToolBar
     */

    protected function setUpToolBar() {

        $state = $this->getRequest()->get('state');
        if ($state == 'new') {
            $this->productViewModelAdapter->where('is_new = 1');
        }
        $this->item_layout = Amhsoft_Common::GetCookie('product_default_display_mode');
        $mode = 1;
        if (!$this->item_layout) {
            $productConfig = new Amhsoft_Config_Table_Adapter('product');
            $mode = $productConfig->getIntValue('product_default_display_mode');
            $this->item_layout = Amhsoft_Common::GetCookie('product_default_display_mode', $mode);
            Amhsoft_Common::SetCookie('product_default_display_mode', $this->item_layout);
        }
        $layout = $this->getRequest()->getInt('layout');
        if ($layout == 1 || $layout == 2) {
            $this->item_layout = $layout;
            Amhsoft_Common::SetCookie('product_default_display_mode', $this->item_layout);
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
                $this->productViewModelAdapter->orderBy('sort_id ASC');
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