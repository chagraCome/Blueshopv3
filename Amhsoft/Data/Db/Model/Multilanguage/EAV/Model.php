<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Db_Model_Multilanguage_EAV_Model {

  /** @var Product_Set_Model $set */
  public $set;
  public $entity_set_id;
  private $attributes = array();

  /**
   * Gets Entity Set
   * @return Eav_Set_Model set
   */
  public function getEntitySet() {
    //return default set.
    if ($this->set == null && $this->entity_set_id > 0) {
      $entitySetAdapte = new Eav_Set_Model_Adapter();
      $this->set = $entitySetAdapte->fetchById($this->entity_set_id);
    }
    return ($this->set) ? $this->set : new Eav_Set_Model();
  }

  /**
   * Sets Entity Set
   * @param Eav_Set_Model $set
   * @return Amhsoft_Data_Db_Model_EAV_Model
   */
  public function setEntitySet($set) {
    $this->set = $set;
    return $this;
  }

  /**
   * Gets product attributes
   * @return array attributes
   */
  public function getAttributes() {
    if (empty($this->attributes)) {
      $entitySetAdapter = new Eav_Set_Model_Adapter();
      $this->set = $entitySetAdapter->fetchById($this->entity_set_id);
      if ($this->set instanceof Eav_Set_Model) {
        $this->attributes = $this->set->getAttributes();
      }
    }
    return $this->attributes;
  }

  public function getAttributeValue($name) {
    $attributes = $this->getAttributes();
    foreach ($attributes as $attr) {
      if ($attr->getName() == $name) {
        return $attr->getFrontEndComponent($this)->Value;
      }
    }
    return null;
  }

  public function __get($name) {

    if ($name) {

      if (preg_match("/_value$/i", $name)) {
        $newName = str_replace('_value', '', $name);

        if (!isset($this->$newName)) {
          $this->retrieveAttributesValues();
        }
        return $this->getAttributeValue($newName);
      }
    }
  }

  public function __set($name, $value) {
    if ($name) {
      if (preg_match("/_text$/i", $name)) {
        $orginal = str_replace('_text', '', $name);
        $attributes = $this->getAttributes();
        foreach ($attributes as $attribute) {
          if ($attribute->getName() == $orginal) {
            $this->{$orginal} = $attribute->getResolvedValue($value);
          }
        }
      } else {
        $this->{$name} = $value;
      }
    }
  }

  public function getAttributeValues() {
    $attributes = $this->getAttributes();
    $values = array();
    foreach ($attributes as $attr) {
      $values[] = $attr->getFrontEndComponent($this)->Value;
    }
    return $values;
  }

  public function getAttributeLabeledValues() {
    $attributes = $this->getAttributes();
    $values = array();
    foreach ($attributes as $attr) {
      if ($attr->entity_attribute_type_backend_id == 2) {
        $name = $attr->getName() . '_value';
        $values[] = $attr->getLabel() . ': ' . $this->$name;
      }
    }
    return $values;
  }

  public function getAttributeLabeledValuesAsString() {
    return @implode("\n", $this->getAttributeLabeledValues());
  }

  public function retrieveAttributesValues() {
    if (intval($this->id) < 0) {
      return;
    }

    $attributes = $this->getAttributes();
    foreach ($attributes as $attribute) {
      $this->{$attribute->getName()} = $attribute->getValue($this->id);
    }
  }
  
}

?>
