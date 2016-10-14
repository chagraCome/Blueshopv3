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
class Coupon_Type_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  public function __construct() {
    $this->table = 'coupon_type';
    $this->className = 'Coupon_Type_Model';
    $this->map = array(
        'id' => 'id',
    );
    parent::__construct();
  }

  public function getLanguageTableName() {
    return 'coupon_type_lang';
  }

  public function getJoinColumn() {
    return 'coupon_type_id';
  }

  public function getLangMap() {
    return array('name' => 'name');
  }

}

?>