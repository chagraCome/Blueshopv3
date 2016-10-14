<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Whishlist.php 340 2016-02-05 13:28:59Z montassar.amhsoft $
 * $Rev: 340 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 14:28:59 +0100 (ven., 05 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Product_Frontend_Ajax_Whishlist_Controller extends Amhsoft_System_Web_Controller {

    protected $id;
    protected $cookiedata = array();

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->id = $this->getRequest()->getId();

        $data = Amhsoft_Common::GetCookie('productwishlist');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
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
        
    }

    public function __add() {
        if ($this->id > 0) {
            $this->addToCoockie($this->id);
            $data = Amhsoft_Common::GetCookie('productwishlist');
            if ($data) {
                $this->cookiedata = (array) explode(',', $data);
                echo count($this->cookiedata) - 1;
            }
        }
    }

    /**
     * Delete from coockies event
     */
    public function __delete() {
        if ($this->id > 0) {
            $this->removeFromCookies($this->id);
            $data = Amhsoft_Common::GetCookie('productwishlist');
            if ($data) {
                $this->cookiedata = (array) explode(',', $data);
                echo count($this->cookiedata) - 1;
            }
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
        
    }

}

?>
