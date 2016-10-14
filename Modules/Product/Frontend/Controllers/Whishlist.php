<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Whishlist.php 347 2016-02-05 16:11:41Z imen.amhsoft $
 * $Rev: 347 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:11:41 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Frontend_Whishlist_Controller extends Amhsoft_System_Web_Controller {

    protected $id;
    protected $cookiedata = array();

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('label' => _t('Whishlist'), 'link' => 'index.php?module=product&page=whishlist'));
        $this->id = $this->getRequest()->getId();
    }

    /**
     * Add Coockie
     * @param type $id
     */
    protected function addToCoockie($id) {
        $this->cookiedata[] = $id;
        $this->cookiedata = array_unique($this->cookiedata);
        $this->flushCoockies();
    }

    /**
     * Set Coockies
     */
    protected function flushCoockies() {
        Amhsoft_Common::SetCookie('productwishlist', @implode(',', $this->cookiedata));
    }

    /**
     * Remove from Coockies
     * @param type $id
     * @return type
     */
    protected function removeFromCookies($id) {
        $index = array_search($id, $this->cookiedata);
        if ($index === FALSE) {
            return;
        }
        unset($this->cookiedata[$index]);
        $this->cookiedata = array_values($this->cookiedata);
        $this->flushCoockies();
    }

    /**
     * Default event
     */
    public function __default() {
        $data = Amhsoft_Common::GetCookie('productwishlist');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
        if ($this->id > 0) {
            $this->addToCoockie($this->id);
        }
    }

    /**
     * Delete from coockies event
     */
    public function __delete() {
        $data = Amhsoft_Common::GetCookie('productwishlist');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
        if ($this->id > 0) {
            $this->removeFromCookies($this->id);
        }
    }

    /**
     * Get Products
     * @return Product_Product_Model
     */
    protected function getProducts() {
        $products = array();
        $productModelAdapter = new Product_Product_Model_Adapter();
        foreach ((array) $this->cookiedata as $id) {
            $product = $productModelAdapter->fetchById($id);
            if ($product instanceof Product_Product_Model) {
                $products[] = $product;
            }
        }
        return $products;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $pager = new Amhsoft_Paginate();
        $products = $this->getProducts();
        $totalCount = count($products);
        $this->getView()->assign('total_result', $totalCount);
        $pager->Pager($totalCount, 10, 10);
        //$limit = $pager->getLimit(Amhsoft_Web_Request::getCurrentPage());
       // $products->limit($limit);
        $this->getView()->assign('totalCount', $totalCount);
        $this->getView()->assign("pager", $pager->ToHtml('index.php', false, 'horizontal_list clearfix d_inline_middle f_size_medium m_left_10'));
        $this->getView()->assign('Wproducts', $products);
        $this->show();
    }

}

?>
