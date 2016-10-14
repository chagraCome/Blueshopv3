<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Server.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package  Api
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Api_Server {

  private static $allowdRequestTypes = array('xml', 'json');
  private static $versions = array('1.0', '1.1');

  /**
   * 
   * @param type $type
   * @return \Amhsoft_Api_Json_Adapter|\Amhsoft_Api_Xml_Adapter
   * @throws Exception
   */
  public static function getAdapter($type) {
    if ($type == 'xml') {
      return new Amhsoft_Api_Xml_Adapter();
    }
    if ($type == 'json') {
      return new Amhsoft_Api_Json_Adapter();
    }

    throw new Exception('no adapter found');
  }

  public static function listen(Amhsoft_System $system) {

    $req = new Amhsoft_Web_Request();
    $rpc_request = $req->post('rpc_request');
    $type = $req->get('type');
    if (!in_array($type, self::$allowdRequestTypes)) {
      self::error('not allowed type');
      exit;
    }

    $adapter = self::getAdapter($type);
    $adapter->analysePackage($rpc_request);
    $package = $adapter->getPackage();

    $publicKey = $req->post('key');

    if ($publicKey) {
      session_id($publicKey);
      if (!Amhsoft_Authentication::getInstance()->isAuthenticated()) {
        $adapter->error('you key is expired, please login again');
        exit;
      }
    } else {
      if (!$adapter->isLoginPackage()) {
        $adapter->error('please login first');
        exit;
      }
    }

    $version = $req->get('version');
    if (!in_array($version, self::$versions)) {
      $adapter->error('version not supported');
      exit;
    }


    $adapter->responce($system);
  }

  public static function error($message) {
    echo $message;
  }

  public static function log() {
    $req = new Amhsoft_Web_Request();
    echo 'Request type: ' . $req->get('type') . '<br />';
    echo 'Request Data: ' . $req->post('data');
  }

}
