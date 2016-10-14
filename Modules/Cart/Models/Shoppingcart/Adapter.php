<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Shoppingcart_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'shoppingcart';
    $this->className = 'Cart_Shoppingcart_Model';
    $this->map = array(
	'id' => 'id',
	'expire' => 'expire',
	'total' => 'total',
	'comment' => 'comment',
	'shippingcost' => 'shippingcost',
    );
    $this->defineOne2One('account', 'account_id', 'Crm_Account_Model', true, true);
    $this->defineOne2One('shippingAddress', 'shipping_address_id', 'Crm_Address_Model', true, true);
    $this->defineOne2One('invoiceAddress', 'invoice_address_id', 'Crm_Address_Model', true, true);
    $this->defineOne2One('paymentMethod', 'payment_id', 'Payment_Payment_Model', true, true);
    $this->defineOne2One('shippingMethod', 'shipping_id', 'Shipping_Shipping_Model', true, true);
    $this->defineMany2Many('products', 'Product_Product_Model', 'shoppingcart_has_product', 'shoppingcart_id', 'product_id', true, true, null, array('quantity_in_cart'));
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Coupon')) {
      $this->appendMap('coupon_code_id', 'coupon_code_id');
      $this->defineOne2One('coupon', 'coupon_code_id', 'Coupon_Code_Model', true, true);
    }
    parent::__construct();
  }

}
