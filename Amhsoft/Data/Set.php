<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Set.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Data_Set implements Amhsoft_Data_Set_Interface, Countable, Iterator, ArrayAccess {

    /** @var Amhsoft_Data_Set_Adapter_Array $adapter * */
    protected $adapter;

    public function __construct($object) {
        
        if ($object instanceof Amhsoft_Data_Set_Interface) {
            $this->adapter = $object;
            return;
        }

        if (is_array($object)) {
            if (isset($object[0])) {
                $this->adapter = new Amhsoft_Data_Set_Adapter_Array($object);
               
            } else {
                $this->adapter = new Amhsoft_Data_Set_Adapter_Array(array($object));
            }
            return;
        }

        if ($object instanceof Amhsoft_Data_Db_Model_Adapter) {
            $this->adapter = new Amhsoft_Data_Set_Adapter_Pdo($object->fetch());
            return;
        }
        
        if ($object instanceof PDOStatement) {
            $this->adapter = new Amhsoft_Data_Set_Adapter_Pdo($object);
            return;
        }
        
        if(is_object($object)){
            $this->adapter = new Amhsoft_Data_Set_Adapter_Object($object);
            return;
        }


        throw new Exception('invalid data');
    }

    public function GetBoolean($field) {
        return $this->adapter->GetBoolean($field);
    }

    public function GetDouble($field) {
        return $this->adapter->GetDouble($field);
    }

    public function GetFloat($field) {
        return $this->adapter->GetFloat($field);
    }

    public function GetInt($field) {
        return $this->adapter->GetInt($field);
    }

    public function GetString($field) {
        return $this->adapter->GetString($field);
    }

    public function count() {
        return $this->adapter->count();
    }

    public function current() {
        return $this->adapter->current();
    }

    public function key() {
        return $this->adapter->key();
    }

    public function next() {
        return $this->adapter->next();
    }

    public function offsetExists($offset) {
        return $this->adapter->offsetExists($offset);
    }

    public function offsetGet($offset) {
        return $this->adapter->offsetGet($offset);
    }

    public function offsetSet($offset, $value) {
        return $this->adapter->offsetSet($offset, $value);
    }

    public function offsetUnset($offset) {
        return $this->adapter->offsetUnset($offset);
    }

    public function rewind() {
        return $this->adapter->rewind();
    }

    public function valid() {
        return $this->adapter->valid();
    }

}

?>
