<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Label.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Unit_Hour_Label_Control extends Amhsoft_Unit_Label_Control {

  public $convertToMinute;

  function __construct($label, Amhsoft_Data_Binding $dataBinding = null, $convertToMinute = false) {

    parent::__construct($label, _t('Hour'), $dataBinding);
    $this->convertToMinute = $convertToMinute;
  }
  
  

  public function Render() {
    /*     * if ($this->convertToMinute == true && $this->Value <= 2) {

      $this->Value = 60 * $this->Value;
      $this->Unit = 'Minutes';
      } else {
      $this->Unit = 'Hours';
      }* */
    if ($this->convertToMinute) {
      $hours = (int) $this->Value;
      $minutes = ($this->Value - $hours) * 60;
      $hours_text = $hours > 0 ? $hours . ' Hours  ': '';
      $minute_text = $minutes? $minutes . ' Minutes' : '';
      if(!$hours_text && !$minute_text){
        $hours_text = 'Not Started';
      }
      return '<label>' .$hours_text.$minute_text. '</label>';
    }
    return '<label>' . $this->Value . ' ' . $this->Unit . ' </label>';
  }

}

?>
