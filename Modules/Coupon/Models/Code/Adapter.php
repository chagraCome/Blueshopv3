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
class Coupon_Code_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct() {
    $this->table = 'coupon_code';
    $this->className = 'Coupon_Code_Model';
    $this->map = array('id' => 'id',
        'code' => 'code',
        'insert_date_time' => 'insert_date_time',
        'expire_date' => 'expire_date',
        'delivery_date_time' => 'delivery_date_time',
        'state_id'=>'state_id',
        'coupon_id' => 'coupon_id'
    );
    $this->defineOne2One('state', 'state_id', 'Coupon_Code_State_Model');
    $this->defineOne2One('coupon', 'coupon_id', 'Coupon_Model');
    parent::__construct();
  }

  public function deleteById($id) {
    @unlink('media/coupons/' . $id . '.jpg');
    parent::deleteById($id);
  }

}

?>