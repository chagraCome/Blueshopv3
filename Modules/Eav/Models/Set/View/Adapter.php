<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Eav_Set_View_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'entity_set_view';
    $this->className = 'Eav_Set_View_Model';
    $this->map = array(
	'id' => 'id',
	'frontendvisible' => 'frontendvisible',
	'entity_set_id' => 'entity_set_id',
    );
    $this->defineMany2Many('attributes', 'Eav_Attribute_Model', 'entity_set_has_entity_attribute', 'entity_set_view_id', 'entity_attribute_id', null, null, 'sortid', array('entity_set_id'));
    parent::__construct();
  }

  /**
   * Joint Column
   * @return string
   */
  public function getJoinColumn() {
    return 'entity_set_view_id';
  }

  /**
   * Get Language Map
   * @return type
   */
  public function getLangMap() {
    return array(
	'name' => 'name',
    );
  }

  /**
   * Get Language Table Name
   * @return string
   */
  public function getLanguageTableName() {
    return 'entity_set_view_lang';
  }

}

?>
