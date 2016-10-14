<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_Widget_Filter_Component extends Amhsoft_Widget_Filter_Abstract_Component{
    public $name;
    public $label;
    public $possibleValues = array();
    public $render;
    
    public function __construct($name, $label) {
        $this->name = $name;
        $this->label = $label;
    }
    
    public function addValue(Amhsoft_Widget_Filter_Component_Value $value){
        $this->possibleValues[] = $value;
    }
    
    public function getValues(){
        return $this->possibleValues;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getLabel(){
        return $this->label;
    }
    
    public function Render(){
        return '';
    }
}
?>
