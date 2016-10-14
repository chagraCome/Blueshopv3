<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnitLabel
 *
 * @author meriem
 */
class Amhsoft_Unit_Label_Control extends Amhsoft_Label_Control implements Amhsoft_Widget_Interface {

  public $Unit;

  public function __construct($label, $unit, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct('label');
    $this->Label = $label;
    $this->Unit = $unit;
    $this->DataBinding = $dataBinding;
  }

  /**
   * Get output HTML / string represantation of Control.
   * @return string output HTML / string represantation of Control.
   */
  public function Render() {
    return '<label>' . @number_format($this->Value, Amhsoft_Locale::getDoubleComma(), Amhsoft_Locale::getDecimalSep(), Amhsoft_Locale::getThousandSep()) . ' ' . $this->Unit . ' </label>';
  }

}

?>