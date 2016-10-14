<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Config_Array_Adapter extends Amhsoft_Config_Abstract {

    protected $data = null;

    public function __construct(array $array) {
        $this->data = $array;
    }

    public function getConfiguration() {
        return $this->data;
    }

    public function getValue($key, $defaultValue = nul) {
        if ($this->hasKey($key)) {
            return $this->data[$key];
        } else {
            return $defaultValue;
        }
    }

    public function hasKey($key) {
        return isset($this->data[$key]);
    }

    public function getArrayValue($key) {
        return (array) $this->getValue($key);
    }

    public function getDoubleValue($key) {
        return (double) $this->getValue($key);
    }

    public function getIntValue($key) {
        return (int) $this->getValue($key);
    }

    public function getStringValue($key) {
        return (string) $this->getValue($key);
    }

}

?>
