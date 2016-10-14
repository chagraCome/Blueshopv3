<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Config_Xml_Adapter extends Amhsoft_Config_Abstract {

    protected $data = null;

    public function __construct($filename) {
        $this->data = simplexml_load_file($filename);
    }

    public function getConfiguration() {
        return $this->data;
    }

    public function getValue($key, $defaultValue = null) {
        if ($this->hasKey($key)) {
            return $this->data->$key;
        } else {
            return $defaultValue;
        }
    }

    public function hasKey($key) {
        return isset($this->data->$key);
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
