<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Truncate.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Filter
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Widget_Filter_Truncate implements Amhsoft_Widget_Filter_Interface {

  protected $start;
  protected $length;
  
  public function __construct($start=0, $length=100) {
    $this->start = $start;
    $this->length = $length;
  }
  
  public function apply($value) {
    if(mb_strlen($value) < $this->length){
      return $value;
    }
    return substr($value, $this->start, $this->length) . ' ...';
  }

}
