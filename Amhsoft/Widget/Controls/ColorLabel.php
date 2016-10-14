<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ColorLabel.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_ColorLabel_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct('label');
    $this->Amhsoft_Label_Control = $label;
    $this->DataBinding = $dataBinding;
  }

  /**
   * Get output HTML / string represantation of Control.
   * @return string Output HTML / string represantation of Control.
   */
  public function Draw() {
    $color = ($this->Value) ? '#' . $this->Value : null;
    return '<span style="border-radius: 4px 4px 4px 4px; border: 1px solid gray; height: 20px; width: 40px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.6); cursor: pointer; background-color: ' . $color . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
  }

}

?>
