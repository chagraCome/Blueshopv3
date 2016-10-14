<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Widget_Filter_Component_Value {

    public $id;
    public $text;

    public function __construct($id, $text) {
        $this->id = $id;
        $this->text = $text;
    }

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }


}

?>
