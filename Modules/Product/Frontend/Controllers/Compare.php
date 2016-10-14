<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Compare.php 347 2016-02-05 16:11:41Z imen.amhsoft $
 * $Rev: 347 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:11:41 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Frontend_Compare_Controller extends Amhsoft_System_Web_Controller {

    protected $adapter;
    protected $id;
    protected $cookiedata = array();

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('label' => _t('Compare Products'), 'link' => 'index.php?module=product&page=compare'));
        $this->adapter = new Product_Product_Model_Adapter();
        $this->adapter->limit(4);
    }

    /**
     * Delete from coockies event
     */
    public function __delete() {
        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
        if ($this->getRequest()->getId() > 0) {
            $this->removeFromCookies($this->getRequest()->getId());
            $this->getRedirector()->go('index.php?module=product&page=compare');
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
        Amhsoft_Common::SetCookie('productcompare', @implode(',', $this->cookiedata));
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
        $this->id = $this->getRequest()->getId();
        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
        if ($this->id > 0) {
            $this->addToCoockie($this->id);
        }
        $result = $this->getProducts();
        $i = 0;
        $attribtues = array();
        $data = array();
        $data_attributes = array();
        $data_attributes_values = array();
        $data_images = array();
        $data_prices = array();
        $data_titles = array();
        $data_descriptions = array();
        $data_quantities = array();
        $data_manufacturers = array();
        foreach ($result as $item) {
            $data[$i]['image'] = $item->getFirstThumb();
            $data[$i]['title'] = $item->getTitle();
            $data[$i]['product_id'] = $item->getId();
            if ($item->getCategory()) {
                $data[$i]['category'] = $item->getCategory();
                $data[$i]['category_url'] = $item->getCategory()->getUrl();
                $data[$i]['id_category'] = $item->category_id;
            }
            $data[$i]['product_url'] = $item->getUrl();
            if ($item->getManufacturer()) {
                $data_manufacturers[$i]['name'] = $item->getManufacturer()->getName();
            } else {
                $data_manufacturers[$i]['name'] = 'N/A';
            }
            $data_quantities[$i]['qnt'] = $item->getQuantity();
            $data_descriptions[$i]['description'] = $item->getShortDescription();
            $data_prices[$i]['price'] = $item->getSalePrice();
            if (empty($attribtues)) {
                $attribtues = $item->getAttributes();
            }

            foreach ($attribtues as $attr) {
                $data_attributes_values[$attr->getLabel()][$i] = ' ' . $attr->getFrontEndComponent($item);
                if (!in_array($attr->getLabel(), $data_attributes)) {
                    $data_attributes[] = $attr->getLabel();
                }
            }
            $i++;
        }

        Amhsoft_Debugger::addMessage($data_attributes);
        $this->getView()->assign('data_products', $data);
        $this->getView()->assign('data_prices', $data_prices);
        $this->getView()->assign('data_descriptions', $data_descriptions);
        $this->getView()->assign('data_quantities', $data_quantities);
        $this->getView()->assign('data_attributes_values', $data_attributes_values);
        $this->getView()->assign('data_attributes', $data_attributes);
        $this->getView()->assign('data_manufacturers', $data_manufacturers);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->show();
    }

}

?>
