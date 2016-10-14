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
class Amhsoft_Bootstrap_CheckBox_Control extends Amhsoft_CheckBox_Control {

  /** @var boolean True, if checkbox is checked, false otherwise */
  public $Checked = false;
 public $Class = 'checkbox';
 
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


}
