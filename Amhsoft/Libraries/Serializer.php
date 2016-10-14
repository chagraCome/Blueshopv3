<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Serializer.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Serializer {

  function toArray($data) {
    $forbidden = array("_where", "_select", "_orderBy", "_groupBy", "join", "limit",
        "table", "_fields", "identifier", "object", "count", "_one2one",
        "_many2many", "_one2many", "_inheritance", "superClass", "observers");

    if (is_array($data) || is_object($data)) {
      $result = array();
      $data = is_object($data) ? get_object_vars($data) : $data;
      foreach ($data as $key => $value) {
        if (in_array($key, $forbidden) && $key != NULL) {
          unset($data[$key]);
        } else {
          $result[$key] = Amhsoft_Serializer::toArray($value);
        }
      }
      return $result;
    }
    return $data;
  }

  function toXml() {
    
  }

  function toYml() {
    
  }

  function object2array($obj) {
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
      $val = (is_array($val) || is_object($val)) ? Amhsoft_Serializer::object2array($val) : $val;
      $arr[$key] = $val;
    }
    return $arr;
  }

}
