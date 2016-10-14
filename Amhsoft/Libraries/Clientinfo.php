<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Clientinfo.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Clientinfo{

  var $ip;
  var $hostname;
  var $browser;
  var $browser_version;
  var $os;
  var $referer;
  var $keys;
  var $search_engine;
  var $sep; //private
  var $product;
  var $spider = false;



  function Amhsoft_Clientinfo(){
  }


  public static function getClientOs()
  {
    $os = '';
    if(!isset($_SERVER['HTTP_USER_AGENT']))
    return;
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match("~Windows~si", $user_agent)) { // Windows
      if(preg_match("~Windows NT 6.0~si", $user_agent)) { // Windows Vista
        $this->os = "Windows Vista";
        return $os;
      }
      if(preg_match("~Windows NT 6.1~si", $user_agent)) { // Windows XP
        $os    = "Windows 7";
        return $os;
      }
      if(preg_match("~Windows NT 5.1~si", $user_agent)) { // Windows XP
        $os    = "Windows XP";
        return $os;
      }
      if(preg_match("~Windows NT 5.0~si", $user_agent)) { // Windows 2000
        $os    = "Windows 2000";
        return $os;
      }
      if(preg_match("~Windows 98~si", $user_agent) || preg_match("~Win98~si", $user_agent)) { // Windows 98
        $os    = "Windows 98";
        return $os;
      }
      if(preg_match("~Windows 95~si", $user_agent) || preg_match("~Win95~si", $user_agent)) { // Windows 95
        $os    = "Windows 95";
        return $os;
      }
    }
    if(preg_match("~Linux~si", $user_agent)) { // Linux
      $os = "Linux";
      return $os;
    }
    if(preg_match("~OS\/2~si", $user_agent)) { // OS/2
      $os = "OS/2";
      return $os;
    }
    if(preg_match("~Macintosh~si", $user_agent) || preg_match("~Mac_PowerPC~si", $user_agent)) {  // Mac
      $os = "Mac OS X";
      return $os;
    }
    if(preg_match("~SunOS~si", $user_agent)) { // SunOS
      $os = "SunOS";
      return $os;
    }
    return 'Unknown';
  }


  public static function is_spider(){
    return (Amhsoft_Clientinfo::getClientOs() == '');
  }

  public static function getClientBrowserInfo(){
    $browser        = null;
    $browserVersion = null;

    if(!isset($_SERVER['HTTP_USER_AGENT']))
    return null;

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if(preg_match("~Mozilla~si", $user_agent)) { // Mozilla Browser (falls genauere Analyse des Browsers fehlschlaegt)
      $browser = "Mozilla";
    }

    if(preg_match("~Gecko~si", $user_agent)) { // Gecko Browser (falls genauere Analyse des Browsers fehlschlaegt)
      $browser = "Gecko";
    }

    if(preg_match("~Firefox~si", $user_agent)) { // Firefox Browser
      $browser = "Firefox";
      $pos     = strpos($user_agent, "Firefox/");
      $browserVersion = trim(@substr($user_agent, $pos+8));
    }
    if(preg_match("~SeaMonkey~si", $user_agent)) { // SeaMonkey
      $browser = "SeaMonkey";
      $pos     = strpos($user_agent, "SeaMonkey/");
      $browserVersion = trim(@substr($user_agent, $pos+10));
    }
    if(preg_match("~Epiphany~si", $user_agent)) { // Epiphany
      $browser = "Epiphany";
      $pos     = strpos($user_agent, "Epiphany/");
      $browserVersion = trim(preg_replace("~\((.*?)\)~si", "", @substr($user_agent, $pos+9)));
    }
    if(preg_match("~Galeon~si", $user_agent)) { // Epiphanyvorgaenger Galeon
      $browser = "Galeon";
      $pos     = strpos($user_agent, "(");
      $browserVersion = trim(@substr($user_agent, 19, $pos-19));
    }
    if(preg_match("~Camino~si", $user_agent)) { // Camino
      $browser = "Camino";
      $pos     = strpos($user_agent, "Camino/");
      $browserVersion = trim(preg_replace("~\((.*?)\)~si", "", substr($user_agent, $pos+7)));
    }
    if(preg_match("~Opera~si", $user_agent)) { // Opera
      $browser = "Opera";
      $pos     = strpos($user_agent, "Opera");
      if($pos    == 0) {
        $browserVersion = @substr($user_agent, 6, 4);
      } else {
        $pos    = strpos($user_agent, "Opera");
        $browserVersion = trim(preg_replace("~\[(.*?)\]~si", "", @substr($user_agent, $pos+6)));
      }
    }
    if(preg_match("~MSIE~si", $user_agent)) { // Internet Explorer
      $browser = "Internet Explorer";
      $browserVersion = @explode(";", $user_agent);
      $browserVersion = @substr($browserVersion[1], 6);
    }
    if(preg_match("~Safari~si", $user_agent)) { // Safari Browser
      $browser = "Safari";
      $pos     = strpos($user_agent, "Safari/");
      $browserVersion     = trim(substr($user_agent, $pos+7));
      $browserVersion = "";//getSafariVersionByBuilt( $build );
    }
    if(preg_match("~Konqueror~si", $user_agent)) { // Konqueror Browser
      $browser = "Konqueror";
      $browserVersion = @explode(";", $user_agent);
      $browserVersion = @explode("/", $browserVersion[1]);
      $browserVersion = isset($browserVersion[1]) ? $browserVersion[1] : "";
    }
    if(preg_match("~Netscape~si", $user_agent)) { // Netscape
      $browser = "Netscape";
      $browserVersion = explode("/", $user_agent);
      $browserVersionn = trim(@preg_replace("~\((.*?)\)~si", "", $browserVersion[3]));
    }

    return array($browser, $browserVersion);
  }

  public static function getClientBrowser(){
    $erg = Amhsoft_Clientinfo::getClientBrowserInfo();
    if(isset($erg[0]))
    return $erg[0];
    return null;
  }

  public static function getBrowserVersion(){
    $erg = Amhsoft_Clientinfo::getClientBrowserInfo();
    if(isset($erg[1]))
    return $erg[1];
    return null;
  }

  public static function GetClientIp(){
    return   ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
  }

  /*
   * @return string Hostname of client IP
   */
  public static function GetClientHostname(){
    return gethostbyaddr(Amhsoft_Clientinfo::GetClientIp());
  }

  public static function getReferer(){
    if(!isset($_SERVER['HTTP_REFERER']) && !isset($_ENV['HTTP_REFERER'])){
      return null;
    }
    $referer = @urlencode(isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_ENV['HTTP_REFERER'];
  }

  public static function getRefererSep(){
    return (eregi('(\?q=|\?qt=|\?p=)', Amhsoft_Clientinfo::getReferer())) ? '\?' : '\&';
  }

  public static function getProduct()
  {
    if(isset($_GET["module"]) && strip_tags($_GET["module"])== "vehicle")
    {
      if(isset($_GET["page"]) && strip_tags($_GET["page"]) == "cardetails")
      {
        $product = $_GET["id"];
        if(intval($product) > 0)
        return $product;
      }
    }
    return "";
  }

  public static function get_keys()
  {
    if (!empty($this->referer))
    {
      if (eregi('www\.google', $this->referer))
      {
        // Google
        preg_match("#{$this->sep}q=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'Google';
      }
      else if (eregi('(yahoo|search\.yahoo)', $this->referer))
      {
        // Yahoo
        preg_match("#{$this->sep}p=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'Yahoo';
      }
      else if (eregi('search\.msn', $this->referer))
      {
        // MSN
        preg_match("#{$this->sep}q=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'MSN';
      }
      else if (eregi('www\.alltheweb', $this->referer))
      {
        // AllTheWeb
        preg_match("#{$this->sep}q=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'AllTheWeb';
      }
      else if (eregi('(looksmart\.com|search\.looksmart)', $this->referer))
      {
        // Looksmart
        preg_match("#{$this->sep}qt=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'Looksmart';
      }
      else if (eregi('(askjeeves\.com|ask\.com)', $this->referer))
      {
        // AskJeeves
        preg_match("#{$this->sep}q=(.*?)\&#si", $this->referer, $this->keys);
        $this->search_engine = 'AskJeeves';
      }
      else
      {
        $this->keys = '';
        $this->search_engine = '';
      }

      if($this->keys != "" && is_array($this->keys))
      {
        $keys = implode(" ", $this->keys);
        $this->keys = null;
        $this->keys = $keys;
      }

    }
    	
  }


}
?>