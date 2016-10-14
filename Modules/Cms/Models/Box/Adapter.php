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

class Cms_Box_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'cms_box';
    $this->className = 'Cms_Box_Model';
    $this->map = array(
	'id' => 'id',
	'file' => 'file',
	'online' => 'online',
	'border' => 'border',
	'link' => 'link',
	'entrypoint' => 'entrypoint'
    );
    parent::__construct();
  }

  /**
   * @return string $_language_table_name
   */
  public function getLanguageTableName() {
    return "cms_box_lang";
  }

  /**
   * @return array $langMap
   */
  public function getLangMap() {
    return array('html' => 'html', 'name' => 'name', 'image' => 'image');
  }

  /**
   * @return string $join_column
   */
  public function getJoinColumn() {
    return "cms_box_id";
  }

}

?>
