<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Condition_Operation_Number implements Amhsoft_WorkFlow_Condition_Operation_Interface {

  public static function lessThan($leftValue, $rightValue) {
    return $leftValue < $rightValue;
  }

  public static function notEquals($leftValue, $rightValue) {
    return $leftValue != $rightValue;
  }

  public static function equals($leftValue, $rightValue) {
    $_rightvalues = explode(' ::OR::  ', $rightValue);
        foreach($_rightvalues as $rValue){
            if ($leftValue == $rValue){
                return true;
            }
        }
        return false;
  }

  public static function in($value, $values, $sep) {
    $values = explode($sep, $values);
    return in_array($value, (array) $values);
  }

  public static function greaterThan($leftValue, $rightValue) {
    return $leftValue > $rightValue;
  }

  public static function between($leftValue, $rightValue, $sep) {
    return $leftValue > $rightValue && $leftValue < $sep;
  }

  public static function contains($stringValue, $value) {
    return false;
  }

  public static function endWith($stringValue, $value) {
    return false;
  }

  public static function startWith($stringValue, $value) {
    $val = (string) $stringValue;
    return (bool) preg_match("/^$value/i", $val);
  }


}

?>
