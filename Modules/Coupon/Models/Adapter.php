<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct() {
    $this->table = 'coupon';
    $this->className = 'Coupon_Model';
    $this->map = array('id' => 'id',
        'name' => 'name',
        'amount' => 'amount',
        'percent' => 'percent',
        'minum_shopping_cart_amount' => 'minum_shopping_cart_amount',
        'enabled' => 'enabled',
        'insert_date_time' => 'insert_date_time',
        'update_time_time' => 'update_time_time',
        'physical' => 'physical',
    );
    $this->defineOne2One('user', 'user_id', 'User_User_Model');
    $this->defineOne2One('type', 'type_id', 'Coupon_Type_Model');
    parent::__construct();
  }

}

?>