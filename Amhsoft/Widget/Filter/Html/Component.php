<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Amhsoft_widget_Filter_Html_Component extends Amhsoft_Widget_Filter_Abstract_Component{
    protected $htmlValue;
    public function __construct($htmlValue) {
        $this->htmlValue = $htmlValue;
    }
    
    public function Render(){
        return $this->htmlValue;
    }
}
?>
