<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Responce.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Web_Responce {

  protected $data;
  protected $args = array();
  protected static $content;

  public function __construct() {
    $this->data = parse_url($this->getFullUrl());
    $this->args = array_merge((array)$_POST, (array)$_GET);
  }
  
  public static function getContent(){
    return self::$content;
  }
  
  public static function setContent($content){
    self::$content = $content;
  }

  public function get($name) {
    return isset($this->args[$name]) ? $this->args[$name] : null;
  }

  private function getFullUrl() {
    $s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
    $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos(strtolower($_SERVER['SERVER_PROTOCOL']), '/')) . $s . '://' : null;
    $port = isset($_SERVER['SERVER_PORT']) ? ($_SERVER['SERVER_PORT'] == '80') ? '' : (':' . $_SERVER['SERVER_PORT'])  : null;
    return $protocol . @$_SERVER['SERVER_NAME'] . $port . @$_SERVER['REQUEST_URI'];
  }

  /**
   * Gets scheme ex: http, https ...
   * @return string scheme
   */
  public function getScheme() {
    return $this->scheme;
  }

  /**
   * Gets host
   * @return string hostname
   */
  public function getHost() {
    return $this->host;
  }

  /**
   * Get Path
   * @return string path example: /admin/index.php
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * Gets user.
   * @return string user
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Gets pass.
   * @return string pass
   */
  public function getPass() {
    return $this->pass;
  }

  /**
   * Gets fragment
   * @return string fragement
   */
  public function getFragment() {
    return $this->fragment;
  }

  /**
   * Gets query
   * @return string query
   */
  public function getQuery() {
    return $this->query;
  }

  public function getPort() {
    return $this->port;
  }

  /**
   * Get query array.
   * @return array
   */
  private function getQueryArray() {
    $query = $this->getQuery();
    $array = array();
    if ($query) {
      parse_str($query, $array);
    } else {
      $query = GETENV("REQUEST_URI") ? getenv('REQUEST_UR') : @$_SERVER['REQEST_URI'];
      if ($query) {
        parse_str($query, $array);
      }
    }
    return $array;
  }

  public function __get($name) {
    return isset($this->data[$name]) ? $this->data[$name] : null;
  }

}

?>
