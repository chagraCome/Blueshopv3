<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Action_Collection extends Amhsoft_WorkFlow_Action_Abstract {

    private $_items = array();
    
    public function add(Amhsoft_WorkFlow_Action_Abstract $action){
        if(!$this->exists($action)){
            $this->_items[] = $action;
        }
    }
    
    public function exists(Amhsoft_WorkFlow_Action_Abstract $action){
        return in_array($action, $this->_items);
    }
    
    public function execute($params=null) {
        foreach($this->_items as $item){
            $item->execute($params);
        }
    }

}

?>
