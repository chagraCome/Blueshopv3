<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Session.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Session {

  protected static $lifeTime = 1800;

  /** @var Amhsoft_Session_Interface $_adapter */
  private static $_adapter;

  public static function init($adapter = null) {

    if (is_string($adapter)) {
      if ($adapter == 'php') {
        self::$_adapter = new Amhsoft_Session_PHP_Adapter();
      }
      if ($adapter == 'db') {
        self::$_adapter = new Amhsoft_Session_DB_Adapter();
		self::$_adapter->deleteOld();
      }
    } else if ($adapter instanceof Amhsoft_Session_Interface) {
      self::$_adapter = $adapter;
    }



    // Read the maxlifetime setting from PHP
    self::$life_time = @get_cfg_var("session.gc_maxlifetime");

    // Register this object as the session handler
    session_set_save_handler(
            array($this, "open"), array($this, "close"), array($this, "_read"), array($this, "_write"), array($this, "destroy"), array($this, "gc")
    );
  }

  public static function setAdapter(Amhsoft_Session_Interface $adapter) {
    self::$_adapter = $adapter;
  }

  public static function getAdapter() {
    return self::$_adapter;
  }

  /**
   * read a session key.
   * @param string $item
   * @return mixed
   */
  public static function read($item, $default = false) {

    $e = self::$_adapter->read($item);
    if ($e == null) {
      return $default;
    }
    return $e;
    //return isset($_SESSION[$item]) ? $_SESSION[$item] : $default;
  }
  
  	public static function deleteOld(){
		self::$_adapter->deleteOld();
	}

  /**
   * Write session key, value.
   * @param string $key
   * @param mixed $value
   * @return type 
   */
  public static function write($key, $value) {
    if (is_array($value) || is_object($value)) {
      $value = serialize($value);
    }
    //$_SESSION[$key] = $value;
    return self::$_adapter->write($key, $value);
  }

  /**
   * Open the session
   * @return bool
   */
  public static function open() {
    return true;
  }

  public static function getFingerPrint(){
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $ip = Amhsoft_Common::GetClientHostname().  Amhsoft_Common::GetClientIp();
    $finger_print = sha1($userAgent.'::'.$ip);
    return $finger_print;
  }
  
  public static function secureOpen() {
    $finger_print = self::getFingerPrint();
    
    session_name('AMHSOFT');
    session_start();
    
    if(!isset($_SESSION['fingerprint'])){
       $_SESSION['fingerprint'] =  $finger_print;
    }
   
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_lifetime', 0);
    ini_set('session.cookie_secure', 1);
    
    if($_SESSION['fingerprint'] != $finger_print){
     
      Amhsoft_Session::destroyAll();
      unset($_SESSION['fingerprint']);
    }
    
    
  }

  /**
   * Close the session
   * @return bool
   */
  public static function close() {
    return true;
  }

  /**
   * Destoroy the session
   * @param int session id
   * @return bool
   */
  public static function destroyAll() {
    self::$_adapter->destroyAll();
  }

  /**
   * Destoroy the session
   * @param int session id
   * @return bool
   */
  public static function destroy($key) {
    self::$_adapter->destroy($key);
  }

  /**
   * Garbage Collector
   * @param int life time (sec.)
   * @return bool
   * @see session.gc_divisor      100
   * @see session.gc_maxlifetime 1440
   * @see session.gc_probability    1
   * @usage execution rate 1/100
   *        (session.gc_probability/session.gc_divisor)
   */
  public static function gc($max) {
    //$maxlife = time() - $max;
    //return Amhsoft_Database::getInstance()->exec("DELETE FROM `session` WHERE `session_expiry` < ?", microtime() + $maxlife);
  }

  public static function clear($key) {
    self::$_adapter->destroy($key);
  }

}

?>
