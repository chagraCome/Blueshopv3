<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Array.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Data_Set_Adapter_Array extends ArrayIterator implements Amhsoft_Data_Set_Interface, Countable {

    protected $data;
    protected $count = 0;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->rewind();
    }

    public function GetInt($field) {
        $current = $this->current();
        if (is_object($current)) {
            return (int) $current->$field;
        }
        return intval($current[$field]);
    }

    /**
     * get string value presentation of current element in list
     * @param mixed $field key/field of element
     * @return string string value presentation of current element in list
     */
    public function GetString($field) {
        $current = $this->current();
        if (is_object($current)) {
            return $current->$field;
        }
        return (string) $current[$field];
    }

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     */
    public function GetFloat($field) {
        $current = $this->current();
        if (is_object($current)) {
            return floatval($current->$field);
        }
        return floatval($current[$field]);
    }

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     * @see GetFloat()
     */
    public function GetDouble($field) {
        return $this->GetFloat($field);
    }
    

    /**
     * get boolean value presentation of current element in list
     * @param mixed $field key/field of element
     * @return boolean boolean value presentation of current element in list
     */
    public function GetBoolean($field) {
        $current = $this->current();
        return (bool) $current[$field];
    }

    public function offsetGet($index) {
        $current = $this->current();
        if (is_object($current)) {
            return ($current->$index);
        }
        return @$current[$index];
    }

    public function offsetExists($index) {
        $current = $this->current();
        if (is_object($current)) {
            return isset($current->$index);
        }
        return isset($current[$index]);
    }
    
    
    public function count() {
      return $this->current() ? parent::count() : 0;
    }
    

}

?>
