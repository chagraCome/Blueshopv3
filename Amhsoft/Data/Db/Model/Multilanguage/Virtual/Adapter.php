<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @version: alpha (please not use it)
 */

abstract class Amhsoft_Data_Db_Model_Multilanguage_Virtual_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter{
    private $virutalCol = null;
    private $virtualValue = null;
    
    public function __construct($virtualValue) {
        $this->virtualValue = $virtualValue;
        $this->appendMap($this->virutalCol);
        parent::__construct();
    }
    
    public function setVirtualValue($value){
        $this->virtualValue = $value;
    }
    
    abstract function getVirtualCol();
    
    
    public function insert(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $object->virtualCol = $this->virtualValue;
        parent::insert($object, $cascade);
    }
    
    public function fetchById($id) {
        $this->where($this->virutalCol.'=?', $this->virtualValue, PDO::PARAM_STR);
        parent::fetchById($id);
    }
    
    public function fetch() {
        $this->where($this->virutalCol.'=?', $this->virtualValue, PDO::PARAM_STR);
        parent::fetch();
    }
    
    public function update(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $object->virtualCol = $this->virtualValue;
        parent::update($object, $cascade);
    }
    
    
    
    
    
    
    
}
?>
