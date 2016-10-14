<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Search_Document {

    private $id;
    private $_data = array();
    private $_indexed = array();

    public function __construct($id = null) {
        if ($id) {
            $this->id = $id;
        }
    }
    
    public function getId() {
        return intval($this->id);
    }
    
    public function setId($id) {
        $this->id = intval($id);
    }

    public function addDataField($fieldName, $fieldValue) {
        $this->_data[$fieldName] = $fieldValue;
    }

    public function addIndexedField($fieldName, $fieldValue) {
        $this->_indexed[$fieldName] = $fieldValue;
    }

    public function getIndexedFields() {
        return $this->_indexed;
    }

    public function getDataFields() {
        return $this->_data;
    }
    
    public function hasData(){
        return count($this->_data) > 0;
    }
    
    public function getIndexedFieldsAsJson(){
        return json_encode($this->_indexed);
    }
    
    public function getDataFieldsAsJson(){
        return json_encode($this->_data);
    }

}

?>
