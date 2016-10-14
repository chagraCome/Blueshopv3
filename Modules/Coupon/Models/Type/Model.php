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
class Coupon_Type_Model implements Amhsoft_Data_Db_Model_Interface {

  const FREE_SHIPPING = 1;
  const DISCOUNT = 2;
  
  public $id;
  public $name;

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
   * @return Coupon_Type_Model
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
   * @return Coupon_Type_Model
   * */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function __toString() {
    return $this->name;
  }

}

?>