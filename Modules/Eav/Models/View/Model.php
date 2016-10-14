<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Product_View_Model
 *
 * @author cherif
 */
class Eav_View_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $title;
    public $number;
    public $price;
    public $sort_id;
    public $online;
    public $description;
    public $discount;
    public $remote_id;
    public $insertat;
    public $updateat;
    public $special_price;
    public $special_price_date_to;
    public $special_price_date_from;
    public $images = array();
    public $documents = array();
    public $set;
    public $entity_set_id;
    public $type_id = 1;

    const SIMPLE = 1;
    const GROUPED = 2;
    const CONFIGURABLE = 3;
    const SERVICE = 4;

    public $is_new;
    public $short_desc;
    public $category;
    private $attributes = array();

    public function setIsnew($is_new) {
        $this->is_new = $is_new;
    }

    /**
     * Gets Product id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    public function getShortDesc() {
        if (NULL == $this->short_desc) {
            $this->short_desc = htmlspecialchars_decode($this->description);
            $this->short_desc = strip_tags($this->short_desc);
            $this->short_desc = mb_substr($this->short_desc, 0, 30);
        }
        return $this->short_desc . '...';
    }

    /**
     * Gets Product title.
     * @return String $title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Gets Product number.
     * @return String $number
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Gets Product price.
     * @return String $price
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Gets sort_id.
     * @return <type> sort_id
     */
    public function getSortId() {
        return $this->sort_id;
    }

    public function getSalePrice() {
        if ($this->isOffered()) {
            return (double) $this->getSpecialPrice();
        } else {
            return (double) $this->getPrice();
        }
    }

    /**
     * Gets sepcial price of the product.
     * @return double sepcial price of product
     */
    public function getSpecialPrice() {
        return $this->special_price;
    }

    /**
     * Gets special price end date.
     * @return string special price to date
     */
    public function getSpecialPriceDateTo() {
        return $this->special_price_date_to;
    }

    /**
     * Gets the start date of the special price.
     * @return string @special_price_date_from
     */
    public function getSpecialPriceDateFrom() {
        return $this->special_price_date_from;
    }

    /**
     * Check if the product is offered, and the offer time is not exited!
     * @return bool $offered
     */
    public function isOffered() {
        if ((double) $this->special_price <= 0) {
            return false;
        }

        if (strtotime(Amhsoft_Locale::UCTDateTime()) > strtotime($this->getSpecialPriceDateFrom()) && strtotime(Amhsoft_Locale::UCTDateTime()) < strtotime($this->getSpecialPriceDateTo())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get URL
     * @global config $config
     * @param boolean $full
     * @return string URL
     */
    public function getUrl($full = false) {
        $url = rtrim(Amhsoft_System_Config::getProperty("appurl"), '/') . '/';
        if ((bool) Amhsoft_System_Config::getProperty('url_friendly', false) == true) {
            $title = Amhsoft_Common::remove_bad_chars_from_word($this->getTitle());
            if ($this->getCategory()) {
                $url .= $this->getCategory()->getName() . 'c/' . $this->id . '-' . $title . '.html';
            } else {
                $url .= 'index.php?module=product&amp;page=detail&amp;id=' . $this->id;
            }
        } else {
            $url .= 'index.php?module=product&amp;page=detail&amp;id=' . $this->id;
        }
        return $url;
    }

    public function getCategory() {
        return $this->category;
    }

    /**
     * Gets Product online.
     * @return Integer $online
     */
    public function getOnline() {
        return $this->online;
    }

    /**
     * Check if product is simple product.
     * @return boolean
     */
    public function isSimple() {
        return $this->type_id == Product_Product_Model::SIMPLE;
    }

    /**
     * Check if product is service product.
     * @return boolean
     */
    public function isService() {
        return $this->type_id == Product_Product_Model::SERVICE;
    }

    /**
     * Check if product is grouped product.
     * @return boolean
     */
    public function isGrouped() {
        return $this->type_id == Product_Product_Model::GROUPED;
    }

    /**
     * Check if product is configurable product.
     * @return boolean
     */
    public function isConfigurable() {
        return $this->type_id == Product_Product_Model::CONFIGURABLE;
    }

    /**
     * Gets Product description.
     * @return String $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**

      /**
     * Gets categorie_id.
     * @return <type> categorie_id
     */
    public function getCategorieId() {
        return $this->categorie_id;
    }

    /**
     * Gets Product discount.
     * @return String $discount
     */
    public function getDiscount() {
        return $this->discount;
    }

    /**
     * Gets Product remote_id.
     * @return Integer $remote_id
     */
    public function getRemoteId() {
        return $this->remote_id;
    }

    public function getInsertat() {
        return $this->insertat;
    }

    public function getUpdateat() {
        return $this->updateat;
    }

    public function addImage(ImageModel $image) {
        $this->images[] = $image;
    }

    /**
     * Get product set.
     * @return Product_Set_Model
     */
    public function getProductSet() {
        return $this->set;
    }

    public function getDocuments() {
        return $this->documents;
    }

    public function __toString() {
        return $this->getTitle();
    }

    public function getAttributes($displayHidden = true) {
        if (empty($this->attributes)) {
            $productSetAdapter = new Eav_Set_Model_Adapter();
            $this->set = $productSetAdapter->fetchById($this->entity_set_id);
            if ($this->set instanceof Eav_Set_Model) {
                $this->attributes = $this->set->getAttributes($displayHidden);
            }
        }
        return $this->attributes;
    }

    public function __get($name) {
        if ($name) {

            if ($name == 'firstthumb') {
                return $this->getFirstThumb();
            }
            if ($name == 'saleprice') {
                return $this->getSalePrice();
            }

            if (preg_match("/_value$/i", $name)) {
                $newName = str_replace('_value', '', $name);

                foreach ($this->getAttributes() as $attr) {
                    if ($attr->getName() == $newName) {
                        return $attr->getFrontEndComponent($this)->Value;
                    }
                }
            }
        }
    }

    public function setId($id) {
        
    }

    public function getFirstThumb() {
        if (isset($this->images[0])) {
            return $this->images[0]->getThumb();
        }
    }

    public function getSaveAmount() {
        if ($this->isOffered()) {
            $saveAmount = $this->getPrice() - $this->getSpecialPrice();
            return $saveAmount;
        }
        return false;
    }

    public function getPercentSaveAmount() {
        return floor((($this->getPrice() - $this->getSalePrice()) / $this->getPrice()) * 100);
    }

    public function isNew() {
        $insertAtPlus3 = Amhsoft_Locale::DateAdd($this->updateat, 0, 0, 0, 3);
        return strtotime($insertAtPlus3) > strtotime(Amhsoft_Locale::UCTDateTime());
    }

}

?>
