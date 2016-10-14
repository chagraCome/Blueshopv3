<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Sort.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Category_Sort_Controller extends Amhsoft_System_Web_Controller {
  /* @var Product_Category_Model_Adapter    $categoryModelAdapter */

  protected $categoryModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Sort Categories'), View_Message_Type::INFO);
    $this->categoryModelAdapter = new Product_Category_Model_Adapter();
    $this->categoryModelAdapter->where('(parent_id IS NULL OR parent_id =0)');
    $this->categoryModelAdapter->orderBy('previous ASC');
    $tops = $this->categoryModelAdapter->fetch()->fetchAll();
    $str = "<ol class=\"sortable\">";
    foreach ($tops as $top) {
      $this->getTree($top, $str);
    }
    $str .= '</ol>';
    $this->getView()->assign('tree', $str);
  }

  /**
   * Resort event
   */
  public function __resort() {
    $data = $this->getRequest()->post('json_data');
    $data = html_entity_decode($data);
    $data_array = json_decode($data);
    foreach ($data_array as $obj) {
      if ($obj->item_id == null) {
	continue;
      }
      $stmt = Amhsoft_Database::getInstance()->prepare("UPDATE product_category SET parent_id = :pid, previous = :p, next = :n WHERE id = :id");
      $pid = intval($obj->parent_id) == 0 ? null : $obj->parent_id;
      $stmt->bindParam(':pid', $pid);
      $stmt->bindParam(':p', $obj->left);
      $stmt->bindParam(':n', $obj->right);
      $stmt->bindParam(':id', $obj->item_id);
      $stmt->execute();
    }
    exit;
  }

  /**
   * Get Tree
   * @param Product_Category_Model $cat
   * @param type $str
   * @param type $build
   */
  protected function getTree(Product_Category_Model $cat, &$str, $build = true) {
    if ($cat->hasChildern()) {
      $str .= '<li id="list_' . $cat->getId() . '"><div><span class="disclose"><span></span></span>' . $cat->getName() . "</div><ol>\n";
      foreach ($cat->getChildern() as $child) {
	$this->getTree($child, $str, false);
      }
      $str .= "</ol></li>\n";
    } else {
      $str .= '<li id="list_' . $cat->getId() . '"><div><span class="disclose"><span></span></span>' . $cat->getName() . "</div></li>\n";
      if ($build == false) {
      }
    }
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->includeJsFile('jquery.mjs.nestedSortable.js');
    $this->show();
  }

}

?>
