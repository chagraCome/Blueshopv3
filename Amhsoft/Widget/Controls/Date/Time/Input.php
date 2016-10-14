<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Input.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Date_Time_Input_Control extends Amhsoft_Input_Control {

  /**
   * Construct input as Amhsoft_DateControl_Control
   * @param string $name id-name of input
   * @param string $label label text of input
   * @param string $value value text of input
   */
  public function __construct($name, $label = null, $value = null) {
    parent::__construct($name, $label, $value);
    $this->Class = 'inp datetimepicker';
    $this->Type = 'text';
    $this->setSize(10);
    $this->setMaxlength(10);
    
    if ($this->Value == '0000-00-00 00:00:00' || $this->Value == null) {
      $this->Value = null;
    }else{
      //$this->Value = Amhsoft_Locale::DateTime($this->Value, 'Y-m-d H:i:s');
    }
  }
  
  
  public function getValue() {
    if ($this->Value == '0000-00-00 00:00:00' || $this->Value == null) {
     return $this->Value = null;
    }else{
     return Amhsoft_Locale::DateTime($this->Value, 'Y-m-d H:i:s');
    }
  }
  
//  public function Render() {
//    if($this->Value){
//      $this->Value = Amhsoft_Locale::DateTime($this->Value);
//    }
//    return parent::Render();
//  }

}

?>
