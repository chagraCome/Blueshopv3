<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Item_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  public function __construct() {
    $this->table = 'sale_order_item';
    $this->className = 'Saleorder_Item_Model';
    $this->map = array(
        'id' => 'id',
        'item_number' => 'item_number',
        'unit_price' => 'unit_price',
        'discount' => 'discount',
        'quantity' => 'quantity',
        'sale_order_id' => 'sale_order_id',
        'sub_total'=>'sub_total',
        'regular_price'=>'regular_price',
        'product_number'=>'product_number',
    );
    
    $this->defineOne2One('product', 'item_id', 'Product_Product_Model');

    parent::__construct();
  }


  
  public function getJoinColumn() {
    return "sale_order_item_id";
  }

  public function getLangMap() {
    return array(
        'item_name' => 'item_name',
        'item_description' => 'item_description',
    );
  }

  public function getLanguageTableName() {
    return "sale_order_item_lang";
  }

}

?>
