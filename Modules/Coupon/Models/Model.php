<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;

  /** @var Coupon_Type_Model $type */
  public $type;
  public $amount;
  public $percent;
  public $minum_shopping_cart_amount;
  public $enabled;
  public $insert_date_time;
  public $update_time_time;
  public $user;
  public $physical;

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return Coupon_Model
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets name.
   * @return 
   * */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name.
   * @param  name 
   * @return Coupon_Model
   * */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets type.
   * @return 
   * */
  public function getType() {
    return $this->type;
  }

  /**
   * Set type.
   * @param  type 
   * @return Coupon_Model
   * */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * Gets amount.
   * @return 
   * */
  public function getAmount() {
    return $this->amount;
  }

  /**
   * Set amount.
   * @param  amount 
   * @return Coupon_Model
   * */
  public function setAmount($amount) {
    $this->amount = $amount;
    return $this;
  }

  /**
   * Gets percent.
   * @return 
   * */
  public function getPercent() {
    return $this->percent;
  }

  /**
   * Set percent.
   * @param  percent 
   * @return Coupon_Model
   * */
  public function setPercent($percent) {
    $this->percent = $percent;
    return $this;
  }

  /**
   * Gets minum_shopping_cart_amount.
   * @return 
   * */
  public function getMinumShoppingCartAmount() {
    return $this->minum_shopping_cart_amount;
  }

  /**
   * Set minum_shopping_cart_amount.
   * @param  minum_shopping_cart_amount 
   * @return Coupon_Model
   * */
  public function setMinumShoppingCartAmount($minum_shopping_cart_amount) {
    $this->minum_shopping_cart_amount = $minum_shopping_cart_amount;
    return $this;
  }

  /**
   * Gets enabled.
   * @return 
   * */
  public function getEnabled() {
    return $this->enabled;
  }

  /**
   * Set enabled.
   * @param  enabled 
   * @return Coupon_Model
   * */
  public function setEnabled($enabled) {
    $this->enabled = $enabled;
    return $this;
  }

  /**
   * Gets insert_date_time.
   * @return 
   * */
  public function getInsert_date_time() {
    return $this->insert_date_time;
  }

  /**
   * Set insert_date_time.
   * @param  insert_date_time 
   * @return Coupon_Model
   * */
  public function setInsert_date_time($insert_date_time) {
    $this->insert_date_time = $insert_date_time;
    return $this;
  }

  /**
   * Gets update_time_time.
   * @return 
   * */
  public function getUpdate_time_time() {
    return $this->update_time_time;
  }

  /**
   * Set update_time_time.
   * @param  update_time_time 
   * @return Coupon_Model
   * */
  public function setUpdate_time_time($update_time_time) {
    $this->update_time_time = $update_time_time;
    return $this;
  }

  /**
   * Gets user.
   * @return 
   * */
  public function getUser() {
    return $this->user;
  }

  /**
   * Set user.
   * @param  user 
   * @return Coupon_Model
   * */
  public function setUser(User_User_Model $user) {
    $this->user = $user;
    return $this;
  }

  /**
   * Gets physical.
   * @return 
   * */
  public function getPhysical() {
    return $this->physical;
  }

  /**
   * Set physical.
   * @param  physical 
   * @return Coupon_Model
   * */
  public function setPhysical($physical) {
    $this->physical = $physical;
    return $this;
  }
  
  public function __get($name) {
    if ($name == 'accountcount') {
      return $this->getAccountCount();
    }
    if ($name == 'contactcount') {
      return $this->getContactCount();
    }
    
  }

  
  public function getAccountCount() {
    $sql = "SELECT COUNT(*) FROM coupon_account WHERE coupon_id =" . $this->id;
    return Amhsoft_Database::querySingle($sql);
  }

  public function getContactCount() {
    $sql = "SELECT COUNT(*) FROM coupon_contact WHERE coupon_id =" . $this->id;
    return Amhsoft_Database::querySingle($sql);
  }

}

?>