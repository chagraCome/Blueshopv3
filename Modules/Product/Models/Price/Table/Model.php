<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Price_Table_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $table_price;
  public $table_quantity;

  /**
   * Gets id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   * @return Product_Price_Table_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Price table
   * @return type
   */
  public function getTable_price() {
    return $this->table_price;
  }

  /**
   * Set Price Table
   * @param type $table_price
   */
  public function setTable_price($table_price) {
    $this->table_price = $table_price;
  }

  /*
   * Get Table Quantity
   */

  public function getTable_quantity() {
    return $this->table_quantity;
  }

  /**
   * Set Table Quantity
   * @param type $table_quantity
   */
  public function setTable_quantity($table_quantity) {
    $this->table_quantity = $table_quantity;
  }

}

?>
