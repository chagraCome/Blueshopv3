<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Local_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $local;
  public $country_iso3;
  public $double_comma;
  public $thousend_sep;
  public $decimal_sep;
  public $currency;
  public $currency_iso3;
  public $minor_unit;
  public $tel_code;
  public $time_zone;
  public $rate;
  public $base;
  public $langauge;
  public $country;
  public $currency_symbol;
  public $currency_cent;
  public $language;

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return 
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets local.
   * @return 
   * */
  public function getLocal() {
    return $this->local;
  }

  /**
   * Set local.
   * @param  local 
   * @return 
   * */
  public function setLocal($local) {
    $this->local = $local;
    return $this;
  }

  /**
   * Gets country_iso3.
   * @return 
   * */
  public function getCountry_iso3() {
    return $this->country_iso3;
  }

  /**
   * Set country_iso3.
   * @param  country_iso3 
   * @return 
   * */
  public function setCountry_iso3($country_iso3) {
    $this->country_iso3 = $country_iso3;
    return $this;
  }

  /**
   * Gets double_comma.
   * @return 
   * */
  public function getDouble_comma() {
    return $this->double_comma;
  }

  public function getLanguage() {
    return $this->language;
  }

  public function setLanguage($language) {
    $this->language = $language;
  }

  /**
   * Set double_comma.
   * @param  double_comma 
   * @return 
   * */
  public function setDouble_comma($double_comma) {
    $this->double_comma = $double_comma;
    return $this;
  }

  /**
   * Gets thousend_sep.
   * @return 
   * */
  public function getThousend_sep() {
    return $this->thousend_sep;
  }

  /**
   * Set thousend_sep.
   * @param  thousend_sep 
   * @return 
   * */
  public function setThousend_sep($thousend_sep) {
    $this->thousend_sep = $thousend_sep;
    return $this;
  }

  /**
   * Gets decimal_sep.
   * @return 
   * */
  public function getDecimal_sep() {
    return $this->decimal_sep;
  }

  /**
   * Set decimal_sep.
   * @param  decimal_sep 
   * @return 
   * */
  public function setDecimal_sep($decimal_sep) {
    $this->decimal_sep = $decimal_sep;
    return $this;
  }

  /**
   * Gets currency.
   * @return 
   * */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * Set currency.
   * @param  currency 
   * @return 
   * */
  public function setCurrency($currency) {
    $this->currency = $currency;
    return $this;
  }

  /**
   * Gets currency_iso3.
   * @return 
   * */
  public function getCurrencyIso3() {
    return $this->currency_iso3;
  }

  /**
   * Set currency_iso3.
   * @param  currency_iso3 
   * @return 
   * */
  public function setCurrencyIso3($currency_iso3) {
    $this->currency_iso3 = $currency_iso3;
    return $this;
  }

  /**
   * Gets minor_unit.
   * @return 
   * */
  public function getMinorUnit() {
    return $this->minor_unit;
  }

  /**
   * Set minor_unit.
   * @param  minor_unit 
   * @return 
   * */
  public function setMinorUnit($minor_unit) {
    $this->minor_unit = $minor_unit;
    return $this;
  }

  /**
   * Gets tel_code.
   * @return 
   * */
  public function getTel_code() {
    return $this->tel_code;
  }

  /**
   * Set tel_code.
   * @param  tel_code 
   * @return 
   * */
  public function setTelCode($tel_code) {
    $this->tel_code = $tel_code;
    return $this;
  }

  /**
   * Gets time_zone.
   * @return 
   * */
  public function getTimeZone() {
    return $this->time_zone;
  }

  /**
   * Set time_zone.
   * @param  time_zone 
   * @return 
   * */
  public function setTimeZone($time_zone) {
    $this->time_zone = $time_zone;
    return $this;
  }

  /**
   * Gets rate.
   * @return 
   * */
  public function getRate() {
    return $this->rate;
  }

  /**
   * Set rate.
   * @param  rate 
   * @return 
   * */
  public function setRate($rate) {
    $this->rate = $rate;
    return $this;
  }

  /**
   * Gets base.
   * @return 
   * */
  public function getBase() {
    return $this->base;
  }

  /**
   * Set base.
   * @param  base 
   * @return 
   * */
  public function setBase($base) {
    $this->base = $base;
    return $this;
  }

  /**
   * Gets country.
   * @return 
   * */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Set country.
   * @param  country 
   * @return 
   * */
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  /**
   * Gets currency_symbol.
   * @return 
   * */
  public function getCurrencySymbol() {
    return $this->currency_symbol;
  }

  /**
   * Set currency_symbol.
   * @param  currency_symbol 
   * @return 
   * */
  public function setCurrencySymbol($currency_symbol) {
    $this->currency_symbol = $currency_symbol;
    return $this;
  }

  /**
   * Gets currency_cent.
   * @return 
   * */
  public function getCurrencyCent() {
    return $this->currency_cent;
  }

  /**
   * Set currency_cent.
   * @param  currency_cent 
   * @return 
   * */
  public function setCurrencyCent($currency_cent) {
    $this->currency_cent = $currency_cent;
    return $this;
  }

}

?>
