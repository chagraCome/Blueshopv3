<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Country_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $code;
  public $iso_code_2;
  public $iso_code_3;
  public $iso_country;
  public $country;
  public $lat;
  public $lon;

  /**
   * Gets Country id.
   * @return Integer $id 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Country id.
   * @param Integer $id
   * @return CountryModel 
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Sets Country code.
   * @param String $code
   * @return CountryModel
   */
  public function setCode($code) {
    $this->code = $code;
    return $this;
  }

  /**
   * Gets Country code.
   * @return String $code
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * Sets Country iso_code_2.
   * @param String $iso_code_2
   * @return CountryModel
   */
  public function setIsoCode2($iso_code_2) {
    $this->iso_code_2 = $iso_code_2;
    return $this;
  }

  /**
   * Gets Country  iso_code_2.
   * @return String $iso_code_2
   */
  public function getIsoCode2() {
    return $this->iso_code_2;
  }

  /**
   * Sets Country iso_code_3.
   * @param String $iso_code_3
   * @return CountryModel
   */
  public function setIsoCode3($iso_code_3) {
    $this->iso_code_3 = $iso_code_3;
    return $this;
  }

  /**
   * Gets Country iso_code_3.
   * @return String $iso_code_3
   */
  public function getIsoCode3() {
    return $this->iso_code_3;
  }

  /**
   * Sets Country iso_country.
   * @param String $iso_country
   * @return CountryModel
   */
  public function setIsoCountry($iso_country) {
    $this->iso_country = $iso_country;
    return $this;
  }

  /**
   * Gets Country iso_country.
   * @return String $ iso_country
   */
  public function getIsoCountry() {
    return $this->iso_country;
  }

  /**
   * Sets Country country.
   * @param String $country
   * @return CountryModel
   */
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  /**
   * Gets Country country.
   * @return String $country
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Sets Country lat.
   * @param Float $lat
   * @return CountryModel
   */
  public function setLat($lat) {
    $this->lat = $lat;
    return $this;
  }

  /**
   * Gets Country lat.
   * @return Float $lat
   */
  public function getLat() {
    return $this->lat;
  }

  /**
   * Sets Country lon.
   * @param Float $lon
   * @return CountryModel
   */
  public function setLon($lon) {
    $this->lon = $lon;
    return $this;
  }

  /**
   * Gets Country lon.
   * @return Float $lon
   */
  public function getLon() {
    return $this->lon;
  }

}

?>
