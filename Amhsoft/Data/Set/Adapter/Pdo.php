<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Pdo.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Data_Set_Adapter_Pdo implements Amhsoft_Data_Set_Interface, Iterator, ArrayAccess, Countable {
    /* @var PDOStatement iterator for fetched data */

    private $data = null;
    private $index = 0;
    private $currentRow;

    /**
     * construct Amhsoft_DataSet_Component
     * @param ArrayIterator|PDOStatement|array $data iterator for fetched data
     */
    public function __construct($data) {
  
        if ($data instanceof PDOStatement) {
            $this->data = $data;
            $this->currentRow = $this->data->fetch();
            $this->index = 0;
        } else {
            throw new Exception('data must be instance of PDOStatement');
        }
    }

    /**
     * rewind/reset iterator to position 0 and get first element
     * @return mixed first element or null if empty
     */
    public function Rewind() {
        //$this->data->execute();
        $this->index = 0;
    }

    /**
     * get value/object at current position
     * @return ArrayObject value/object at current position
     */
    public function Current() {
        return $this->currentRow;
    }

    /**
     * get key of value/object at current position
     * @return mixed key of value/object at current position
     */
    public function key() {
        return $this->index;
    }

    /**
     * get next element in list
     * @return mixed element in list
     */
    public function Next() {
        $this->currentRow = $this->data->fetch();
        ++$this->index;
    }

    /**
     * check if current element in list has valid key
     * @return boolean true if current element in list has valid key
     */
    public function valid() {
        //$this->index++;
        if ($this->data->rowCount() > $this->index) {
            return true;
        }
        return false;
    }

    /**
     * get length/count of Amhsoft_DataSet_Component
     * @return integer length/count of Amhsoft_DataSet_Component
     */
    public function Length() {
        return $this->data->rowCount();
    }

    /**
     * get integer value presentation of current element in list
     * @param mixed $field key/field of element
     * @return integer integer value presentation of current element in list
     */
    public function GetInt($field) {
        return intval($this->currentRow->$field);
    }

    /**
     * get string value presentation of current element in list
     * @param mixed $field key/field of element
     * @return string string value presentation of current element in list
     */
    public function GetString($field) {
        return (string) $this->currentRow->$field;
    }

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     */
    public function GetFloat($field) {
        return floatval($this->currentRow->$field);
    }

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     * @see GetFloat()
     */
    public function GetDouble($field) {
        return GetFloat($field);
    }

    /**
     * get boolean value presentation of current element in list
     * @param mixed $field key/field of element
     * @return boolean boolean value presentation of current element in list
     */
    public function GetBoolean($field) {
        return (bool) $this->currentRow->$field;
    }

   
    /**
     * get length/count of Amhsoft_DataSet_Component
     * @return integer length/count of Amhsoft_DataSet_Component
     * @see Length()
     */
    public function count() {
        return $this->Length();
    }

    /**
     * Check if offset exists of current element in list
     * @param string $offset offset index
     * @return boolean true if the offset exists, otherwise false
     */
    public function offsetExists($offset) {
        return $this->currentRow->$offset !== NULL;
    }

    /**
     * Get value for an offset index
     * @param string $offset offset index
     * @return mixed The value at offset index
     */
    public function offsetGet($offset) {
        if ($this->offsetExists($offset)) {
            return $this->currentRow->$offset;
        } else {
            return null;
        }
    }

    /**
     * Set value for an offset
     * @param string $offset offset index
     * @param mixed $value new value at offset
     * @return mixed value at offset
     */
    public function offsetSet($offset, $value) {
        $this->currentRow->$offset = $value;
    }

    /**
     * Unset value for an offset
     * @param string $offset offset index
     * @return mixed value at offset
     */
    public function offsetUnset($offset) {
        $this->currentRow->$offset = null;
    }

    
    

}
    
?>
