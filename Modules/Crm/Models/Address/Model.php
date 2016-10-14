<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Address_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $street;
  public $zipcode;
  public $city;
  public $province;
  public $country;
  public $account_id;
  public $use_other_shipping_address;

  /**
   * Sets id.
   * @param <type> id
   * @return Address
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

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Sets street.
   * @param <type> street
   * @return Address
   */
  public function setStreet($street) {
    $this->street = $street;
    return $this;
  }

  /**
   * Gets street.
   * @return <type> street
   */
  public function getStreet() {
    return $this->street;
  }

  /**
   * Sets zip_code.
   * @param <type> zip_code
   * @return Address
   */
  public function setZipCode($zip_code) {
    $this->zipcode = $zip_code;
    return $this;
  }

  /**
   * Gets zip_code.
   * @return <type> zip_code
   */
  public function getZipCode() {
    return $this->zipcode;
  }

  /**
   * Sets city.
   * @param <type> city
   * @return Address
   */
  public function setCity($city) {
    $this->city = $city;
    return $this;
  }

  /**
   * Gets city.
   * @return <type> city
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Sets province.
   * @param <type> province
   * @return Address
   */
  public function setProvince($province) {
    $this->province = $province;
    return $this;
  }

  /**
   * Gets province.
   * @return <type> province
   */
  public function getProvince() {
    return $this->province;
  }

  /**
   * Sets country.
   * @param <type> country
   * @return Address
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
   * Sets customer_id.
   * @param <type> customer_id
   * @return Address
   */
  public function setAccountId($account_id) {
    $this->account_id = $account_id;
    return $this;
  }

  /**
   * Gets customer_id.
   * @return <type> customer_id
   */
  public function getAccountId() {
    return $this->account_id;
  }

}

?>
