<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Converter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Currency_Converter {

  /** @var Amhsoft_Currency_Converter_Adapter_Abstract $_adapter * */
  private static $_adapter = null;
  private static $_rates = array();

  public static function setAdapter(Amhsoft_Currency_Converter_Adapter_Abstract $adatper) {
    self::$_adapter = $adatper;
  }

  public static function getRates() {
    if (!empty(self::$_rates)) {
      return self::$_rates;
    }
    if (self::$_adapter === null) {
      throw new Amhsoft_Exception('No adapter definded for currency converter');
    }
    self::$_rates = self::$_adapter->getRates();
    return self::$_rates;
  }

  public static function OfflineConvert($currency) {
    $rates = self::getRates();
    if (isset($rates[$currency])) {
      return $rates[$currency];
    }
    return 1;
  }

  public static function tableConvert($amount, $currency, $decimal = 2) {
    $adapter = new Amhsoft_Currency_Converter_Adapter_Table('currency_set', 'rates');
    $rates = $adapter->getRates();
    if (empty($rates)) {
      return $amount;
    }
    $rates = $rates->rates;
    if ($currency) {
      if ($rates->{$currency}) {
        $factor = (double) $rates->{$currency};
        return number_format($amount * $factor, $decimal);
      }
    }
  }

  public static function OnlineConvert($baseCurrency, $targetCurrency, $method = 'google') {

    if ($method == 'google') {
      return self::quote_google_currency($targetCurrency, $baseCurrency);
    }
    if ($method == 'oanda') {
      return self::quote_oanda_currency($targetCurrency, $baseCurrency);
    }
    if ($method == 'xe') {
      return self::quote_xe_currency($targetCurrency, $baseCurrency);
    }

    if ($method == 'yahoo') {
      return self::quote_yahoo_currency($targetCurrency, $baseCurrency);
    }
  }

  private static function quote_oanda_currency($code, $base) {
    $page = file('http://www.oanda.com/convert/fxdaily?value=1&redirected=1&exch=' . $code . '&format=CSV&dest=Get+Table&sel_list=' . $base);
    $match = array();

    preg_match('/(.+),(\w{3}),([0-9.]+),([0-9.]+)/i', implode('', $page), $match);


    if (sizeof($match) > 0) {

      return $match[3];
    } else {
      return false;
    }
  }

  private static function quote_xe_currency($to, $from) {
    $page = file('http://www.xe.net/ucc/convert.cgi?Amount=1&From=' . $from . '&To=' . $to);

    $match = array();

    preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[1];
    } else {
      return false;
    }
  }

  private static function quote_yahoo_currency($to, $from) {
    $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $from . $to . '=X';
    $handle = @fopen($url, 'r');
    if ($handle) {
      $result = fgets($handle, 4096);
      fclose($handle);
    }

    $array = explode(',', $result);

    return $array[1];
  }

  private static function quote_google_currency($to, $from) {
    // The url to fetch search results, do not change #{money}# #{moneyfrom}# #{moneyto}#

    $page = "http://www.google.com/ig/calculator?hl=en&q=1$from=?$to";


    # Renders the google page result
    $json_raw = file_get_contents($page);

    $start = strpos($json_raw, 'rhs: "');
    if ($start > 0 && strpos($json_raw, 'error: ""')) {
      $end = strpos($json_raw, ' ', $start + 6);
      return substr($json_raw, $start + 6, $end - $start - 6);
    }
    return 1;
  }

}

?>