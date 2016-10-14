<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Attribute_Value_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $entity_attribute_id;
  public $entity_id;
  public $value;

  /**
   * Sets id.
   * @param <type> id
   * @return ProductAttributeValue
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets id.
   * @return <type> id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets entity_attribute_id.
   * @param <type> entity_attribute_id
   * @return ProductAttributeValue
   */
  public function setEntityAttributeId($entity_attribute_id) {
    $this->entity_attribute_id = $entity_attribute_id;
    return $this;
  }

  /**
   * Gets entity_attribute_id.
   * @return <type> entity_attribute_id
   */
  public function getEntityAttributeId() {
    return $this->entity_attribute_id;
  }

  /**
   * Sets entity_id.
   * @param <type> entity_id
   * @return ProductAttributeValue
   */
  public function setEntityId($entity_id) {
    $this->entity_id = $entity_id;
    return $this;
  }

  /**
   * Gets entity_id.
   * @return <type> entity_id
   */
  public function getEntityId() {
    return $this->entity_id;
  }

  /**
   * Gets Value
   * @return type
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Set Value
   * @param type $value
   */
  public function setValue($value) {
    $this->value = $value;
  }

}

?>
