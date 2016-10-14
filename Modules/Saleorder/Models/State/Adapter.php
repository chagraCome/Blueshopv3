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
class Saleorder_State_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  public function __construct() {
    $this->table = 'sale_order_state';
    $this->className = 'Saleorder_State_Model';
    $this->map = array(
        'id' => 'id',
    );
    parent::__construct();
  }

  public function getJoinColumn() {
    return "sale_order_state_id";
  }

  public function getLangMap() {
    return array(
        'name' => 'name',
    );
  }

  public function getLanguageTableName() {
    return "sale_order_state_lang";
  }

}

?>
