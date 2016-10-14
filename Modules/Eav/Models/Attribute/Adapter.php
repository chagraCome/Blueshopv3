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
class Eav_Attribute_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  

  /**
   * Model Adapter Construct
   * @param type $entity
   */
  public function __construct() {
    $this->table = 'entity_attribute';
    $this->className = 'Eav_Attribute_Model';
    $this->map = array(
	'id' => 'id',
	'name' => 'name',
	'defaultvalue' => 'defaultvalue',
	'searchable' => 'searchable',
	'validator' => 'validator',
	'required' => 'required',
	'entity_attribute_type_backend_id' => 'entity_attribute_type_backend_id',
        'entity_id' => 'entity_id'
    );
   
    $this->defineOne2Many('datasources', 'entity_attribute_id', 'Eav_Attribute_DataSource_Model');
    parent::__construct();
  }

  /**
   * Joint Column
   * @return string
   */
  public function getJoinColumn() {
    return 'entity_attribute_id';
  }

  /**
   * Get Language Map
   * @return type
   */
  public function getLangMap() {
    return array(
	'label' => 'label',
	'errormessage' => 'errormessage'
    );
  }

  /**
   * Get Language Table Name
   * @return string
   */
  public function getLanguageTableName() {
    return 'entity_attribute_lang';
  }

  /**
   * Insert Entity Attribute
   * @param Amhsoft_Data_Db_Model_Interface $object
   * @param type $cascade
   */
  public function insert(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
    parent::insert($object, $cascade);
    if ($object->entity_attribute_type_backend_id != 2) { //clean iup datasources
      $sql = "DELETE FROM entity_attribute_datasource WHERE entity_attribute_id = " . $object->id;
      Amhsoft_Database::getInstance()->exec($sql);
    }
    $object->createAttributeInConfTable();
   
  }

  /**
   * Update Entity Attribute
   * @param Amhsoft_Data_Db_Model_Interface $object
   * @param type $cascade
   */
  public function update(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
    parent::update($object, $cascade);
  }

  /**
   * Delete Entity Attribute
   * @param type $id
   * @param type $entity
   */
  public function deleteById($id) {
    $adapter = new Eav_Attribute_Model_Adapter();
    $obj = $adapter->fetchById($id);
    parent::deleteById($id);
    $obj->removeAttributeFromConfTable();
    
  }

}

?>
