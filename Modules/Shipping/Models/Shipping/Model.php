<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Cost_Type {

    const PER_ITEM = 1;
    const PER_CART = 2;

}

/**
 * Describe the shipping method.
 */
class Shipping_Shipping_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $min_order_amount;
    public $max_order_amount;
    public $sortid;
    public $cost;
    public $cost_type;
    public $packaging_cost;
    public $packaging_cost_type;
    public $tax_id;

    /** @var Setting_Tax_Model $tax * */
    public $tax;

    /** @var Shipping_Type_Model $shippingType */
    public $shippingType;
    public $countries = array();
    public $state;
    public $title;
    public $error_message;
    public $description;
    public $logosrc;
    public $user_id;
    public $shipping_cost;
    public $trigger_image_file;

    /**
     * Construct new shipping method
     */
    function __construct() {
        $this->setLogoSrc();
        if (intval($this->id) > 0) {
            $stmt = Amhsoft_Database::getInstance()->query("SELECT country_code FROM shipping_has_country WHERE shipping_id = " . $this->id);
            while ($iso = $stmt->fetchColumn()) {
                $this->countries[] = $iso;
            }
        }
    }

    /**
     * Sets Shipping id.
     * @param Integer $id
     * @return ShippingModel
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets Shipping id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets Shipping min_order_amount.
     * @param Integer $min_order_amount
     * @return ShippingModel
     */
    public function setMinOrderAmount($min_order_amount) {
        $this->min_order_amount = $min_order_amount;
        return $this;
    }

    /**
     * Gets Shipping min_order_amount.
     * @return Integer $min_order_amount
     */
    public function getMinOrderAmount() {
        return $this->min_order_amount;
    }

    /**
     * Sets Shipping sortid.
     * @param Integer $sortid
     * @return ShippingModel
     */
    public function setSortid($sortid) {
        $this->sortid = $sortid;
        return $this;
    }

    /**
     * Gets Shipping sortid.
     * @return Integer $sortid
     */
    public function getSortid() {
        return $this->sortid;
    }

    /**
     * Gets Shipping Cost
     * @return type
     */
    public function getCost() {
        return $this->cost;
    }

    /**
     * Set Shipping Cost
     * @param type $cost
     */
    public function setCost($cost) {
        $this->cost = $cost;
    }

    /**
     * Get Cost Type
     * @return type
     */
    public function getCostType() {
        return $this->cost_type;
    }

    /**
     * Set Shipping Cost Type
     * @param type $cost_type
     */
    public function setCostType($cost_type) {
        $this->cost_type = $cost_type;
    }

    /**
     * Gets Shipping Packaging Cost
     * @return type
     */
    public function getPackagingCost() {
        return $this->packaging_cost;
    }

    /**
     * Set Shipping Pachaging Cost
     * @param type $packaging_cost
     */
    public function setPackagingCost($packaging_cost) {
        $this->packaging_cost = $packaging_cost;
    }

    /**
     * Gets Shipping Pachaging Cost Type
     * @return type
     */
    public function getPackagingCostType() {
        return $this->packaging_cost_type;
    }

    /**
     * Set Shipping Packaging Cost Type
     * @param type $packaging_cost_type
     */
    public function setPackagingCostType($packaging_cost_type) {
        $this->packaging_cost_type = $packaging_cost_type;
    }

    /**
     * Gets Shipping type.
     * @return ShippingTypeModel $shippingType 
     */
    public function getShippingType() {
        return $this->shippingType;
    }

    /**
     * Sets Shipping type.
     * @param ShippingTypeModel $shippingType
     * @return ShippingModel 
     */
    public function setShippingType(Shipping_Type_Model $shippingType) {
        $this->shippingType = $shippingType;
        return $this;
    }

    /**
     * Gets Countries
     * @return type
     */
    public function getCountries() {
        return $this->countries;
    }

    /**
     * Add Country to shipping mehtod
     * @param Setting_Local_Model $country
     * @return Shipping_Shipping_Model $model
     */
    public function addCountry(Setting_Local_Model $country) {
        $this->countries[] = $country;
        return $this;
    }

    /**
     * Gets Shipping state.
     * @return Integer $state 
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Sets Shipping state.
     * @param Integer $state
     * @return ShippingModel 
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Gets title.
     * @return string title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets shipping method title
     * @param string $title
     * @return Shipping_Shipping_Model $model
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets error message.
     * @return string error message
     */
    public function getError_message() {
        return $this->error_message;
    }

    /**
     * Sets the default error message.
     * @param string $error_message
     * @return Shipping_Shipping_Model $model
     */
    public function setError_message($error_message) {
        $this->error_message = $error_message;
        return $this;
    }

    /**
     * Gets description.
     * @return string description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets description
     * @param type $description
     * @return Shipping_Shipping_Model $model
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setLogoSrc() {
        if (file_exists('media/shipping/' . $this->id . '.jpg')) {
            $this->logosrc = 'media/shipping/' . $this->id . '.jpg';
        }
    }

    /**
     * Check if the shipping method has logo
     * @return boolean true if shipping method has logo
     */
    public function hasLogo() {
        return @file_exists($this->logosrc);
    }

    /**
     * Gets the logo(path) shipping method
     * @return string logo src (path)
     */
    public function getLogoSrc() {
        if (@file_exists($this->logosrc)) {
            return $this->logosrc;
        } else {
            $this->logosrc = 'media/noimage.jpg';
            return $this->logosrc;
        }
    }

    /**
     * Get shipping method name by giving shipping method id.
     * @param integer $id
     * @return string shipping method name
     */
    public static function getNameById($id) {
        if (intval($id) <= 0) {
            return null;
        }
        $adapter = new Shipping_Shipping_Model_Adapter();
        $model = $adapter->fetchById($id);
        if ($model instanceof Shipping_Shipping_Model) {
            return $model->getTitle();
        } else {
            return null;
        }
    }

    public function __toString() {
        return $this->getTitle();
    }
    
    function getMaxOrderAmount() {
    return $this->max_order_amount;
  }

    

}

?>
