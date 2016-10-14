<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Payment_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $max_mount;
    public $modulename = '';
    public $description;
    public $online;
    public $charge;
    public $logosrc;
    public $user_id;
    public $sortid;
    public $fee;

    /**
     * Madel Construct
     */
    function __construct() {
        $this->setLogoSrc();
    }

    /**
     * Sets Payment id.
     * @param Integer $id
     * @return Payment_Payment_Model
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets Payment id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets Payment name.
     * @param String $name
     * @return Payment_Payment_Model
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets Payment name.
     * @return String $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets Payment max_mount.
     * @param String $max_mount
     * @return Payment_Payment_Model
     */
    public function setMaxMount($max_mount) {
        $this->max_mount = $max_mount;
        return $this;
    }

    /**
     * Gets Payment max_mount.
     * @return String $max_mount
     */
    public function getMaxMount() {
        return $this->max_mount;
    }

    /**
     * Sets Payment modulename.
     * @param String $modulename
     * @return Payment_Payment_Model
     */
    public function setModulename($modulename) {
        $this->modulename = $modulename;
        return $this;
    }

    /**
     * Gets Payment modulename.
     * @return String $modulename
     */
    public function getModulename() {
        return $this->modulename;
    }

    /**
     * Sets Payment description.
     * @param String $description
     * @return Payment_Payment_Model
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets Payment description.
     * @return String $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets Payment online.
     * @param Integer $online
     * @return Payment_Payment_Model
     */
    public function setOnline($online) {
        $this->online = $online;
        return $this;
    }

    /**
     * Gets Payment online.
     * @return Integer $online
     */
    public function getOnline() {
        return $this->online;
    }

    /**
     * Sets Payment charge.
     * @param String $charge
     * @return Payment_Payment_Model
     */
    public function setCharge($charge) {
        $this->charge = $charge;
        return $this;
    }

    /**
     * Gets Payment charge.
     * @return String $charge
     */
    public function getCharge() {
        return $this->charge;
    }

    /**
     * Gets the payment method name
     * @return String payment method name
     */
    public function __toString() {
        return $this->getName();
    }

    public function setLogoSrc() {
        if (file_exists('media/payment/' . $this->id . '.jpg')) {
            $this->logosrc = 'media/payment/' . $this->id . '.jpg';
        }
    }

    /**
     * Check if the payment method has logo.
     * @return boolean true if logo exists
     */
    public function hasLogo() {
        return @file_exists($this->logosrc);
    }

    /**
     * Gets the logo path
     * @return String logo path
     */
    public function getLogoSrc() {
        if (@file_exists($this->logosrc)) {
            return $this->logosrc;
        } else {
            $this->logosrc = 'media/noimage.jpg';
            return $this->logosrc;
        }
    }

    public function getFooterLogo() {
        if (@file_exists($this->logosrc)) {
            return $this->logosrc;
        } else {
            return null;
        }
    }

    public function getFee() {
        return $this->fee;
    }

    public function setFee($fee) {
        $this->fee = $fee;
    }

    /**
     * Calculate payment method fee(cost)
     * Fee can be 5.0 or 5%
     * now the function handling fee return 0, we will replace the 0 with $this->getPayment()->getHandlingFeeAsAmount()
     * @param double $fromAmount
     */
    public function getHandlingFeeAsAmount($fromAmount = 0) {
        $fromAmount = intval($this->fee);
        if (substr($this->fee, -1) == '%') {
            $fee = ( $fromAmount / 100) * (double) $this->fee;
        } else {
            $fee = (double) $this->fee;
        }
        return $fee;
    }

    /**
     * Retrieve Payment name by ginving payment id.
     * @param int $id of the payment method
     * @return String name of payment method
     */
    public static function getNameById($id) {
        if (intval($id) <= 0) {
            return null;
        }
        $adapter = new Payment_Payment_Model_Adapter();
        $model = $adapter->fetchById($id);
        if ($model instanceof Payment_Payment_Model) {
            return $model->getName();
        } else {
            return null;
        }
    }

}

?>