<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Manager.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_RBAC_Rule_Manager {

    static $rules = array();

    public static function addRule(Amhsoft_RBAC_Rule $rule) {
        if ($rule->getGroup() == null) {
            self::$rules['top'][] = $rule;
        } else {
            self::$rules[$rule->getGroup()][] = $rule;
        }
    }

    public static function getByGroup($group) {
        return self::$rules[$group];
    }

    public static function getTops() {
        return self::$rules['top'];
    }

}

?>
