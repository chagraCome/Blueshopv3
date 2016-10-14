<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Unique.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of UrlValidator
 *
 * @author cherif
 */
class Amhsoft_Unique_Validator extends Amhsoft_Abstract_Validator {

    protected $_value;
    protected $_table;
    protected $_column;
    protected $_expect;
    protected $msg;

    public function __construct($table, $column, $expect = null) {
        $this->_table = $table;
        $this->_column = $column;
        $this->_expect = $expect;
    }

    public function setValue($value) {
        $this->_value = $value;
    }

    public function getErrorMessage() {
        return $this->msg ? $this->msg : _t(' "' . htmlentities($this->_value) . '"' . _t('exists'));
    }

    public function setErrorMessage($msg) {
        $this->msg = $msg;
    }

    public function isValid() {

        if (!is_string($this->_value)) {
            return false;
        }
        if ($this->_expect == null) {
            $stmt = Amhsoft_Database::getInstance()->prepare("SELECT `$this->_column` FROM `$this->_table` WHERE `$this->_column` = '$this->_value'");
        } else {
            $stmt = Amhsoft_Database::getInstance()->prepare("SELECT `$this->_column` FROM `$this->_table` WHERE `$this->_column` = '$this->_value' AND `$this->_column` <> '$this->_expect'");
        }
        try {
            $stmt->execute();
            return (bool) $stmt->rowCount() == 0;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
