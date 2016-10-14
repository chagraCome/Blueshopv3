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
class Amhsoft_Config_Database_Adapter extends Amhsoft_Config_Abstract {

    protected $data = null;
    protected $configkeyCol;
    protected $configvalueCol;
    protected $table;

    public function __construct($table, $config_key = 'config_key', $config_value = 'value') {
        $dbConnection = Amhsoft_Database::getInstance()->query("SELECT `$config_key`, `$config_value` FROM $table");
        $this->data = $dbConnection->fetchAll(PDO::FETCH_KEY_PAIR);
        $this->configkeyCol = $config_key;
        $this->configvalueCol = $config_value;
        $this->table = $table;
    }

    public function getConfiguration() {
        return $this->data;
    }

    public function getValue($key, $defaultValue = null) {
        return $this->data[$key];
    }

    public function setValue($key, $value) {
        if (isset($this->data[$key])) {
            $sql = "UPDATE $this->table SET $this->configvalueCol = '$value' WHERE $this->configkeyCol = '$key'";
        } else {
            $sql = "INSERT INTO $this->table VALUES (NULL, '$key', '$value', '')";
        }
        try {
            Amhsoft_Database::getInstance()->exec($sql);
            $this->data[$key] = $value;
        } catch (Exception $e) {
            Amhsoft_Log::error('config key cannot be saved '.$key. ' '.$value.' whhile '.$e->getMessage());
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
