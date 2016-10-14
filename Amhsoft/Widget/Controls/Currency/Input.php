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
class Amhsoft_Currency_Input_Control extends Amhsoft_Input_Control {

  public function __construct($name, $label = null, $value = null, $size = null, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($name, $label, $value, $size, $dataBinding);
  }

  public function Validate() {
    $e = (doubleval($this->Value) != 0);

    $result = $this->onValidate->dispatchEvent($this);

    if ($result !== NULL) {
      $e = $result;
    }

    if (!$e) {
      if ($this->Class) {
        $this->Class .= ' invalid error';
      } else {
        $this->Class = 'invalid error';
      }
    }
    return $e;
  }

  public function Draw() {

    $c_value = strval(floatval($this->Value));
    if (!strcmp($c_value, $this->Value)) {
      $this->Value = str_replace(Amhsoft_Locale::getThousandSep(), '', $this->Value);
      $this->Value = str_replace(Amhsoft_Locale::getDecimalSep(), '.', $this->Value);
    }

    $this->Value = $this->Value * Amhsoft_Locale::getRate();



    if ($this->Required) {
      $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
    }


    $res = '<input name="' . $this->Name . '" id="' . $this->Id . '"';

    if ($this->Type != null) {
      $res .= ' type="' . $this->Type . '"';
    }
    if ($this->Size != null) {
      $res .= ' size="' . $this->Size . '"';
    }
    if ($this->Maxlength != null) {
      $res .= ' maxlength="' . $this->Maxlength . '"';
    }
    if ($this->Value != null) {

      $res .= ' value="' . number_format($this->Value, Amhsoft_Locale::getDoubleComma(), Amhsoft_Locale::getDecimalSep(), Amhsoft_Locale::getThousandSep()) . '"';
    }
    if ($this->Class != null) {
      $res .= ' class="' . $this->Class . '"';
    }
    if ($this->LTR == true) {
      $res .= ' dir="ltr"';
    }
    if ($this->Disabled == true) {
      $res .= ' disabled="disabled" ';
    }
    if (!empty($this->JavaScript)) {
      $res .= ' onclick="' . $this->JavaScript . '"';
    }
    $res .= ' />&nbsp;' . Amhsoft_Locale::getCurrencySymbol();
    if ($this->ToolTip) {
      $res .= '&nbsp;' . $this->ToolTip;
    }
    return $res . PHP_EOL;
  }

}

?>
