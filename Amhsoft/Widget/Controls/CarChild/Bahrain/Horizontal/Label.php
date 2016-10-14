<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_CarChild_Bahrain_Horizontal_Label_Control extends Amhsoft_Label_Control{
    public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
        parent::__construct($label, $dataBinding);
    }
    
    public function Render() {
        $str = '<label ' . $class . '><div style="background-image:url(\'Motorssouq/child/bahrain-car-child.png\'); width:295px; height: 64px; ">
            <div style="font: bold 34px Verdana;padding:10px 40px 10px 20px; position: relative;text-align:center; width:150px;">'.$this->Value.'</div>
        </div></label>';
        return $str;
    }
}
?>
