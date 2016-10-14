<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */

/**
 * Describe the shipping method types.
 * also there are 2 fixed shipping types:
 *   * Flatrate
 *   * Free
 */
class Shipping_Type_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;

  /**
   * Sets ShippingType id.
   * @param Integer $id
   * @return ShippingTypeModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets ShippingType id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets ShippingType name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets ShippingType name.
   * @param String $name
   * @return ShippingTypeModel 
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function __toString() {
    return $this->getName();
  }

}

?>
