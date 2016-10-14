<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Attribute_Value_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'entity_attribute_value';
    $this->className = 'Eav_Attribute_Value_Model';
    $this->map = array(
	'id' => 'id',
	'entity_attribute_id' => 'entity_attribute_id',
	'entity_id' => 'entity_id',);
    parent::__construct();
  }

  /**
   * Get Language Table Name
   * @return string
   */
  public function getLanguageTableName() {
    return "entity_attribute_value_lang";
  }

  /**
   * Get Joint Column
   * @return string
   */
  public function getJoinColumn() {
    return "entity_attribute_value_id";
  }

  /**
   * Get Language Map
   * @return type
   */
  public function getLangMap() {
    return array(
	'value' => 'value',
    );
  }

}

?>
