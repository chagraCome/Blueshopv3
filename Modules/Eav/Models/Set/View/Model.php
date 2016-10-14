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
class Eav_Set_View_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $frontendvisible;
  public $entity_set_id;
  public $attributes = array();

  /**
   * Sets ProductAttribute id.
   * @param Integer $id
   * @return Product_Attribute_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets ProductAttribute id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets ProductAttribute name.
   * @param String $name
   * @return Product_Attribute_Model
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets ProductAttribute name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets Visible in frontend.
   * @param String $visible
   * @return Product_Attribute_Model
   */
  public function setFrontendvisible($visible) {
    $this->frontendvisible = $visible;
    return $this;
  }

  /**
   * Gets Visible in frontend.
   * @return String $visible
   */
  public function getFrontendvisible() {
    return $this->frontendvisible;
  }

  /**
   * Get Attributes
   * @return type
   */
  public function getAttributes() {
    return $this->attributes;
  }

}

?>
