<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Payment_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'payment';
    $this->className = 'Payment_Payment_Model';
    $this->map = array(
	'id' => 'id',
	'max_mount' => 'max_mount',
	'modulename' => 'modulename',
	'online' => 'online',
	'charge' => 'charge',
	'user_id' => 'user_id',
	'fee' => 'fee',
        'sortid'=>'sortid'
    );
    parent::__construct();
  }

  /*
   * Get Joint Column
   */

  public function getJoinColumn() {
    return "payment_id";
  }

  /**
   * Get Language Map
   * @return type
   */
  public function getLangMap() {
    return array(
	'name' => 'name',
	'description' => 'description',
    );
  }

  /**
   * Get Language Table Name
   * @return string
   */
  public function getLanguageTableName() {
    return "payment_lang";
  }

}

?>