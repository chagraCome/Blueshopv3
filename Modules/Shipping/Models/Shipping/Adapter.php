<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Shipping_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

    /**
     * Model Adapter Construct
     */
    public function __construct() {
        $this->table = 'shipping';
        $this->className = 'Shipping_Shipping_Model';
        $this->map = array(
            'id' => 'id',
            'min_order_amount' => 'min_order_amount',
            'sortid' => 'sortid',
            'cost' => 'cost',
            'cost_type' => 'cost_type',
            'packaging_cost' => 'packaging_cost',
            'packaging_cost_type' => 'packaging_cost_type',
            'state' => 'state',
            'user_id' => 'user_id'
        );
        $this->defineOne2One('shippingType', 'shipping_type_id', 'Shipping_Type_Model');
        parent::__construct();
    }

    /*
     * Get Joint Column
     */

    public function getJoinColumn() {
        return "shipping_id";
    }

    /**
     * Get Language Map
     * @return type
     */
    public function getLangMap() {
        return array(
            'title' => 'title',
            'error_message' => 'error_message',
            'description' => 'description'
        );
    }

    /**
     * Get Language Table Name
     * @return string
     */
    public function getLanguageTableName() {
        return "shipping_lang";
    }

}

?>
