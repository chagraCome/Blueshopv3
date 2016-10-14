<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Condition_Operation_String  {

  public static function equals($leftValue, $rightValue) {
    $_rightvalues = explode(' ::OR:: ', $rightValue);

    foreach ($_rightvalues as $rValue) {
      if (strtolower($rValue) == 'null') {
         $rValue = null;
      }
      if ($leftValue == $rValue) {
        return true;
      }
    }
    return false;
  }

  public static function notEquals($leftValue, $rightValue) {
    if (strtolower($rightValue) == 'null') {
      $rightValue = null;
    }
    return $leftValue != $rightValue;
  }

  public static function startWith($stringValue, $value) {
    return (bool) preg_match("/^$value/i", $stringValue);
  }

  public static function endWith($stringValue, $value) {
    return (bool) preg_match("/$value$/i", $stringValue);
  }

  public static function contains($stringValue, $value) {
    return (bool) preg_match("/$value/i", $stringValue);
  }

  public static function greaterThan($leftValue, $rightValue) {
    return strlen($leftValue) > strlen($rightValue);
  }

  public static function lessThan($leftValue, $rightValue) {
    return !self::greatherThan($leftValue, $rightValue);
  }

  public static function in($leftValue, $rightValue, $sep = ',') {
    $values = explode($sep, $rightValue);
    return in_array($leftValue, (array) $values);
  }

  public static function between($leftValue, $rightValue, $sep = ',') {
    return false;
  }

}

?>
