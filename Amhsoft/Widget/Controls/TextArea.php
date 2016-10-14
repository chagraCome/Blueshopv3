<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: TextArea.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * textarea component
 * @author Amir Cherif
 */
class Amhsoft_TextArea_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var integer columns of textarea */
  private $Cols = 60;

  /** @var integer rows/lines of textarea */
  private $Rows = 6;
	
  public $TextOnly = false;
  /**
   * Construct component
   * @param string $name id-name of component
   * @param string $label label text of component
   * @param string $value value of component (this is no databinding)
   */
  public function __construct($name, $label = null, $value = null) {
    parent::__construct($name, $value);
    $this->Label = $label;
  }

  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Draw() {
    //$this->Value = htmlspecialchars_decode($this->Value, ENT_QUOTES | ENT_NOQUOTES);
    //$this->Value = htmlentities($this->Value);

    $res = '<textarea name="' . $this->Name . '" id="' . $this->Id . '"';

    if ($this->Required) {
      $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
    }

    if ($this->Class) {
      $res .= ' class="' . $this->Class . '"';
    }

    if ($this->Cols != null) {
      $res .= ' cols="' . $this->Cols . '"';
    }

    if ($this->Disabled || $this->ReadOnly) {
      $res .= ' disabled="disabled" ';
    }

    if ($this->Width != null) {
      if (substr($this->Width, -1) != '%') {
        $this->Width = $this->Width . 'px';
      }
      $res .= ' style="width:' . $this->Width . '"';
    }

    if ($this->Rows != null) {
      $res .= ' rows="' . $this->Rows . '"';
    }

    $_value = $this->Value;
    if ($this->Value != null || $this->DefaultValue != null) {
      $_value = (($this->Value) ? $this->Value : $this->DefaultValue);
    }
    if ($this->TextOnly == true) {
      $res .= '>' . strip_tags($_value);
    } else {
      $res .= '>' . $_value;
    }
    $res .= '</textarea>';

    return $res;
  }

  /**
   * get columns of textarea
   * @return integer columns of textarea
   */
  public function getCols() {
    return $this->Cols;
  }

  /**
   * set columns of textarea
   * @param integer $Cols columns of textarea
   */
  public function setCols($Cols) {
    $this->Cols = $Cols;
  }

  /**
   * get rows/lines of textarea
   * @return integer rows/lines of textarea
   */
  public function getRows() {
    return $this->Rows;
  }

  /**
   * set rows/lines of textarea
   * @param integer $Rows rows/lines of textarea
   */
  public function setRows($Rows) {
    $this->Rows = $Rows;
  }

}
