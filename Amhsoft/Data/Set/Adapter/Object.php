<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Object.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Data_Set_Adapter_Object extends ArrayIterator implements Amhsoft_Data_Set_Interface {

    protected $object;
    
    public function __construct($object) {
        $this->object = $object;
        $array = get_object_vars($object);
        parent::__construct(array($array));
        
    }

    public function GetInt($field) {
        return intval($this[$field]);
    }
    

            /**
     * get string value presentation of current element in list
     * @param mixed $field key/field of element
     * @return string string value presentation of current element in list
     */
    public function GetString($field) {
        $current = $this->current();
        return (string) $current[$field];
    }

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     */
    public function GetFloat($field) {
        $current = $this->current();
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
        
        //$current = $this->current();
        //return @$current[$index];
        return $this->object->$index;
    }

    public function offsetExists($index) {
        //return isset($this->object->$index);
        return true;
        //$current = $this->current();
        //return isset($current[$index]);
    }
    
    

}

?>
