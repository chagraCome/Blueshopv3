<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Input.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * input component
 * @author Amir Cherif
 */
class Amhsoft_Bootstrap_Input_Control extends Amhsoft_Input_Control {

  /** @var string class attribute value of input */
  public $Class = 'form-control';

  public function Draw() {
    $this->Value = htmlspecialchars($this->Value, ENT_QUOTES | ENT_NOQUOTES, 'UTF-8');

    if ($this->Required) {
      $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
    }
    $css = '<link href="Amhsoft/Widget/Controls/Bootstrap/Ressources/Css/bootstrap.min.css" rel="stylesheet" type="text/css"/>';
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
      $res .= ' value="' . (($this->getValue()) ? $this->getValue() : $this->DefaultValue) . '"';
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
      if (!preg_match("/(%|px)$/i", $this->Width)) {
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
      $res .= '&nbsp;<span class="toottip_msg">' . $this->ToolTip.'</span>';
    }
    //var_dump($res.$css); exit();
    return $res . $css;
    
  }
}