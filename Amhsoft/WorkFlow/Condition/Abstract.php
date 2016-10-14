<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Amhsoft_WorkFlow_Condition_Abstract {

    private $name;
    private $state;
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

        
    
    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    abstract function valid($params=null);
}

?>
