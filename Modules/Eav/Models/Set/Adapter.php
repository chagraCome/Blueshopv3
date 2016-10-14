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
class Eav_Set_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'entity_set';
    $this->className = 'Eav_Set_Model';
    $this->map = array(
	'id' => 'id',
	'entity_id' => 'entity_id'
        );
    $this->defineMany2Many('attributes', 'Eav_Attribute_Model', 'entity_set_has_entity_attribute', 'entity_set_id', 'entity_attribute_id', null, null, 'sortid', array('entity_set_view_id'));
    $this->defineOne2Many('views', 'entity_set_id', 'Eav_Set_View_Model', true, true, 'sortid');
    parent::__construct();
  }
  
  
    public function getJoinColumn() {
        return 'entity_set_id';
    }

    public function getLangMap() {
        return array('name' => 'name');
    }

    public function getLanguageTableName() {
        return 'entity_set_lang';
    }

  /**
   * Fetch sets by Name
   * @param type $entitySetName
   * @param type $entityName
   * @return null
   */
  public function fetchByName($entitySetName, $entityName) {
    if (!$entitySetName || !$entityName) {
      return null;
    }
    $adapter = new Eav_Set_Model_Adapter();
    $adapter->where('name = ?', $entitySetName, PDO::PARAM_STR);
    $adapter->where('entity_table_name = ?', $entityName, PDO::PARAM_STR);
    return $adapter->fetch()->fetch();
  }

  /**
   * Export   as XML
   * @param type $setid
   * @return type
   * @throws Exception
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public static function exportToXml($setid) {
    if (intval($setid) <= 0) {
      throw new Exception("set id is required");
    }
    $setAdapter = new Eav_Set_Model_Adapter();
    $set = $setAdapter->fetchById($setid);
    if (!$set instanceof Eav_Set_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $xmlSet = new SimpleXMLElement('<attributeset />');
    $xmlSet->addAttribute('entity', $set->getEntityTableName());
    $xmlSet->addAttribute('name', $set->getName());
    $xmlSet->addAttribute('id', $set->getId());
    $xmlGeneralView = $xmlSet->addChild('generalview');
    foreach ($set->getGeneralAttributes() as $attribute) {
      $xmlGeneralAttribute = $xmlGeneralView->addChild("attribute");
      $xmlGeneralAttribute->addAttribute('name', $attribute->getName());
      $xmlGeneralAttribute->addAttribute('id', $attribute->getId());
      $xmlGeneralAttribute->addAttribute('label', $attribute->getLabel());
      $xmlGeneralAttribute->addAttribute('backend', $attribute->getEntityAttributeTypeBackendClassName());
      $xmlGeneralAttribute->addAttribute('frontend', get_class(Amhsoft_Abstract_Control::CreateFrontEnd('attr', $attribute->getEntityAttributeTypeBackendId())));
      $xmlGeneralAttribute->addAttribute('searchable', $attribute->getSearchable());
      $xmlGeneralAttribute->addAttribute('errormessage', $attribute->getErrormessage());
      $xmlGeneralAttribute->addAttribute('defaultvalue', $attribute->getDefaultvalue());
      $xmlGeneralAttribute->addAttribute('required', $attribute->getRequired());
      $xmlGeneralAttribute->addAttribute('validator', $attribute->getValidator());
    }
    foreach ($set->getViews() as $view) {
      $xmlView = $xmlSet->addChild('view');
      $xmlView->addAttribute('name', $view->getName());
      $xmlView->addAttribute('id', $view->getId());
      foreach ($view->getAttributes() as $attribute) {
	$xmlAttribute = $xmlView->addChild("attribute");
	$xmlAttribute->addAttribute('name', $attribute->getName());
	$xmlAttribute->addAttribute('id', $attribute->getId());
	$xmlAttribute->addAttribute('label', $attribute->getLabel());
	$xmlAttribute->addAttribute('backend', $attribute->getEntityAttributeTypeBackendClassName());
	$xmlAttribute->addAttribute('frontend', get_class(Amhsoft_Abstract_Control::CreateFrontEnd('attr', $attribute->getEntityAttributeTypeBackendId())));
	$xmlAttribute->addAttribute('searchable', $attribute->getSearchable());
	$xmlAttribute->addAttribute('errormessage', $attribute->getErrormessage());
	$xmlAttribute->addAttribute('defaultvalue', $attribute->getDefaultvalue());
	$xmlAttribute->addAttribute('required', $attribute->getRequired());
	$xmlAttribute->addAttribute('validator', $attribute->getValidator());
      }
    }
    return $xmlSet->asXML();
  }

  /**
   * Inmport From Xml File
   * @param type $xmlFile
   */
  public static function importFromXml($xmlFile) {
    $xml = simplexml_load_file($xmlFile);
    $attributeSetName = (string) $xml['name'];
    $attributeSetEntity = (string) $xml['entity'];
    $entitySetAdapter = new Eav_Set_Model_Adapter();
    $set = $entitySetAdapter->fetchByName($attributeSetName, $attributeSetEntity);
    if (!$set instanceof Eav_Set_Model) {
      $set = new Eav_Set_Model();
      $set->setName($attributeSetName);
      $set->setEntityTableName($attributeSetEntity);
      $entitySetAdapter->save($set);
    }
    foreach ($xml->view as $view) {
      $setView = $set->getViewByName((string) $view['name']);
      if (!$setView instanceof Eav_Set_View_Model) {
	$setView = new Eav_Set_View_Model();
	$setView->setName((string) $view['name']);
	$setView->setFrontendvisible(true);
	$setView->entity_set_id = $set->getId();
	$setViewAdapter = new Eav_Set_View_Model_Adapter();
	$setViewAdapter->save($setView);
	$set->addView($setView);
      }
      foreach ($view->attribute as $attr) {
	$attribute = new Eav_Attribute_Model();
	$attribute->setName((string) $attr['name']);
	$attribute->setLabel((string) $attr['label']);
	$attribute->setRequired((string) $attr['required']);
	$attribute->setErrormessage((string) $attr['errormessage']);
	$attribute->setDefaultvalue((string) $attr['defaultvalue']);
	$attribute->setSearchable((string) $attr['searchable']);
	$attribute->setValidator((string) $attr['validator']);
	$attribute->setRequired((string) $attr['required']);
	$attribute->setEntityAttributeTypeBackendId(Amhsoft_Abstract_Control::getComponentId((string) $attr['backend']));
	$attribute->setEntityAttributeId(Amhsoft_Abstract_Control::getComponentId((string) $attr['frontend']));
	$attribute->setEntityId($attributeSetEntity);
	$attribute->entity_set_view_id = $setView->getId();
	try {
	  $attributeModelAdapter = new Eav_Attribute_Model_Adapter('product');
	  $attributeModelAdapter->save($attribute);
	  $sql_insert = "INSERT INTO entity_set_has_entity_attribute (entity_set_id, entity_attribute_id, sortid, entity_set_view_id) VALUES(:setid, :attribute_id,  0, :view_id)";
	  $stmt = Amhsoft_Database::newInstance()->prepare($sql_insert);
	  $stmt->bindValue(':setid', $set->getId());
	  $stmt->bindValue(':attribute_id', $attribute->getId());
	  $stmt->bindValue(':view_id', $setView->getId());
	  $stmt->execute();
	} catch (Exception $e) {
	  continue;
	}
      }
    }
  }


}

?>
