<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Request.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Web_Request {

  public function Amhsoft_Web_Request() {
    $query = GETENV("REQUEST_URI");

    $qa = parse_url($query);

    if (!isset($qa["query"]))
      return;

    $str = $qa["query"];

    global $_GET;
    $pairs = explode('&', $str);
    foreach ($pairs as $pair) {
      $new = explode('=', $pair, 2);
      if (isset($new[1]))
        $_GET[$new[0]] = $new[1];
    }
  }

  public static function getCurrentPage() {
    return self::getInt('p');
  }

  public static function getInt($param) {
    if (isset($_POST[$param])) {
      return intval($_POST[$param]);
    }
    if (isset($_GET[$param])) {
      return intval($_GET[$param]);
    }

    return 0;
  }

  public static function isGet($param) {
    return (isset($_GET[$param])) ? true : false;
  }

  public static function isPost($param) {
    return (isset($_POST[$param])) ? true : false;
  }

  public static function post($param) {
    if (self::isPost($param)) {
      return htmlspecialchars($_POST[$param], ENT_QUOTES | ENT_NOQUOTES, "UTF-8");
    }
    return false;
  }

  public static function clearPosts() {
    $_POST = array();
  }

  public static function clearGets() {
    $_GET = array();
  }

  public static function postInt($param) {
    if (self::isPost($param)) {
      return intval($_POST[$param]);
    }
    return 0;
  }

  function file($param = 'file') {
    if (isset($_FILES[$param]))
      return $_FILES[$param];
    else
      return false;
  }

  function postFloat($param) {
    if (self::isPost($param)) {
      $e = str_replace(array(".", ","), array("", "."), $_POST[$param]);
      return floatval($e);
    }
    return 0;
  }

  public static function setGet($var, $value) {
    $_GET[$var] = $value;
  }

  public static function setPosts($value) {
    foreach ($value as $key => $val) {
      $_POST[$key] = $val;
    }

    //$_POST['captch_verification'] =  @$_SESSION['code_cap'];
  }

  public static function setPost($key, $value) {
    $_POST[$key] = $value;
  }

  function postFloats($param) {

    if (!isset($_POST[$param]))
      return array();


    if (!is_array($_POST[$param]))
      return array();

    $ret = array();

    foreach ($_POST[$param] as $key => $val) {
      $ret[$param][$key] = floatval(str_replace(array(".", ","), array("", "."), $val));
    }

    return $ret[$param];
  }

  function postDate($param) {
    if (self::isPost($param)) {
      $e = SetShortDate($_POST[$param]);
      return $e;
    }
    return "";
  }

  public static function get($param) {

    if (isset($_GET[$param])) {
      if (!is_array($_GET[$param])) {
        return @htmlspecialchars(@urldecode($_GET[$param]), ENT_QUOTES, "UTF-8");
      }
    }
    return null;
  }

  function getInts($param) {
    if (!isset($_GET[$param]))
      return array();

    if (!is_array($_GET[$param]))
      return array();


    $ret = array();

    foreach ($_GET[$param] as $key => $val) {
      $ret[$param][$key] = intval($val);
    }

    return $ret[$param];
  }

  public static function gets($param) {
    if (isset($_GET[$param])) {
      if (!is_array($_GET[$param])) {
        return array(@htmlspecialchars(@urldecode($_GET[$param]), ENT_QUOTES, "UTF-8"));
      }else{
        $data = array();
        foreach($_GET[$param] as $key => $val){
          $data[$key] = @htmlspecialchars(@urldecode($val), ENT_QUOTES, "UTF-8");
        }
        return $data;
      }
    }
    return array();
  }

  function postInts($param) {
    if (!isset($_POST[$param]))
      return array();

    if (!is_array($_POST[$param]))
      return array();


    $ret = array();

    foreach ($_POST[$param] as $key => $val) {
      $ret[$param][$key] = intval($val);
    }

    return $ret[$param];
  }

  function posts($param) {
    if (!isset($_POST[$param]))
      return array();

    if (!is_array($_POST[$param]))
      return array();

    return self::cleanup($_POST[$param], true);

//    foreach ($_POST[$param] as $key => $val) {
//      if (!is_array($val)) {
//        $data[$param][$key] = htmlspecialchars($val, ENT_QUOTES, "UTF-8");
//      } elseif (is_array($val)) {
//        foreach ($val as $k => $v) {
//          $data[$param][$k] = htmlspecialchars($v, ENT_QUOTES, "UTF-8");
//        }
//      }
//    }
//
//    return $data[$param];
  }

  private static function cleanup($array, $topLevel = true) {
    $newArray = array();
    foreach ($array as $key => $value) {
      if (!$topLevel) {
        $newKey = $key;
        if ($newKey !== $key) {
          unset($array[$key]);
        }
        $key = $newKey;
      }
      $newArray[$key] = is_array($value) ? self::cleanup($value, false) : htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    }
    return $newArray;
  }

  function getFloat($param) {
    
  }

  function getFloats($param) {
    
  }

  function getFile($param) {
    
  }

  function getFiles($param) {
    
  }

  public static function getId() {
    if (isset($_POST["id"])) {
      $id = intval($_POST["id"]);
      return $id;
    }
    if (isset($_GET["id"])) {
      $id = intval($_GET["id"]);
      return $id;
    }

    return 0;
  }

  /**
   * Bind an IObjectModel with Amhsoft_Request values.
   * @param IObjectModel $model
   * @return IObjectModel $model
   */
  public static function bindPost($model, $prefix = null) {
    $ref = new ReflectionObject($model);
    $attrs = get_object_vars($model);

    foreach ($_POST as $key => $val) {
      if (array_key_exists(str_replace($prefix, '', $key), $attrs)) {
        if ($prefix) {
          $key = str_replace($prefix, '', $key);
        }
        $model->{$key} = $val;
      }
    }
  }

  /**
   * Bind an IObjectModel with Amhsoft_Request values.
   * @param IObjectModel $model
   * @return IObjectModel $model
   */
  public static function bindJsonString($model, $json_data) {

    $attrs = get_object_vars($model);

    foreach ($json_data as $key => $val) {
      if (array_key_exists($key, $attrs)) {
        $model->{$key} = $val;
      }
    }
  }

}

?>
