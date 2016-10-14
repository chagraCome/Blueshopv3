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
class Cms_Page_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $state;
  public $fixed = 0;
  public $border;
  public $layout;
  public $insertat;
  public $updateat;
  public $author_name;
  public $update_author_name;
  public $title;
  public $keywords;
  public $description;
  public $content;
  public $cms_site_id;
  public $inherit_design_from_site = 1;
  public $alias;

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
   * Sets CmsPage id.
   * @param Integer $id
   * @return CmsPageModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets CmsPage id.
   * @return Integer id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets CmsPage state.
   * @param Integer $state
   * @return CmsPageModel
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets CmsPage state.
   * @return Integer $state
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Sets CmsPage fixed.
   * @param Integer $fixed
   * @return CmsPageModel
   */
  public function setFixed($fixed) {
    $this->fixed = $fixed;
    return $this;
  }

  /**
   * Gets CmsPage fixed.
   * @return Integer $fixed
   */
  public function getFixed() {
    return $this->fixed;
  }

  /**
   * Sets CmsPage border.
   * @param Integer $border
   * @return CmsPageModel
   */
  public function setBorder($border) {
    $this->border = $border;
    return $this;
  }

  /**
   * Gets CmsPage border.
   * @return Integer $border
   */
  public function getBorder() {
    return $this->border;
  }

  /**
   * Sets CmsPage layout.
   * @param Integer $layout
   * @return CmsPageModel
   */
  public function setLayout($layout) {
    $this->layout = $layout;
    return $this;
  }

  /**
   * Gets CmsPage layout.
   * @return Integer $layout
   */
  public function getLayout() {
    return $this->layout;
  }

  /**
   * Sets CmsPage insertat.
   * @param String $insertat
   * @return CmsPageModel
   */
  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  /**
   * Gets CmsPage insertat.
   * @return String $insertat
   */
  public function getInsertat() {
    return $this->insertat;
  }

  /**
   * Sets CmsPage updateat.
   * @param String $updateat
   * @return CmsPageModel
   */
  public function setUpdateat($updateat) {
    $this->updateat = $updateat;
    return $this;
  }

  /**
   * Gets CmsPage updateat.
   * @return String $updateat
   */
  public function getUpdateat() {
    return $this->updateat;
  }

  /**
   * Sets CmsPage author_name.
   * @param String $author_name
   * @return CmsPageModel
   */
  public function setAuthorName($author_name) {
    $this->author_name = $author_name;
    return $this;
  }

  /**
   * Gets CmsPage author_name.
   * @return String $author_name
   */
  public function getAuthorName() {
    return $this->author_name;
  }

  /**
   * Sets update_author_name.
   * @param CmsPage $update_author_name
   * @return CmsPageModel
   */
  public function setUpdateAuthorName($update_author_name) {
    $this->update_author_name = $update_author_name;
    return $this;
  }

  /**
   * Gets Author Name
   * @return type
   */
  public function getAuthor_name() {
    return $this->author_name;
  }

  /**
   * Set Author Name
   * @param type $author_name
   */
  public function setAuthor_name($author_name) {
    $this->author_name = $author_name;
  }

  /**
   * Gets 
   * @return type
   */
  public function getUpdate_author_name() {
    return $this->update_author_name;
  }

  public function setUpdate_author_name($update_author_name) {
    $this->update_author_name = $update_author_name;
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
   * @return \Cms_Page_Model
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  /**
   * Gets Keywwords
   * @return type
   */
  public function getKeywords() {
    return $this->keywords;
  }

  /**
   * Set Keywords
   * @param type $keywords
   */
  public function setKeywords($keywords) {
    $this->keywords = $keywords;
  }

  /**
   * Gets description
   * @return type
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set Description
   * @param type $description
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * Gets Content
   * @return type
   */
  public function getContent() {
    return htmlspecialchars_decode($this->content);
  }

  /**
   * Set Content
   * @param type $content
   */
  public function setContent($content) {
    $this->content = $content;
  }

  public function getInherit_design_from_site() {
    return $this->inherit_design_from_site;
  }

  public function setInherit_design_from_site($inherit_design_from_site) {
    $this->inherit_design_from_site = $inherit_design_from_site;
    return $this;
  }

  /**
   * Gets CmsPage update_author_name.
   * @return String $update_author_name
   */
  public function getUpdateAuthorName() {
    return $this->update_author_name;
  }

  /**
   * 
   * @return int site id
   */
  public function getCmsSiteId() {
    return $this->cms_site_id;
  }

  /**
   * Sets the site id
   * @param int $cms_site_id
   * @return \CmsPageModel
   */
  public function setCmsSiteId($cms_site_id) {
    $this->cms_site_id = $cms_site_id;
    return $this;
  }

  /**
   * Gets the page alias
   * @return string $alias
   */
  public function getAlias() {
    return $this->alias;
  }

  /**
   * Gets alias.
   * @param string $alias
   * @return \CmsPageModel
   */
  public function setAlias($alias) {
    $this->alias = $alias;
    return $this;
  }

  public static function inheritDesignFromSite($pageid, $siteid) {
    $sql = "DELETE FROM cms_page_has_cms_box WHERE cms_page_id = $pageid;";
    $sql .="INSERT INTO cms_page_has_cms_box  SELECT $pageid, cms_box_id, position, sortid FROM cms_site_has_cms_box WHERE cms_site_id = $siteid;";
    $sql .= "UPDATE cms_page SET inherit_design_from_site = 1 WHERE id = $pageid;";
    $sql .= "UPDATE cms_page SET inherit_design_from_site = 1 WHERE id = $pageid;";
    $sql .= "UPDATE cms_page SET cms_site_id = $siteid WHERE id = $pageid;";
    try {
      Amhsoft_Database::getInstance()->exec($sql);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * 
   * insert fixed page.
   * @param string $alias
   * @param string $title
   * @param string $lang
   */
  public static function insertFixedPage($alias, $title, $lang = 'en') {
    $cmsPageModel = new Cms_Site_Model();
    $default_site_id = Cms_Site_Model::getDefault()->getId();
    $cmsPageModel->setBorder(true)
	    ->setFixed(true)
	    ->setState(true)
	    ->setTitle($title)
	    ->setInherit_design_from_site(true)
	    ->setInsertat(SYSTEM_DATE_TIME)
	    ->setAlias($alias)
	    ->setCmsSiteId($default_site_id);
    $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
    $cmsPageModelAdapter->setCurrentLang($lang);
    $cmsPageModelAdapter->where('alias = ?', $alias, PDO::PARAM_STR);
    if ($cmsPageModelAdapter->getCount() > 0) {
      $cmsPageModel->setId($cmsPageModelAdapter->fetch()->fetch()->getId());
    }
    $id = $cmsPageModelAdapter->save($cmsPageModel);
    Cms_Page_Model::inheritDesignFromSite($id, $default_site_id);
  }

  /**
   * Delete Fixed page
   * @param type $alias
   */
  public static function deleteFixedPage($alias) {
    $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
    $cmsPageModelAdapter->where('alias = ?', $alias, PDO::PARAM_STR);
    if ($cmsPageModelAdapter->getCount() > 0) {
      $pageId = $cmsPageModelAdapter->fetch()->fetch()->getId();
      $cmsPageModelAdapter->deleteById($pageId);
    }
  }

  /**
   * Get the image.
   * @return formatted $image
   */
  public function getImage() {
    $img = 'media/banner/page_banner_' . $this->id . '_1.jpg';
    if (file_exists($img)) {
      $this->image = $img;
    }
    return $this->image;
  }

  public function __toString() {
    return $this->getTitle();
  }

  /**
   * Gets
   * @param type $name
   * @return \Cms_Site_Model|null
   */
  public function __get($name) {
    if ($name == 'site') {
      $cmsSiteModelAdapter = new Cms_Site_Model_Adapter();
      $cmsModel = $cmsSiteModelAdapter->fetchById($this->cms_site_id);
      if ($cmsModel instanceof Cms_Site_Model) {
	return $cmsModel;
      }
      return null;
    }
  }

  /**
   * Gets Boxes
   * @param type $id
   * @return \Cms_Box_Model_Adapter
   */
  public static function getBoxes($id) {
    $boxModelAdapter = new Cms_Box_Model_Adapter();
    $boxModelAdapter->leftJoin('cms_page_has_cms_box', 'id', 'cms_box_id');
    $boxModelAdapter->select('cms_box.*');
    $boxModelAdapter->select('cms_page_has_cms_box.position');
    $boxModelAdapter->where('online = 1');
    $boxModelAdapter->orderBy('cms_page_has_cms_box.sortid ASC');
    $boxModelAdapter->where('cms_page_has_cms_box.cms_page_id = ' . $id);
    return $boxModelAdapter;
  }

}

?>