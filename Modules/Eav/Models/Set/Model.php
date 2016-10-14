<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Eav_Set_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $entity_id;
  public $attributes = array();
  public $views = array();

  /**
   * Sets ProductSet id.
   * @param Integer $id
   * @return Product_Set_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets ProductSet id.
   * @return Integer id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets ProductSet name.
   * @param String $name
   * @return Product_Set_Model
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets ProductSet name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * return array attributes
   */
  public function getAttributes($displayHidden = true) {
    $attributeArray = array();
    foreach ($this->attributes as $attribute) {
      if ($displayHidden == false && preg_match("/^hidden_/i", $attribute->getName())) {
	continue;
      }
      $attributeArray[] = $attribute;
    }
    return $this->attributes = $attributeArray;
  }

  /**
   * Gets Entity
   * @return Eav_Entity_Model
   */
  public function getEntity() {
    $entityAdapter = new Eav_Entity_Model_Adapter();
    $entity = $entityAdapter->fetchById($this->entity_id);
    if(!$entity instanceof Eav_Entity_Model){
      throw new Exception('no entity found');
    }
    return $entity;
  }
  
  /**
   * Get Views
   * @return type
   */
  public function getViews() {
    return $this->views;
  }

 
  /**
   * Get General Attributes
   * @param type $displayHidden
   * @return type
   */
  public function getGeneralAttributes($displayHidden = true) {
    $list = array();
    foreach ($this->attributes as $attribute) {
      if (intval($attribute->entity_set_view_id) > 0) {
	continue;
      }
      if ($displayHidden == false && preg_match("/^hidden_/i", $attribute->getName())) {
	continue;
      }
      $list[] = $attribute;
    }
    return $list;
  }

  /**
   * Add Attribute
   * @param Eav_Attribute_Model $attribute
   */
  public function addAttribute(Eav_Attribute_Model $attribute) {
    $this->attributes[] = $attribute;
  }

  /**
   * Gets View By Name
   * @param type $viewName
   * @return null
   */
  public function getViewByName($viewName) {
    foreach ($this->views as $view) {
      if ($view->getName() == $viewName) {
	return $view;
      }
    }
    return null;
  }

  /**
   * Add View
   * @param Eav_Set_View_Model $view
   */
  public function addView(Eav_Set_View_Model $view) {
    $this->views[] = $view;
  }

  /**
   * Get Attributes bu Name
   * @param type $attributeName
   * @return null
   */
  public function getAttributeByName($attributeName) {
    foreach ($this->attributes as $attribute) {
      if ($attribute->getName() == $attributeName) {
	$attribute->DataBinding = new Amhsoft_Data_Binding($attributeName);
	return $attribute;
      }
    }
    return null;
  }

}

?>
