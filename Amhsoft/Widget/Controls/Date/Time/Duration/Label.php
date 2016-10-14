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
class Amhsoft_Date_Time_Duration_Label_Control extends Amhsoft_Label_Control implements Amhsoft_Widget_Interface {

  public $CriticalValue = 0;
  protected $MediumValue = 0;
  protected $OkValue = 0;

  public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($label, $dataBinding);
    $this->DataBinding = $dataBinding;
  }

  /**
   * Get output HTML / string represantation of Control.
   * @return string Output HTML / string represantation of Control.
   */
  public function Draw() {


    $nowUct = Amhsoft_Locale::UCTDateTime();
    $lastChangeTime= $this->Value ? $this->Value : $this->DefaultValue;
    
    $diff = strtotime($nowUct) - strtotime($lastChangeTime);
    $time = $diff;
        
   
    $year = floor($time / (60 * 60 * 24 * 365));
    $time -= $year * (60 * 60 * 24 * 365);

    $months = floor($time / (60 * 60 * 24 * 30));
    $time -= $months * (60 * 60 * 24 * 30);

    $weeks = floor($time / (60 * 60 * 24 * 7));
    $time -= $weeks * (60 * 60 * 24 * 7 );

    $days = floor($time / (60 * 60 * 24));
    $time -= $days * (60 * 60 * 24);

    $hours = floor($time / (60 * 60));
    $time -= $hours * (60 * 60);

    $minutes = floor($time / 60);
    $time -= $minutes * 60;

    $seconds = floor($time);
    $time -= $seconds;

    
    $year_string = ($year > 0) ? "  {$year}Y" : '';
    $month_string = ($months > 0) ? "  {$months}M" : '';
    $weeks_string = ($weeks > 0) ? "  {$weeks}W" : '';
    $day_string = ($days > 0) ? "  {$days}d" : '';
    $hour_string = ($hours > 0) ? "  {$hours}h" : '';
    $minute_string = ($minutes > 0) ? "  {$minutes}m" : '';
    $sec_string = ($seconds > 0) ? "  {$seconds}s" : '';
    
    $color = null;
    if ($this->CriticalValue > 0 && $diff > $this->CriticalValue) {
      $color = 'red';
    }

    $color_string = $color ? "style='color: $color'" : null;

    return '<label ' . $color_string . '>' . $year_string . $month_string . $weeks_string . $day_string .$hour_string. $minute_string . $sec_string . $null_string . '</label>';
  }

}

?>