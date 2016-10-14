<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

    public function __construct() {
        $this->table = 'sale_order';
        $this->className = 'Saleorder_Model';
        $this->map = array(
            'id' => 'id',
            'number' => 'number',
            'total_price' => 'total_price',
            'payment_log' => 'payment_log',
            'creator_name' => 'creator_name',
            'due_date' => 'due_date',
            'description' => 'description',
            'updateat' => 'updateat',
            'insertat' => 'insertat',
            'discount' => 'discount',
            'policy' => 'policy',
            'account_name' => 'account_name',
            'account_email' => 'account_email',
            'account_mobile' => 'account_mobile',
            'shipping_cost' => 'shipping_cost',
            'currency' => 'currency',
            'base_currency' => 'base_currency',
            'currency_set_id' => 'currency_set_id',
            'sub_total' => 'sub_total',
            'handling_fee' => 'handling_fee',
            'total_discount' => 'total_discount',
            'shipping_id' => 'shipping_id',
            'payment_id' => 'payment_id',
            'quotation_id' => 'quotation_id'
        );
        $this->defineOne2One('account', 'account_id', 'Crm_Account_Model');
        $this->defineMany2Many('documents', 'Saleorder_Document_Model', 'sale_order_has_document', 'sale_order_id', 'document_id', true, true);
        $this->defineOne2One('user', 'user_id', 'User_User_Model');
        $this->defineOne2One('sale', 'sale_order_discount_type_id', 'Saleorder_Discount_Type_Model');
        $this->defineOne2Many('items', 'sale_order_id', 'Saleorder_Item_Model', true, true);
        $this->defineOne2One('saleOrderState', 'sale_order_state_id', 'Saleorder_State_Model');
        $this->defineOne2One('invoiceAddress', 'invoice_address_id', 'Saleorder_Address_Model', true, true);
        $this->defineOne2One('shippingAddress', 'shipping_address_id', 'Saleorder_Shipping_Address_Model', true, true);
        //$this->defineOne2One('shippingAddress', 'shipping_address_id', 'Saleorder_Shipping_Address_Model', true, true);

        parent::__construct();
    }

    public function getJoinColumn() {
        return "sale_order_id";
    }

    public function getLangMap() {
        return array(
            'name' => 'name',
            'payment_method_name' => 'payment_method_name',
            'shipping_method_name' => 'shipping_method_name',
        );
    }

    public function getLanguageTableName() {
        return "sale_order_lang";
    }

    public function deleteById($id) {
        Amhsoft_Database::getInstance()->exec("DELETE FROM comment_item WHERE entity='Saleorder_Model' AND entity_id=" . intval($id));
        parent::deleteById($id);
    }

}

?>
