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
class Amhsoft_Social_Blackberry_Input_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var string type attribute value of input (text, hidden ...) */
  protected $Type = 'text';

  /** @var integer size attribute value of input */
  protected $Size;

  /** @var integer maxlenght attribute value of input */
  protected $Maxlength;

  /** @var string class attribute value of input */
  public $Class = 'inp';

  /**
   * Create input with id-name, label, value, size and databinding
   * @param string $name id-name of component
   * @param string $label label text of component
   * @param mixed $value value of component
   * @param string $size size of input field
   * @param DataBinding $dataBinding dataBinding for this input
   */
  public function __construct($name, $label = null, $value = null, $size = null, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($name, $value);
    $this->Label = $label;
    $this->Size = $size;
    $this->Id = $this->Name;
    $this->DataBinding = $dataBinding;
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {

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
    if ($this->Value != null || $this->DefaultValue != null) {
      $res .= ' value="' . (($this->Value) ? $this->Value : $this->DefaultValue) . '"';
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

    if ($this->Width != null) {
      if (intval($this->Width) == $this->Width) {
        $this->Width = $this->Width . 'px';
      }
      $res .= ' style="width:' . $this->Width . '"';
    }

    if (!empty($this->JavaScript)) {
      $res .= ' onclick="' . $this->JavaScript . '"';
    }
    if (!empty($this->DockStyle)) {
      $res .= ' style="' . $this->DockStyle . '"';
    }
    $res .= ' />';
    if ($this->ToolTip) {
      $res .= '&nbsp;' . $this->ToolTip;
    }
    return $res;
  }

  /**
   * get type attribute value of input (text, hidden ...)
   * @return string type attribute value of input (text, hidden ...)
   */
  public function getType() {
    return $this->Type;
  }

  /**
   * set type attribute value of input (text, hidden ...)
   * @param string $Type type attribute value of input (text, hidden ...)
   */
  public function setType($Type) {
    $this->Type = $Type;
  }

  /**
   * get size attribute value of input
   * @return integer size attribute value of input
   */
  public function getSize() {
    return $this->Size;
  }

  /**
   * set size attribute value of input
   * @param integer $Size size attribute value of input
   */
  public function setSize($Size) {
    $this->Size = $Size;
  }

  /**
   * get maxlenght attribute value of input
   * @return integer maxlenght attribute value of input
   */
  public function getMaxlength() {
    return $this->Maxlength;
  }

  /**
   * set maxlenght attribute value of input
   * @param integer $Maxlength maxlenght attribute value of input
   */
  public function setMaxlength($Maxlength) {
    $this->Maxlength = $Maxlength;
  }

  /**
   * get class attribute value of input
   * @return string class attribute value of input
   */
  public function getClass() {
    return $this->Class;
  }

  /**
   * set class attribute value of input
   * @param string $Class class attribute value of input
   */
  public function setClass($Class) {
    $this->Class = $Class;
  }

}

?>
