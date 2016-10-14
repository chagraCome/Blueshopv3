<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. 
 */

class Amhsoft_WorkFlow_Condition_Collection extends Amhsoft_WorkFlow_Condition_Abstract {

    private $_items = array();

    public function add(Amhsoft_WorkFlow_Condition_Abstract $condition) {
        if (!$this->exists($condition)) {
            $this->_items[] = $condition;
        }
    }

    public function exists(Amhsoft_WorkFlow_Condition_Abstract $condition) {
        return in_array($condition, $this->_items);
    }

    public function valid($parms=null) {
        $result = true;
        foreach ($this->_items as $item) {
            $result &= $item->valid($parms);
        }
        return $result;
    }

}

?>
