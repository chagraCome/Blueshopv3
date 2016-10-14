<?php

/**
 * NOTICE OF LICENSE
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:39:00
 */
class Cms_Menu_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer $id */
  public $id;

  /** @var string $title */
  public $title;

  /** @var string $sortid */
  public $sortid;

  /** @var string $url */
  public $url;

  /** @var boolean $state */
  public $state;

  /** @var CmsPageModel $page */
  public $page;
  public $alias;

  /** @var string target */
  public $target;

  /** @var string parent_id */
  public $parent_id;
  public $product_category;
  public $cms_page_id;

  /**
   * Construct model.
   *
   * @param integer $id primary key of db table
   */
  public function __construct($id = null) {
    if ($id) {
      $this->id = $id;
    }
  }

  /**
   * set Url
   * @param type $url
   */
  public function setUrl($url) {
    $this->url = $url;
  }

  /**
   * set cms page model
   * @param CmsPageModel $page cms page model
   */
  public function setPage(Cms_Page_Model $page) {
    $this->page = $page;
  }

  /**
   *
   * @return CmsPageModel
   */
  public function getPage() {
    return $this->page;
  }

  /**
   * Check if menu point has parent
   * @return boolean
   */
  public function hasParent() {
    return intval($this->parent_id) > 0;
  }

  /**
   * Get parent cms menu
   * @return CmsMenuModel @parent
   */
  public function getParent() {
    if (intval($this->parent_id) > 0) {
      $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
      return $cmsMenuModelAdapter->fetchById($this->parent_id);
    } else {
      return $this;
    }
  }

  /**
   * Check if cms menu has childrens.
   * @return boolean
   */
  public function hasChildrens() {
    $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
    $cmsMenuModelAdapter->where('parent_id = ?', $this->id, PDO::PARAM_INT);
    $cmsMenuModelAdapter->where('state =1');
    return $cmsMenuModelAdapter->getSize() > 0;
  }

  public function get3Depth() {
    $sql = "SELECT COUNT(*) FROM cms_menu_item WHERE parent_id IN (SELECT id FROM cms_menu_item WHERE parent_id = $this->id)";
    return Amhsoft_Database::querySingle($sql) > 0;
  }

  /**
   * Get children if cms menu.
   * @return array
   */
  public function getChildrens($onlyonline = 0) {
    $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
    $cmsMenuModelAdapter->where('parent_id = ?', $this->id, PDO::PARAM_INT);
   // if($onlyonline == 1){
    $cmsMenuModelAdapter->where('state = 1');
    $cmsMenuModelAdapter->orderBy('sortid ASC, id ASC');
    return $cmsMenuModelAdapter->fetch();
   // }
  }

  /**
   * Check if the cms menu is a main menu.
   * @return boolean
   */
  public function isMainMenu() {
    return $this->parent_id == 0;
  }

  /**
   * Convert given string to a encoded/converted and secured URL part
   * @param string $str Raw/insecure URL part.
   * @return string Encoded/converted and secured URL part.
   */
  public static function convertString2readableURL_Part($str) {
    $str = trim($str);
    // removed problematic chars
    $str = preg_replace("/[\"\'\<\>\,\`\´\¸\^\%]+/", '', $str);
    // replace chars and often used symbols
    $search = array("Ä", "ä", "Ü", "ü", "Ö", "ö", "ß", "&", "#", "@", "°");
    $replace = array("Ae", "ae", "Ue", "ue", "Oe", "oe", "ss", "-and-", "nr", "-at-", "-grad-");
    $str = str_replace($search, $replace, $str);
    // replace sentence signs with underscore (_)
    $str = preg_replace("/[\:\;¿¡\?\!\.\\\\\/\+]+/", '_', $str);
    // replace wwhitespace and en/em-dashes with minus (-)
    $str = preg_replace("/[\t\ \–\—]+/", '-', $str);
    // remove double underscores (__+) or minus (--+)
    $str = preg_replace("/\_\_+/", '_', $str);
    $str = preg_replace("/\-\-+/", '-', $str);
    return $str;
  }

  /**
   * Gets Link
   * @return string
   */
  public function getLink() {
    if (!$this->url == '') {
      return $this->url;
    } else if ($this->cms_page_id > 0) {
      $cmsPageAdapter = new Cms_Page_Model_Adapter();
      $this->page = $cmsPageAdapter->fetchById($this->cms_page_id);
      if (Amhsoft_System_Config::getProperty('url_friendly') == true) {
	if ($this->parent_id) {
	  return rtrim(Amhsoft_System_Config::getProperty('appurl'), '/') . '/content/' . $this->page->id . '/' . Amhsoft_Common::remove_bad_chars_from_word($this->getParent()->title) . '/' . Amhsoft_Common::remove_bad_chars_from_word($this->title);
	} else {
	  return rtrim(Amhsoft_System_Config::getProperty('appurl'), '/') . '/content/' . $this->page->id . '/' . Amhsoft_Common::remove_bad_chars_from_word($this->title);
	}
      } else {
	return 'index.php?module=cms&amp;page=page&amp;id=' . $this->page->id;
      }
    } else if (isset($this->product_category_id) && $this->product_category_id > 0) {
      $url = 'index.php?module=product&page=list&cat=' . $this->product_category_id;
      return $url;
    }
  }

  /**
   * 
   * @staticvar boolean $set
   * @return boolean
   */
  public function isCurrent() {
    static $set = false;
    $remote_page = @$_GET['page'];
    $remote_id = @$_GET['id'];
    if ($remote_id == $this->cms_page_id && $remote_page == 'page') {
      return true;
    }
    if ($set == false && $remote_id == null && $remote_page == null) {
      $set = true;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Gets Title
   * @return type
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set Title
   * @param type $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * Gets Target
   * @return type
   */
  public function getTarget() {
    return $this->target;
  }

  /**
   * Set Target
   * @param type $target
   */
  public function setTarget($target) {
    $this->target = $target;
  }

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets Sortid
   * @return type
   */
  public function getSortid() {
    return $this->sortid;
  }

  /**
   * Set Sortid
   * @param type $sortid
   */
  public function setSortid($sortid) {
    $this->sortid = $sortid;
  }

  /**
   * Gets State
   * @return type
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Set State
   * @param type $state
   */
  public function setState($state) {
    $this->state = $state;
  }

  /**
   * Gets Alias
   * @return type
   */
  public function getAlias() {
    return $this->alias;
  }

  /**
   * Set Alias
   * @param type $alias
   */
  public function setAlias($alias) {
    $this->alias = $alias;
  }

  public function __toString() {
    return $this->getTitle();
  }

}
