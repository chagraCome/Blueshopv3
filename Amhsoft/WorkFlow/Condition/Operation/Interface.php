<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Interface.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
interface Amhsoft_WorkFlow_Condition_Operation_Interface {

  public static function equals($leftValue, $rightValue);

  public static function notEquals($leftValue, $rightValue);

  public static function greaterThan($leftValue, $rightValue);

  public static function lessThan($leftValue, $rightValue);

  public static function between($leftValue, $rightValue , $sep);

  public static function in($value, $values, $sep);

  public static function startWith($stringValue, $value);

  public static function endWith($stringValue, $value);

  public static function contains($stringValue, $value);
}

?>
