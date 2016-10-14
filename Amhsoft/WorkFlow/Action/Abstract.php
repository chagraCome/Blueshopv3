<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Amhsoft_WorkFlow_Action_Abstract {

    private $state;

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    abstract function execute($parms=null);
}

?>
