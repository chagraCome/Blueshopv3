<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: CheckBox.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * checkbox component
 * @author Amir Cherif
 */
class Amhsoft_CheckBox_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var boolean True, if checkbox is checked, false otherwise */
  public $Checked = false;

  /**
   * Construct component checkbox
   * @param string $name id-name of component
   * @param string $label label text of component
   * @param string $value value of component (this is no databinding)
   */
  public function __construct($name, $label = null, $value = null) {
    parent::__construct($name, $value);
    $this->setValue($value);
    $this->Label = $label;
  }

  public function setValue($Value) {
    if (is_string($Value)) {
      if (strtolower($Value) == 'yes') {
        $Value = 1;
      }
      if (strtolower($Value) == 'نعم') {
        $Value = 1;
      }
    }
    parent::setValue($Value);
  }

  public function Validate() {
    if ($this->Required) {
      if ($this->Checked == false) {
        $validation_msg = _t('is required');
        $this->ToolTip = ($this->errorMessage) ? '&nbsp;<span class="toottip_msg">' . $this->errorMessage . '</span>' : null;
        return false;
      }
    }
    return true;
  }

  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Draw() {
    if ($this->Required) {
      $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
    }
    $html_class = ($this->Class != null) ? ' class="' . $this->Class . '"' : '';
    $html_checked = ($this->Checked == true) ? ' checked="checked"' : '';
    $html_value = ($this->Value) ? $this->Value : 1;
    $id_html = ($this->Id) ? ' id="' . $this->Id . '"' : '';
    $res = '<input type="checkbox" name="' . $this->Name . '" ' . $id_html . ' value="' . $html_value . '"' . $html_checked . $html_class . ' />';
    return $res;
  }

  /**
   * get True, if checkbox is checked, false otherwise
   * @return boolean True, if checkbox is checked, false otherwise
   */
  public function getChecked() {
    return $this->Checked;
  }

  /**
   * set True, if checkbox is checked, false otherwise
   * @param boolean $Checked True, if checkbox is checked, false otherwise
   */
  public function setChecked($Checked) {
    $this->Checked = $Checked;
  }

}
