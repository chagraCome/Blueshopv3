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

class Eav_Attribute_Type_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $typename;

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets Name
   * @return type
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Gets Type name
   * @return type
   */
  public function getTypeName() {
    return $this->typename;
  }

  /**
   * Set Name
   * @param type $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Set Type Name
   * @param type $typename
   */
  public function setTypeName($typename) {
    $this->typename = $typename;
  }

  public function __toString() {
    return $this->getValue();
  }

}

?>
