<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('AMHSOFT_COUNTRY_TUNISIA', _t('Tunisia'));
define('AMHSOFT_COUNTRY_BAHRAIN', _t('Bahrain'));
define('AMHSOFT_COUNTRY_GERMANY', _t('Germany'));
define('AMHSOFT_COUNTRY_Saudi_Arabia', _t('Saudi Arabia'));
define('AMHSOFT_COUNTRY_QATAR', _t('Qatar'));
define('AMHSOFT_COUNTRY_LEBANON', _t('Lebanon'));
define('AMHSOFT_COUNTRY_LIBYA', _t('Libya'));
define('AMHSOFT_COUNTRY_SUDAN', _t('Sudan'));
define('AMHSOFT_COUNTRY_Syrian_Arab_Republic', _t('Syrian Arab Republic'));
define('AMHSOFT_COUNTRY_KUWAIT', _t('Kuwait'));
define('AMHSOFT_COUNTRY_IRAQ', _t('Iraq'));
define('AMHSOFT_COUNTRY_ALGERIA', _t('Algeria'));
define('AMHSOFT_COUNTRY_GORDAN', _t('Jordan'));
define('AMHSOFT_COUNTRY_MOROCCO', _t('Morocco'));
define('AMHSOFT_COUNTRY_OMAN', _t('Oman'));
define('AMHSOFT_COUNTRY_EGYPT', _t('Egypt'));
define('AMHSOFT_United_Arab_Emirates', _t('United Arab Emirates'));
define('AMHSOFT_COUNTRY_YEMEN', _t('Yemen'));
define('AMHSOFT_COUNTRY_MAURITANIA', _t('Mauritania'));
define('AMHSOFT_COUNTRY_Palestinian_Territory', _t('Palestinian Territory'));
define('AMHSOFT_COUNTRY_United_States_of_America', _t('United States of America'));

/**
 * Description of Local
 *
 * @author administrator
 */
class Amhsoft_Locale {

  const de_DE = 'de_DE';
  const ar_AE = 'ar_AE';
  const ar_BH = 'ar_BH';
  const ar_DZ = 'ar_DZ';
  const ar_IQ = 'ar_IQ';
  const ar_JO = 'ar_JO';
  const ar_KW = 'ar_KW';
  const ar_LB = 'ar_LB';
  const ar_LY = 'ar_LY';
  const ar_MA = 'ar_MA';
  const ar_MR = 'ar_MR';
  const ar_OM = 'ar_OM';
  const ar_PS = 'ar_PS';
  const ar_QA = 'ar_QA';
  const ar_SA = 'ar_SA';
  const ar_SD = 'ar_SD';
  const ar_SY = 'ar_SY';
  const ar_TN = 'ar_TN';
  const ar_YE = 'ar_YE';
  const us_US = 'us_US';

  private static $current = 'de_DE';
  private static $available_locales = array(
      'ar_BH' => array(
          'country' => AMHSOFT_COUNTRY_BAHRAIN,
          'country_iso3' => 'BHR',
          'country_iso2' => 'BH',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => ',',
          'decimal_sep' => '.',
          'currency' => 'Bahraini Dinar',
          'currency_symbol' => 'BHD',
          'currency_iso3' => 'BHD',
          'currency_cent' => 'Fils',
          'minor_unit' => '1000',
          'tel_code' => '+973',
          'time_zone' => 'Asia/Bahrain',
      ),
      'ar_SA' => array(
          'country' => AMHSOFT_COUNTRY_Saudi_Arabia,
          'country_iso3' => 'SAU',
          'country_iso2' => 'SA',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Saudi Rial',
          'currency_symbol' => 'SAR',
          'currency_iso3' => 'SAR',
          'currency_cent' => 'Halala',
          'minor_unit' => '100',
          'tel_code' => '+966',
          'time_zone' => 'Asia/Riyadh'
      ),
      'de_DE' => array(
          'country' => AMHSOFT_COUNTRY_GERMANY,
          'country_iso3' => 'DEU',
          'country_iso2' => 'DE',
          'language' => 'German',
          'lang' => 'de',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Euro European',
          'currency_symbol' => '€',
          'currency_iso3' => 'EUR',
          'currency_cent' => 'Cent',
          'minor_unit' => '100',
          'tel_code' => '+49',
          'time_zone' => 'Europe/Berlin'
      ),
      'ar_TN' => array(
          'country' => AMHSOFT_COUNTRY_TUNISIA,
          'country_iso3' => 'TUN',
          'country_iso2' => 'TN',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Tunisian Dinar',
          'currency_symbol' => 'TND',
          'currency_iso3' => 'TND',
          'currency_cent' => 'Millimes',
          'minor_unit' => '1000',
          'tel_code' => '+216',
          'time_zone' => 'Africa/Tunis'
      ),
      'ar_QA' => array(
          'country' => AMHSOFT_COUNTRY_QATAR,
          'country_iso3' => 'KAT',
          'country_iso2' => 'QA',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Qatari Riyal',
          'currency_symbol' => 'QAR',
          'currency_iso3' => 'QAR',
          'currency_cent' => 'Dirham',
          'minor_unit' => '100',
          'tel_code' => '+974',
          'time_zone' => 'Asia/Qatar'
      ),
      'ar_LB' => array(
          'country' => AMHSOFT_COUNTRY_LEBANON,
          'country_iso3' => 'LBN',
          'country_iso2' => 'LB',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Lebanese Pound',
          'currency_symbol' => 'LBP',
          'currency_iso3' => 'LBP',
          'currency_cent' => 'Piastre',
          'minor_unit' => '100',
          'tel_code' => '+961',
          'time_zone' => 'Asia/Beirut'
      ),
      'ar_LY' => array(
          'country' => AMHSOFT_COUNTRY_LIBYA,
          'country_iso3' => 'LBY',
          'country_iso2' => 'LY',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Libyan Dinar',
          'currency_symbol' => 'LYD',
          'currency_iso3' => 'LYD',
          'currency_cent' => 'Dirham',
          'minor_unit' => '100',
          'tel_code' => '+218',
          'time_zone' => 'Africa/Tripoli'
      ),
      'ar_SD' => array(
          'country' => AMHSOFT_COUNTRY_SUDAN,
          'country_iso3' => 'SDN',
          'country_iso2' => 'SD',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Sudanese Pound',
          'currency_symbol' => 'SDG',
          'currency_iso3' => 'SDG',
          'currency_cent' => 'Piastres',
          'minor_unit' => '100',
          'tel_code' => '+249',
          'time_zone' => 'Africa/Khartoum'
      ),
      'ar_SY' => array(
          'country' => AMHSOFT_COUNTRY_Syrian_Arab_Republic,
          'country_iso3' => 'SYR',
          'country_iso2' => 'SY',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Syrian Pound',
          'currency_symbol' => 'SYP',
          'currency_iso3' => 'SYP',
          'currency_cent' => 'Piastre',
          'minor_unit' => '100',
          'tel_code' => '+963',
          'time_zone' => 'Asia/Damascus'
      ),
      'ar_KW' => array(
          'country' => AMHSOFT_COUNTRY_KUWAIT,
          'country_iso3' => 'KWT',
          'country_iso2' => 'KW',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Kuwaiti Dinar',
          'currency_symbol' => 'KWD',
          'currency_iso3' => 'KWD',
          'currency_cent' => 'Fils',
          'minor_unit' => '1000',
          'tel_code' => '+965',
          'time_zone' => 'Asia/Kuwait'
      ),
      'ar_IQ' => array(
          'country' => AMHSOFT_COUNTRY_IRAQ,
          'country_iso3' => 'IRQ',
          'country_iso2' => 'IQ',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Iraqi Dinar',
          'currency_symbol' => 'IQD',
          'currency_iso3' => 'IQD',
          'currency_cent' => 'fils',
          'minor_unit' => '1000',
          'tel_code' => '+964',
          'time_zone' => 'Asia/Baghdad'
      ),
      'ar_DZ' => array(
          'country' => AMHSOFT_COUNTRY_ALGERIA,
          'country_iso3' => 'DZA',
          'country_iso2' => 'DZ',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Algerian Dinar',
          'currency_symbol' => 'DZD',
          'currency_iso3' => 'DZD',
          'currency_cent' => 'Santeem',
          'minor_unit' => '100',
          'tel_code' => '+213',
          'time_zone' => 'Africa/Algiers'
      ),
      'ar_EG' => array(
          'country' => AMHSOFT_COUNTRY_EGYPT,
          'country_iso3' => 'EGP',
          'country_iso2' => 'EG',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => '٫',
          'currency' => 'Egyptian Pound',
          'currency_symbol' => 'EGP',
          'currency_iso3' => 'EGP',
          'currency_cent' => 'Santeem',
          'minor_unit' => '100',
          'tel_code' => '+213',
          'time_zone' => 'Africa/Cairo'
      ), 'ar_JO' => array(
          'country' => AMHSOFT_COUNTRY_GORDAN,
          'country_iso3' => 'JOR',
          'country_iso2' => 'JO',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Jordanian Dinar',
          'currency_symbol' => 'JOD',
          'currency_iso3' => 'JOD',
          'currency_cent' => 'Qirsh',
          'minor_unit' => '100',
          'tel_code' => '+962',
          'time_zone' => 'Asia/Ammans'
      ),
      'ar_MA' => array(
          'country' => AMHSOFT_COUNTRY_MOROCCO,
          'country_iso3' => 'MAR',
          'country_iso2' => 'MA',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Moroccan Dirham',
          'currency_symbol' => 'MAD',
          'currency_iso3' => 'MAD',
          'currency_cent' => 'Santim',
          'minor_unit' => '100',
          'tel_code' => '+212',
          'time_zone' => 'Africa/Casablanca'
      ),
      'ar_OM' => array(
          'country' => AMHSOFT_COUNTRY_OMAN,
          'country_iso3' => 'OMN',
          'country_iso2' => 'OM',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 3,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Omani Rial',
          'currency_symbol' => 'OMR',
          'currency_iso3' => 'OMR',
          'currency_cent' => 'Baisa',
          'minor_unit' => '1000',
          'tel_code' => '+968',
          'time_zone' => 'Asia/Muscat'
      ),
      'ar_AE' => array(
          'country' => AMHSOFT_United_Arab_Emirates,
          'country_iso3' => 'ARE',
          'country_iso2' => 'AE',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'United Arab Emirates Dirham',
          'currency_symbol' => 'AED',
          'currency_iso3' => 'AED',
          'currency_cent' => 'fils',
          'minor_unit' => '100',
          'tel_code' => '+971',
          'time_zone' => 'Asia/Dubai'
      ),
      'ar_YE' => array(
          'country' => AMHSOFT_COUNTRY_YEMEN,
          'country_iso3' => 'YEM',
          'country_iso2' => 'YE',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Yemeni Rial',
          'currency_symbol' => 'YER',
          'currency_iso3' => 'YER',
          'currency_cent' => 'fils',
          'minor_unit' => '100',
          'tel_code' => '+967',
          'time_zone' => 'Asia/Aden'
      ),
      'ar_MR' => array(
          'country' => AMHSOFT_COUNTRY_MAURITANIA,
          'country_iso3' => 'MRT',
          'country_iso2' => 'MR',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Mauritanian Ouguiya',
          'currency_symbol' => 'MRO',
          'currency_iso3' => 'MRO',
          'currency_cent' => 'Khoums',
          'minor_unit' => '100',
          'tel_code' => '+222',
          'time_zone' => 'Africa/Nouakchott'
      ),
      'ar_PS' => array(
          'country' => AMHSOFT_COUNTRY_Palestinian_Territory,
          'country_iso3' => 'PSE',
          'country_iso2' => 'PS',
          'language' => 'Arabic',
          'lang' => 'ar',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'Israeli New Shekel',
          'currency_symbol' => 'ILS',
          'currency_iso3' => 'ILS',
          'currency_cent' => 'Agorat',
          'minor_unit' => '100',
          'tel_code' => '+970',
          'time_zone' => 'Asia/Jerusalem'
      ),
      'us_US' => array(
          'country' => AMHSOFT_COUNTRY_United_States_of_America,
          'country_iso3' => 'USA',
          'country_iso2' => 'US',
          'language' => 'English',
          'lang' => 'en',
          'double_comma' => 2,
          'thousend_sep' => '.',
          'decimal_sep' => ',',
          'currency' => 'United States Dollar',
          'currency_symbol' => '$',
          'currency_iso3' => 'USD',
          'currency_cent' => 'Cent',
          'minor_unit' => '100',
          'tel_code' => '+1',
          'time_zone' => 'America/New_York'
      )
  );

  public static function initFromDatabase() {
    if (class_exists('Setting_Local_Model_Adapter')) {
      $localAdapter = new Setting_Local_Model_Adapter();
      foreach ($localAdapter->fetch() as $local) {
        self::$available_locales[$local->getLocal()]['language'] = $local->language;
        self::$available_locales[$local->getLocal()]['currency_symbol'] = $local->currency_symbol;
        self::$available_locales[$local->getLocal()]['currency_cent'] = $local->currency_cent;
        self::$available_locales[$local->getLocal()]['double_comma'] = $local->double_comma;
        self::$available_locales[$local->getLocal()]['rate'] = $local->rate;
      }
    }
  }

  public static function initLocalFromSession() {
    $currencyIso3 = Amhsoft_Common::GetCookie('current_currency');
    foreach (self::$available_locales as $local => $info) {
      if ($info['currency_iso3'] == $currencyIso3) {
        self::setLocale($local);
        return;
      }
    }
  }
  
  public static function getLocaleFromCountryIso3($countryIso3){
			foreach (self::$available_locales as $local => $info) {
				if ($info['country_iso3'] == $countryIso3) {
					return $info;
			    }  
		    }

  }

  public static function getLocaleFromCurrencyIso3($currency) {
    foreach (self::$available_locales as $local => $info) {
      if ($info['currency_iso3'] == $currency) {
        return $local;
      }
    }
  }

  public static function getAvailableLocal() {
    return array_keys(self::$available_locales);
  }

  public static function setLocale($local) {
    if (isset(self::$available_locales[$local])) {
      self::initFromDatabase();
      self::$current = $local;
      date_default_timezone_set(self::$available_locales[self::$current]['time_zone']);
    }
  }

  public static function getLocale() {
    return self::$current;
  }

  public static function getLocalInfo() {
    return self::$available_locales[self::$current];
  }

  public static function DateTime($timeAsString = null, $format = 'Y-m-d H:i:s') {
    $old_time_zone = date_default_timezone_get();
    date_default_timezone_set(self::$available_locales[self::$current]['time_zone']);
    if ($timeAsString != null) {
      if ($format == 'Y-m-d') {
        $timeAsString .= strlen($timeAsString) == 10 ? ' ' . date('H:i:s') : '';
      }
      $date = date($format, strtotime($timeAsString . 'UTC'));
    } else {
      $date = date($format);
    }
    date_default_timezone_set($old_time_zone);
    return $date;
  }

  public static function UCTDateTime($timeAsString = null, $format = 'Y-m-d H:i:s') {
    $old_time_zone = date_default_timezone_get();
    date_default_timezone_set('UTC');
    if ($timeAsString != null) {
      $offset = self::DateTimeOffset();
      if ($format == 'Y-m-d') {
        $date = date($format, strtotime($timeAsString . ' ' . date('H:i:s')));
      } else {
        $date = date($format, strtotime($timeAsString . $offset));
      }
    } else {
      $date = date($format);
    }
    date_default_timezone_set($old_time_zone);
    return $date;
  }

  public static function DateTimeOffset() {

    $old_time_zone = date_default_timezone_get();

    date_default_timezone_set(self::$available_locales[self::$current]['time_zone']);

    $mins = date_offset_get(new DateTime(self::DateTime())) / 60;
    $sgn = ($mins < 0 ? -1 : 1);
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;
    $offset = sprintf('%+d:%02d', $hrs * $sgn, $mins);
    date_default_timezone_set($old_time_zone);
    return $offset;
  }

  //Get DoubleComma from Current Country
  public static function getDoubleComma() {
    return self::$available_locales[self::$current]['double_comma'];
  }

  //Get DecimalSep from Current Country
  public static function getDecimalSep() {
    return self::$available_locales[self::$current]['decimal_sep'];
  }

  //Get ThousendSep from Current Country
  public static function getThousandSep() {
    return self::$available_locales[self::$current]['thousend_sep'];
  }

  //Get TimeZone from Current Country
  public static function getTimeZone() {
    return self::$available_locales[self::$current]['time_zone'];
  }

  //Get Currency from Current Country
  public static function getCurrency() {
    return self::$available_locales[self::$current]['currency'];
  }

  //Get CurrencySymbol from Current Country
  public static function getCurrencySymbol() {
    return self::$available_locales[self::$current]['currency_symbol'];
  }

  //Get CurrencyIso3 from Current Country
  public static function getCurrencyIso3() {
    return self::$available_locales[self::$current]['currency_iso3'];
  }

  //Get CountryIso3 from Current Country
  public static function getCountryIso3() {
    return self::$available_locales[self::$current]['country_iso3'];
  }

  //Get CountryIso2 from Current Country
  public static function getCountryIso2() {
    return self::$available_locales[self::$current]['country_iso2'];
  }

  //Get Language from Current Country
  public static function getLanguage() {
    return self::$available_locales[self::$current]['language'];
  }

  //Get Lang from Current Country
  public static function getLang() {
    return self::$available_locales[self::$current]['lang'];
  }

  //Get CurrencyCent from Current Country
  public static function getCurrencyCent() {
    return self::$available_locales[self::$current]['currency_cent'];
  }

  //Get MinorUnit from Current Country
  public static function getMinorUnit() {
    return self::$available_locales[self::$current]['minor_unit'];
  }

  //Get TelCode from Current Country
  public static function getTelCode() {
    return self::$available_locales[self::$current]['tel_code'];
  }

  //Get TelCode from Current Country
  public static function getRate() {
    if (isset(self::$available_locales[self::$current]['rate'])) {
      return self::$available_locales[self::$current]['rate'];
    }
  }

  public static function convertCurrency($amount, $to, $from,$decimal = 3) {
    $localFrom = self::getLocaleFromCurrencyIso3($from);
    $localTo = self::getLocaleFromCurrencyIso3($to);

    $from_rate = isset(self::$available_locales[$localFrom]['rate']) ? self::$available_locales[$localFrom]['rate'] : 1;
    $to_rate = isset(self::$available_locales[$localTo]['rate']) ? self::$available_locales[$localTo]['rate'] : 1;
    return number_format(($amount / $to_rate) * $from_rate,$decimal);
  }

  public static function getCurrenciesAsArray() {
    $currencies = array();
    foreach (self::$available_locales as $local => $data) {
      $currencies['currency_iso3'] = $data['currency'];
    }
    return $currencies;
  }

  public static function getCurrencySymbolsAsArray() {
    $currencysymbols = array();
    foreach (self::$available_locales as $local => $data) {
      $currencysymbols[] = $data['currency_symbol'];
    }
    return $currencysymbols;
  }

  public static function getCurrencyIsoAsArray() {
    $currencyiso = array();
    foreach (self::$available_locales as $local => $data) {
      $currencyiso[] = $data['currency_iso3'];
    }
    return $currencyiso;
  }

  public static function resetLocalTable() {
    Amhsoft_Database::getInstance()->exec('DELETE FROM `locale` WHERE 1');
    Amhsoft_Database::getInstance()->exec('DELETE FROM `locale_lang` WHERE 1');
  }

  public static function flushLocalToDatabase() {
    $settingModelAdapter = new Setting_Local_Model_Adapter();
    foreach (self::$available_locales as $local => $localinfo) {
      $settingLocale = new Setting_Local_Model();
      $settingLocale->setLocal($local);
      $settingLocale->setCountry($localinfo['country']);
      $settingLocale->setCountry_iso3($localinfo['country_iso3']);
      $settingLocale->setLanguage($localinfo['language']);
      $settingLocale->setMinorUnit($localinfo['minor_unit']);
      $settingLocale->setCurrencyCent($localinfo['currency_cent']);
      $settingLocale->setCurrencyIso3($localinfo['currency_iso3']);
      $settingLocale->setDecimal_sep($localinfo['decimal_sep']);
      $settingLocale->setDouble_comma($localinfo['double_comma']);
      $settingLocale->setThousend_sep($localinfo['thousend_sep']);
      $settingLocale->setTelCode($localinfo['tel_code']);
      $settingLocale->setTimeZone($localinfo['time_zone']);
      $settingLocale->setCurrency($localinfo['currency']);
      $settingLocale->setCurrencySymbol($localinfo['currency_symbol']);
      $settingLocale->setRate('1.000000');
      $settingLocale->setBase('1');
      $settingModelAdapter->save($settingLocale);
    }
  }

  public static function getCurrencyCentAsArray() {
    $currencycent = array();
    foreach (self::$available_locales as $local => $data) {
      $currencycent[] = $data['currency_cent'];
    }
    return $currencycent;
  }

  public static function getMinorUnitAsArray() {
    $minorunit = array();
    foreach (self::$available_locales as $local => $data) {
      $minorunit[] = $data['minor_unit'];
    }
    return $minorunit;
  }

  public static function getTelCodeAsArray() {
    $telcode = array();
    foreach (self::$available_locales as $local => $data) {
      $telcode[] = $data['tel_code'];
    }
    return $telcode;
  }

  public static function getTimeZoneAsArray() {
    $timezone = array();
    foreach (self::$available_locales as $local => $data) {
      $timezone[] = $data['time_zone'];
    }
    return $timezone;
  }

  public static function getCountries() {
    $countries = array();
    foreach (self::$available_locales as $local => $data) {
      $countries[] = $data['country'];
    }
    return $countries;
  }

  public static function getCountryArray() {
    $countries = array();
    foreach (self::$available_locales as $local => $data) {
      $countries[] = array('iso' => $data['country_iso3'], 'name' => $data['country']);
    }
    return $countries;
  }

  public static function getAll() {
    return self::$available_locales;
  }

  public static function DateAdd($dateAsString, $sec = 0, $min = 0, $hours = 0, $day = 0, $mth = 0, $yr = 0) {
    $cd = strtotime($dateAsString);
    $newdate = date('Y-m-d H:i:s', mktime(date('H', $cd) + $hours, date('i', $cd) + $min, date('s', $cd) + $sec, date('m', $cd) + $mth, date('d', $cd) + $day, date('Y', $cd) + $yr));
    return $newdate;
  }

  public static function DateSub($dateAsString, $sec = 0, $min = 0, $hours = 0, $day = 0, $mth = 0, $yr = 0) {
    $cd = strtotime($dateAsString);
    $newdate = date('Y-m-d H:i:s', mktime(date('H', $cd) - $hours, date('i', $cd) - $min, date('s', $cd) - $sec, date('m', $cd) - $mth, date('d', $cd) - $day, date('Y', $cd) - $yr));
    return $newdate;
  }

}

?>
