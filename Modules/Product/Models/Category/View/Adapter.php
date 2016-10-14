<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Category_View_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'product_category_view';
    $this->className = 'Product_Category_View_Model';
    $this->map = array(
	'id' => 'id',
	'parent_id' => 'parent_id',
	'sortid' => 'sortid',
	'state' => 'state',
	'name' => 'name',
	'description' => 'description',
	'previous' => 'previous',
	'next' => 'next'
    );
    parent::__construct();
  }

  /**
   * Fetch Category
   * @param type $id
   * @param type $sep
   * @return type
   */
  public function fetchAllAsTree($id = null, $sep = ' ') {
    $lang = Amhsoft_System::getCurrentLang();
    $sql = "SELECT CONCAT( REPEAT('---', COUNT(parent.name) - 1),'-> ', node.name) AS name, node.id, node.state
        FROM product_category_view AS node,
        product_category_view AS parent
        WHERE node.previous BETWEEN parent.previous AND parent.next
        AND node.lang = '$lang' AND parent.lang = '$lang'
        GROUP BY node.id
        ORDER BY node.previous;";
    $productCategoryViewModelAdapter = new Product_Category_View_Model_Adapter();
    $productCategoryViewModelAdapter->setPreDefinedSelectStatement($sql);
    return $productCategoryViewModelAdapter->fetch()->fetchAll();
  }

}

?>
