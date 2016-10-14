<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Collection.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Modules_Product_Filter_Attribute_Collection {

  private $attributes = array();

  /**
   * Add Eav Attribute
   * @param Eav_Attribute_Model $attribute
   */
  public function add(Eav_Attribute_Model $attribute) {
    $this->attributes[$attribute->getName()] = $attribute;
  }

  /**
   * Set Attributes
   * @param type $attributes
   */
  public function setAttributes($attributes) {
    $this->attributes = $attributes;
  }

  /**
   * Remove Eav Attribute
   * @param Eav_Attribute_Model $attribute
   */
  public function remove(Eav_Attribute_Model $attribute) {
    unset($this->attributes[$attribute->getName()]);
  }

  /**
   * get attribute
   * @param type $name
   * @return type
   */
  public function get($name) {
    return $this->attributes[$name];
  }

  /**
   * Get All
   * @return type
   */
  public function getAll() {
    return array_values($this->attributes);
  }

  /**
   * Get Attributes
   * @return type
   */
  public function getAttributes() {
    return $this->attributes;
  }

}

?>
