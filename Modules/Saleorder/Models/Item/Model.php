<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Item_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $item_number;
  public $item_name;
  public $item_description;
  public $unit_price;
  public $discount;
  public $quantity;
  public $sub_total;
  public $regular_price;
  public $product_number;

  /** @var ProductModel $product * */
  public $product;

  /** @var ProjectModel $project * */
  public $project;

  /**
   * Sets SaleOrderItem id.
   * @param Integer $id
   * @return SaleOrderItemModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets SaleOrderItem id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets item number
   * @return string
   */
  public function getItemNumber() {
    return $this->item_number;
  }

  /**
   * Sets item number
   * @param type $item_number
   * @return Saleorder_Item_Model
   */
  public function setItemNumber($item_number) {
    $this->item_number = $item_number;
    return $this;
  }

  /**
   * Sets SaleOrderItem item_name.
   * @param String $item_name
   * @return SaleOrderItemModel
   */
  public function setItemName($item_name) {
    $this->item_name = $item_name;
    return $this;
  }

  /**
   * Gets SaleOrderItem item_name.
   * @return String $item_name
   */
  public function getItemName() {
    return $this->item_name;
  }

  /**
   * Sets SaleOrderItem item_description.
   * @param String $item_description
   * @return SaleOrderItemModel
   */
  public function setItemDescription($item_description) {
    $this->item_description = $item_description;
    return $this;
  }

  /**
   * Gets SaleOrderItem item_description.
   * @return String $item_description
   */
  public function getItemDescription() {
    return $this->item_description;
  }

  /**
   * Sets SaleOrderItem unit_price.
   * @param String $unit_price
   * @return SaleOrderItemModel
   */
  public function setUnitPrice($unit_price) {
    $this->unit_price = $unit_price;
    return $this;
  }

  /**
   * Gets SaleOrderItem unit_price.
   * @return String $unit_price
   */
  public function getUnitPrice() {
    return $this->unit_price;
  }

  /**
   * Sets SaleOrderItem discount.
   * @param String $discount
   * @return SaleOrderItemModel
   */
  public function setDiscount($discount) {
    $this->discount = $discount;
    return $this;
  }

  /**
   * Gets SaleOrderItem discount.
   * @return String $discount
   */
  public function getDiscount() {
    return $this->discount;
  }

  /**
   * Sets SaleOrderItem quantity.
   * @param Integer $quantity
   * @return SaleOrderItemModel
   */
  public function setQuantity($quantity) {
    $this->quantity = $quantity;
    return $this;
  }

  /**
   * Gets SaleOrderItem quantity.
   * @return Integer $quantity
   */
  public function getQuantity() {
    return $this->quantity;
  }

  /**
   * Gets SaleOrderItem product.
   * @return ProductModel $product 
   */
  public function getProduct() {
    return $this->product;
  }

  /**
   * Sets SaleOrderItem product.
   * @param ProductModel $product
   * @return SaleOrderItemModel 
   */
  public function setProduct(Product_Product_Model $product) {
    $this->product = $product;
    return $this;
  }

  public function __toString() {
    return $this->getItemName();
  }

  public function getSubTotal() {
    return $this->sub_total;
  }

  public function setSubTotal($sub_total) {
    $this->sub_total = $sub_total;
  }

  public function getRegularPrice() {
    return $this->regular_price;
  }

  public function setRegularPrice($regula_price) {
    $this->regular_price = $regula_price;
  }

  public function getProductNumber() {
    return $this->product_number;
  }

  public function setProductNumber($product_number) {
    $this->product_number = $product_number;
  }

  public function getAmountDiscount() {
    $discount = 0;
    if ($this->discount) {
      if (substr($this->discount, -1) == '%') {
        $discount = $this->getUnitPrice() / 100 * (double) $this->discount;
      } else {
        $discount = (double) $this->discount;
      }
    }
    return $discount * $this->getQuantity();
  }

  public function reCalculatePrices() {
    $this->getSubTotalPerItem();
  }
  //@Todo : Please review this function.
  public function getSubTotalPerItem() {
    $this->sub_total = ($this->unit_price - $this->getDiscountPerItem()) * $this->quantity;
    return $this->sub_total;
  }

  public function getDiscountPerItem() {
    $discount = 0;
    if ($this->discount) {
      if (substr($this->discount, -1) == '%') {
        $discount = $this->unit_price / 100 * (double) $this->discount;
      } else {
        $discount = (double) $this->discount;
      }
    }
    return $discount;
  }

  public function recalculatePricesForsaleOrder($id) {
    if (intval($id) > 0) {
      $saleOrderModelAdapter = new Saleorder_Model_Adapter();
      $q = $saleOrderModelAdapter->fetchById($id);
      if ($q instanceof Saleorder_Model) {
        $q->reCalculatePrices();
        $saleOrderModelAdapter->save($q);
      }
    }
  }

}

?>
