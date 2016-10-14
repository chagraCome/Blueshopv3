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
class Cms_Site_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->className = 'Cms_Site_Model';
    $this->table = 'cms_site';
    $this->map = array(
	'id' => 'id',
	'name' => 'name',
	'state' => 'state',
	'title' => 'title',
	'root' => 'root',
	'width' => 'width',
	'style' => 'style',
	'require_login' => 'require_login',
	'description' => 'description',
	'homepage' => 'homepage',
	'defaultsite' => 'defaultsite'
    );
    parent::__construct();
  }

  /**
   * Fetch By Root.
   * @param type $site
   * @return null
   */
  public function fetchByRoot($site) {
    $cmsSiteModelAdapter = new Cms_Site_Model_Adapter();
    $cmsSiteModelAdapter->where('root = ?', $site, PDO::PARAM_STR);
    if ($cmsSiteModelAdapter->getCount() > 0) {
      return $cmsSiteModelAdapter->fetch()->fetch();
    }
    return null;
  }

  /**
   * Fetch Default Root.
   * @return null
   */
  public function fetchDefaultRoot() {
    $cmsSiteModelAdapter = new Cms_Site_Model_Adapter();
    $cmsSiteModelAdapter->where('root IS NULL');
    if ($cmsSiteModelAdapter->getCount() > 0) {
      return $cmsSiteModelAdapter->fetch()->fetch();
    }
    return null;
  }

}

?>
