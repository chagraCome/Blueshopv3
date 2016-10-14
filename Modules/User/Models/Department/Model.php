<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Department_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $country;
  public $telefon;
  public $address;

  /**
   * Sets id.
   * @param <type> id
   * @return Department
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
   * Sets name.
   * @param <type> name
   * @return Department
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets name.
   * @return <type> name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets country.
   * @param <type> country
   * @return Department
   */
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  /**
   * Gets country.
   * @return <type> country
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Sets telefon.
   * @param <type> telefon
   * @return Department
   */
  public function setTelefon($telefon) {
    $this->telefon = $telefon;
    return $this;
  }

  /**
   * Gets telefon.
   * @return <type> telefon
   */
  public function getTelefon() {
    return $this->telefon;
  }

  /**
   * Sets address.
   * @param <type> address
   * @return Department
   */
  public function setAddress($address) {
    $this->address = $address;
    return $this;
  }

  /**
   * Gets address.
   * @return <type> address
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * 
   * @return type
   */
  public function __toString() {
    return $this->getName();
  }

}

?>
