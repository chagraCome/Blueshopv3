<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Navigator.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Amhsoft_Navigator {

  protected $filename;
  protected $ssl;
  protected $port;
  public static $DEBUG_MODE = false;
  protected static $destination;

  /**
   * Get the destination
   * @return string destination
   */
  public static function getDestination() {
    return self::$destination;
  }

  /**
   * Go to distination
   * @param string $to
   * @param boolean $friendly
   * @param type $sign
   * @return void
   */
  function go($to, $friendly = false, $sign = null) {

    self::$destination = $to;

    $friendly_url = null;
    $u = array();
    if (Amhsoft_System_Config::getInstance()->url_friendly == true && $friendly == true) {
      $pairs = explode('&', $to);
      foreach ($pairs as $pair) {
        $new = explode('=', $pair, 2);
        $u[] = $new[1];
      }
      $friendly_url = implode("-", $u) . ".html";
      unset($_POST);
      if (self::$DEBUG_MODE == true) {
        self::$destination = $to;
        return;
      }
      header('Location: ' . $friendly_url);
      exit;
    } else {
      if (self::$DEBUG_MODE == true) {
        self::$destination = $to;
        return;
      }
      header('Location: ' . $to);
      exit;
    }
  }

  function url($to, $friendly = false, $sign = null) {
    $friendly_url = null;
    $u = array();
    if ($friendly == true) {
      $pairs = explode('&', $to);
      foreach ($pairs as $pair) {
        $new = explode('=', $pair, 2);
        if (isset($new[1]))
          $u[] = $new[1];
      }
      $friendly_url = implode("-", $u) . ".html";
      unset($_POST);
      return shop::getProperty('shop_url') . $friendly_url;
    }
    else
      return shop::getProperty('shop_url') . $to;
  }

  function build_Url() {
    if (empty($this->filename))
      $this->set_ssl() . $this->set_host() . $this->set_root();

    if ($this->url_friendly)
      $this->filename = ereg_replace(".php", ".html", $this->filename);

    if ($this->port != 80)
      $this->set_host = $this->set_host . ":" . $this->port;

    return $this->set_ssl() . $this->set_host() . $this->set_root() . $this->filename;
  }

  function set_ssl() {
    if ($this->ssl == true)
      return "http://";
    return "http://";
  }

  function set_root() {
    return "amhshop";
  }

  function set_host() {
    return HOST;
  }

  public static function buildVar($component) {
    if ($component == '')
      return;

    $search = array(' ', ':', '_', '.', '#', '\'', '&', '*', '+', '�', '%', '!', '�', '^', '@', '|', '<', '>', '�', '�', '�', ';', ',', '`', ')', '(', '$', '?', '�', '[', ']', '{', '}', '~', '/', '�', '�', '�', '\'');
    $replace = array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 'ae', 'ue', 'oe', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 'Ue', 'Ae', 'Oe', '');

    $component = str_replace($search, $replace, $component);
    $component = ereg_replace("--", "-", $component);
    $component = ereg_replace("--", "-", $component);
    $component = ereg_replace("--", "-", $component);
    return $component;
  }

  /**
   * GO to 404 page
   */
  public static function error_404() {
    if (self::$DEBUG_MODE == true) {
      return;
    }
    header("HTTP/1.0 404 Not Found");
    header("Location: ?page=notfound");
    exit;
  }

  /**
   * Go to 301 page
   */
  public static function error_301() {
    if (self::$DEBUG_MODE == true) {
      return;
    }
    header("HTTP/1.0 301 Not Found");
    header("Location: ?page=notfound", TRUE, 301);
    exit;
  }

}

?>