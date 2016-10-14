<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Input.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Controls
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Email_Input_Control extends Amhsoft_Input_Control{
  public function __construct($name, $label = null, $value = null, $size = null, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($name, $label, $value, $size, $dataBinding);
    $this->Type = 'email';
    $this->addValidator('Email');
  }
}
