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
class Amhsoft_Config_Ini_Adapter extends Amhsoft_Config_Abstract {

    protected $data = null;

    public function __construct($filename) {
        Amhsoft_Log::info('try to load configuration from: ' . $filename);
        if (!is_file($filename)) {
            throw new Exception('File: ' . $filename . ' not exists');
        }

        $lines = file($filename);
        foreach ($lines as $line) {
            $line = trim($line);
            if (substr($line, 0, 1) == ';' || substr($line, 0, 1) == '#') {
                continue;
            }

            preg_match('/^(.*)\[(.*)\]\s*=\s*(.*)$/i', $line, $result);
            if (!empty($result)) {
                if ($result[2] == '') {
                    $this->data[$result[1]][] = $result[3];
                } else {
                    $this->data[$result[1]][$result[2]] = $result[3];
                }
                continue;
            }

            $row = explode('=', $line);
            if (count($row) > 1) {
                if (substr(trim($row[0]), -2) == '[]') {
                    $this->data[substr(trim($row[0]), 0, -2)][] = trim($row[1]);
                } else {
                    $this->data[trim($row[0])] = trim($row[1]);
                }
            }
        }
        
        Amhsoft_Log::info(count($this->data) . ' configuration loaded from: ' . $filename);
    }

    public function getConfiguration() {
        return $this->data;
    }

    public function getValue($key, $defaultValue = null) {
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