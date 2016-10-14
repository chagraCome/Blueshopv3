<?php

/**
 * NOTICE OF LICENSE
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:39:00
 */
class Cms_Page_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'cms_page';
    $this->className = 'Cms_Page_Model';
    $this->map = array(
	'id' => 'id',
	'state' => 'state',
	'fixed' => 'fixed',
	'border' => 'border',
	'layout' => 'layout',
	'insertat' => 'insertat',
	'updateat' => 'updateat',
	'alias' => 'alias',
	'author_name' => 'author_name',
	'update_author_name' => 'update_author_name',
	'cms_site_id' => 'cms_site_id',
	'inherit_design_from_site' => 'inherit_design_from_site',
    );
    parent::__construct();
  }

  /**
   * @return string $_language_table_name
   */
  public function getLanguageTableName() {
    return "cms_page_lang";
  }

  /**
   * @return string $join_column
   */
  public function getJoinColumn() {
    return "cms_page_id";
  }

  /**
   * @return array $langMap
   */
  public function getLangMap() {
    return array(
	'title' => 'title',
	'keywords' => 'keywords',
	'description' => 'description',
	'content' => 'content'
    );
  }

  /**
   * Fetch by Alias.
   * @param type $alias
   * @return type
   */
  public function fetchByAlias($alias) {
    $this->where('alias = ?', addslashes($alias), PDO::PARAM_STR);
    return $this->fetch()->fetch();
  }

}

?>
