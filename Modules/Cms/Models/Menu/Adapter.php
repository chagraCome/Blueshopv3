<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Menu_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'cms_menu_item';
    $this->className = 'Cms_Menu_Model';
    $this->map = array(
	'id' => 'id',
	'sortid' => 'sortid',
	'url' => 'url',
	'state' => 'state',
	'alias' => 'alias',
	'cms_main_menu_id' => 'cms_main_menu_id',
	'target' => 'target',
	'parent_id' => 'parent_id',
	'cms_page_id' => 'cms_page_id'
    );
    $this->defineOne2One('mainmenu', 'cms_main_menu_id', 'Cms_MainMenu_Model');
    $this->defineOne2One('page', 'cms_page_id', 'Cms_Page_Model');
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Product')) {
      $this->defineOne2One('product_category', 'product_category_id', 'Product_Category_Model');
    }
    parent::__construct();
  }

  /**
   * Get main menus.
   * @return array
   */
  public static function getMainMenus() {
    global $current_lang;
    $cmsMenuAdapter = new Cms_Menu_Model_Adapter();
    $cmsMenuAdapter->setCurrentLang($current_lang);
    $cmsMenuAdapter->where('(`parent_id` IS NULL OR `parent_id` = 0)');
    $cmsMenuAdapter->orderBy('sortid ASC');
    return $cmsMenuAdapter->fetch();
  }

  /**
   * Get Main Menu Id by Parent ID.
   * @param type $id
   * @return int
   */
  public static function getMainMenuIdByParentID($id) {
    $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
    $parent = $cmsMenuModelAdapter->fetchById($id);
    if ($parent instanceof Cms_Menu_Model) {
      return $parent->cms_main_menu_id;
    }
    return 0;
  }

  /**
   * Fetch By Box id.
   * @param type $id
   * @return type
   */
  public function fetchByBoxId($id) {
    $cmsAreaAdapter = new Cms_MainMenu_Model_Adapter();
    $cmsAreaAdapter->where('cms_box_id = ' . $id);
    $area = $cmsAreaAdapter->fetch();
    if ($area instanceof PDOStatement) {
      $areas = $area->fetchAll();
      if (isset($areas[0])) {
	$cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
	$cmsMenuModelAdapter->where('state = 1');
	$cmsMenuModelAdapter->where('cms_main_menu_id = ' . $areas[0]->id);
	$cmsMenuModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
	$cmsMenuModelAdapter->orderBy('sortid ASC');
	return $cmsMenuModelAdapter->fetch();
      }
    }
  }

  /**
   * Fetch as Tree
   * @param type $id
   * @param type $mainmenuid
   * @return type
   */
  public static function fetchAsTree($id = 0, $mainmenuid = 0) {
    $array = array();
    $cmsMenuModelAdapter = new self();
    if ($id > 0) {
      $cmsMenuModelAdapter->where('parent_id = ?', $id);
    } else {
      $cmsMenuModelAdapter->where(' (parent_id IS NULL OR parent_id = 0)');
    }
    if ($mainmenuid > 0) {
      $cmsMenuModelAdapter->where('cms_main_menu_id=' . $mainmenuid);
    }
    $topIterator = $cmsMenuModelAdapter->fetch();
    while ($topItem = $topIterator->fetch()) {
      $array[] = array('id' => $topItem->getId(), 'title' => $topItem->getTitle());
      foreach ($topItem->getChildrens() as $child) {
	$array[] = array('id' => $child->getId(), 'title' => ' -> ' . $child->getTitle());
      }
    }
    return $array;
  }

  /**
   * @return string $_language_table_name
   */
  public function getLanguageTableName() {
    return 'cms_menu_item_lang';
  }

  /**
   * @return array $langMap
   */
  public function getLangMap() {
    return array('title' => 'title');
  }

  /**
   * @return string $join_column
   */
  public function getJoinColumn() {
    return "cms_menu_item_id";
  }

}

