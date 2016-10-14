<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Abstract.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_System_Rooting_Abstract {

  abstract function getRoot();

  public static function parseRoot($input) {
    if (is_array($input)) {
      if (!isset($input['page'])) {
        throw new Exception('Unkown array');
      }

      return self::parseArray($input);
    }

    if (is_string($input)) {
      if (preg_match("/\./", $input)) {
        return self::parseChannel($input);
      }
    }
  }

  private static function parseChannel($input) {
    $input = explode('.', $input);
    $array['module'] = array_shift($input);
    $array['level'] = array_shift($input);
    $array['page'] = implode('-', $input);
    return self::parseArray($array);
  }

  private static function parseArray($input) {
    $page = $input['page'];
    $page_string = self::parsePage($page);
    $module = (isset($input['module'])) ? $input['module'] : null;
    if ($module) {
      return ucfirst(strtolower($module)) . '_' . ucfirst($input['level']) . '_' . $page_string . '_Controller';
    } else {
      return 'Default_' . Amhsoft_System::getLevel() . '_' . $page_string . '_Controller';
    }
  }

  private static function parsePage($page) {
    $page_array = explode('-', $page);
    for ($i = 0; $i < count($page_array); $i++) {
      $page_array[$i] = ucfirst(strtolower($page_array[$i]));
    }
    $page_string = implode('_', $page_array);
    return $page_string;
  }

}

?>
