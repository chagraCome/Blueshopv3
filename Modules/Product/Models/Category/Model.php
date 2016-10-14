<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Category_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $parent;
    public $sortid;
    public $state;
    public $description;
    public $logosrc;
    public $bannersrc;
    public $previous;
    public $next;
    public $parent_id;
    public $icon;
    public $product_category_id;

    /**
     * Gets Previous
     * @return type
     */
    public function getPrevious() {
        return $this->previous;
    }

    /**
     * Set previous
     * @param type $previous
     */
    public function setPrevious($previous) {
        $this->previous = $previous;
    }

    /**
     * Gets Next
     * @return type
     */
    public function getNext() {
        return $this->next;
    }

    /**
     * Set Next
     * @param type $next
     */
    public function setNext($next) {
        $this->next = $next;
    }

    /**
     * Sets ProductCategory id.
     * @param Integer $id
     * @return Product_Category_Model
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets ProductCategory id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets ProductCategory name.
     * @param String $name
     * @return Product_Category_Model
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets ProductCategory name.
     * @return String $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets ProductCategory parent.
     * @param Integer $parent
     * @return Product_Category_Model
     */
    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Gets ProductCategory parent.
     * @return Integer $parent
     */
    public function getParent() {
        if ($this->parent == null) {
            if (intval($this->parent_id) > 0) {
                $categoryModelAdapter = new Product_Category_Model_Adapter();
                $this->parent = $categoryModelAdapter->fetchById($this->parent_id);
            }
        }
        return $this->parent;
    }

    /**
     * Sets ProductCategory sortId.
     * @param Integer $sortId
     * @return ProductCategory
     */
    public function setSortId($sortId) {
        $this->sortid = $sortId;
        return $this;
    }

    /**
     * Gets ProductCategory sortId.
     * @return Integer $sortId
     */
    public function getSortId() {
        return $this->sortid;
    }

    /**
     * Sets ProductCategory state.
     * @param String $state
     * @return Product_Category_Model
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Gets ProductCategory state.
     * @return String $state
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Sets ProductCategory description.
     * @param String $description
     * @return Product_Category_Model
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets ProductCategory description.
     * @return String $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Check if has Children
     * @return type
     */
    public function hasChildern() {
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        $categoryModelAdapter->where('parent_id = ?', $this->id);
        return $categoryModelAdapter->getCount() > 0;
    }

    /**
     * Gets Children
     * @return type
     */
    public function getChildern() {
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        $categoryModelAdapter->where('parent_id = ?', $this->id);
        return $categoryModelAdapter->fetch();
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Gets Logo
     * @return null
     */
    public function getLogoSrc() {
        if (@file_exists("media/category/logos/" . $this->id . ".jpg")) {
            return "media/category/logos/" . $this->id . ".jpg";
        } else {
            return null;
        }
    }

    /**
     * Gets Url
     * @param type $full
     * @return string
     */
    public function getUrl($full = false) {
        $url = rtrim(Amhsoft_System_Config::getProperty("appurl"), '/') . '/';
        if (Amhsoft_System_Config::getProperty('url_friendly', false) == true) {
            $title = Amhsoft_Common::remove_bad_chars_from_word($this->getName());
            $url .= $title . '/' . $this->getId() . '/c/';
        } else {
            $url .= 'index.php?module=product&amp;page=list&amp;cat=' . $this->id;
        }
        return $url;
    }

    /**
     * Set Logo
     * @param type $logosrc
     */
    public function setLogoSrc($logosrc) {
        $this->logosrc = $logosrc;
    }

    /**
     * Gets Banner Src
     * @return null
     */
    public function getBannerSrc() {
        if (@file_exists("media/category/banners/" . $this->id . ".jpg")) {
            return "media/category/banners/" . $this->id . ".jpg";
        } else {
            return null;
        }
    }

    /**
     * Set Banner Src
     * @param type $bannersrc
     */
    public function setBannerSrc($bannersrc) {
        $this->bannersrc = $bannersrc;
    }
    
    /**
     * Set icon
     * @param type $icon
     */
    public function setIcon($icon) {
        $this->icon = $icon;
    }

    /**
     * Gets icon
     * @return type
     */
    public function getIcon() {
        return $this->icon;
    }


}

?>
