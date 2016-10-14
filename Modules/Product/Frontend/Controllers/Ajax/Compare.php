<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Compare.php 164 2016-01-28 13:55:31Z montassar.amhsoft $
 * $Rev: 164 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-28 14:55:31 +0100 (jeu., 28 janv. 2016) $
 * $Author: montassar.amhsoft $
 */
class Product_Frontend_Ajax_Compare_Controller extends Amhsoft_System_Web_Controller {

    protected $adapter;
    protected $id;
    protected $cookiedata = array();

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->id = $this->getRequest()->getId();

        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
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
        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
        }
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
        
    }

    public function __add() {
        if ($this->id > 0) {
            $this->addToCoockie($this->id);
        }
        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $this->cookiedata = (array) explode(',', $data);
            echo count($this->cookiedata);
            exit;
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>
