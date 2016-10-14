<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Amhsoft_WorkFlow_Condition_Operation_Date implements Amhsoft_WorkFlow_Condition_Operation_Interface{

    public static function between($leftValue, $rightValue, $sep=',') {
        $rights = explode($sep, $rightValue);
        $left = strtotime($leftValue);
        $right1 = strtotime($rights[0]);
        $right2 = strtotime($rights[2]);
        return $left >= $right2 && $left <= $right1;
    }

    public static function contains($stringValue, $value) {
        return false;
    }

    public static function endWith($stringValue, $value) {
        return false;
    }


    public static function equals($leftValue, $rightValue) {
        $left = strtotime($leftValue);
        $right = strtotime($rightValue);
        return $left == $right;
    }

    public static function greaterThan($leftValue, $rightValue) {
        $left = strtotime($leftValue);
        $right = strtotime($rightValue);
        return $left > $right;
    }

    public static function in($value, $values, $sep) {
        return false;
    }

    public static function lessThan($leftValue, $rightValue) {
        $left = strtotime($leftValue);
        $right = strtotime($rightValue);
        return $left < $right;
    }

    public static function notEquals($leftValue, $rightValue) {
        $left = strtotime($leftValue);
        $right = strtotime($rightValue);
        return $left != $right;
    }

    public static function startWith($stringValue, $value) {
        return false;
    }

}
?>
