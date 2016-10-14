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
class Product_Category_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'product_category';
    $this->className = 'Product_Category_Model';
    $this->map = array(
	'id' => 'id',
	'parent_id' => 'parent_id',
	'sortid' => 'sortid',
	'state' => 'state',
	'previous' => 'previous',
        'icon' => 'icon',
	'next' => 'next'
    );
    parent::__construct();
  }

  /**
   * Languge Table Name 
   * @return string
   */
  public function getLanguageTableName() {
    return "product_category_lang";
  }

  /**
   * Join Column
   * @return string
   */
  public function getJoinColumn() {
    return "product_category_id";
  }

  /**
   * lang map
   * @return type
   */
  public function getLangMap() {
    return array(
	'name' => 'name',
	'description' => 'description',
    );
  }

  public function insert(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
    try {
      parent::insert($object, $cascade);
      $db = Amhsoft_Database::newInstance();
      $stmt = null;
      if (intval($object->parent_id) <= 0) {
	$stmt = $db->prepare("LOCK TABLE product_category WRITE;
                SELECT @prev := IF(max(next),  max(next), 1) FROM `product_category`; UPDATE product_category SET previous = @prev+1,  next = @prev+2 WHERE id = $object->id ;
                UNLOCK TABLES;");
	$stmt->execute();
      } else {
	$stmt = $db->prepare("LOCK TABLE product_category WRITE;
                SELECT @prev := previous FROM `product_category` WHERE id = " . $object->parent_id . "; 
                    UPDATE product_category SET next = next + 2 WHERE next > @prev;
                    UPDATE product_category SET previous = previous + 2 WHERE previous > @prev;
                    UPDATE product_category SET previous = @prev+1,  next = @prev+2 WHERE id = $object->id ;
                        UNLOCK TABLES;");

	$stmt->execute();
      }
    } catch (Exception $e) {
      die($e->getMessage());
      return false;
    }
  }

  /**
   * Get category children
   * @param type $catiId
   * @return type
   */
  public static function getChildrenIdArray($catiId) {
    if (intval($catiId) <= 0) {
      return array();
    }
    $sql = "SELECT node.id
            FROM product_category AS node,
            product_category AS parent
            WHERE node.previous BETWEEN parent.previous AND parent.next
            AND parent.id = $catiId
            ORDER BY node.previous";
    $stmt = Amhsoft_Database::getInstance()->prepare($sql);
    $stmt->execute();
    $categoryids = array();
    while ($categoryid = $stmt->fetchColumn()) {
      $categoryids[] = $categoryid;
    }
    return $categoryids;
  }

}

?>