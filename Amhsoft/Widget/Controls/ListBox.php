<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ListBox.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * listbox component
 * @author Amir Cherif
 */
class Amhsoft_ListBox_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var integer visible size of listBox/selectBox */
  public $Size = 1;

  /** @var boolean True if multiple values are selectable */
  public $multiple = false;

  /** @var DataSorce $DataSource */
  public $DataSource;

  /** @var boolea True, if add an empty first element to listbox */
  public $WithNullOption = false;
  public $selectedItems = array();
  public $NullOptionLabel = null;

  /**
   * Contruct component.
   * @param string $name id-name of component
   * @param string $label label text of component
   */
  public function __construct($name, $label = null) {
    parent::__construct($name);
    $this->Label = $label;
    $this->Id = $name;
  }

  public function onChangeCallBack($jsCode) {
    Amhsoft_System_Web_Controller::$js_scripts[] = $jsCode;
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {

    if ($this->Required == false && $this->WithNullOption !== false) {
      $this->WithNullOption = true;
    }



    if ($this->DataBinding == null || $this->DataBinding->Text == null) {
      return $this->DrawSimple();
    }
    $ltr = ($this->LTR) ? ' dir="ltr"' : '';
    $disabled = ($this->Disabled == true) ? 'disabled="disabled"' : null;
    $width = null;
    if ($this->Width != null) {
      if (intval($this->Width) == $this->Width) {
        $this->Width = $this->Width . 'px';
      }
      $width .= ' style="width:' . $this->Width . '"';
    }
    $res = '<select  ' . $disabled . ' ' . $ltr . ' name="' . $this->Name . '" id="' . $this->Id . '" ' . $width . ' size="' . $this->Size . '"';
    if ($this->Class) {
      $res .= 'class="' . $this->Class . '"';
    }
    $res .= $this->multiple ? ' multiple="multiple" >' : '>';

    if ($this->DataSource instanceof Amhsoft_Data_Set) {
      $this->DataSource->rewind();

      if ($this->WithNullOption) {
        $res .= '<option value="">' . $this->NullOptionLabel . '</option>' . PHP_EOL;
      }
      for ($this->DataSource->rewind(); $this->DataSource->valid(); $this->DataSource->next()) {
 
        if ($this->Value == '') {
          $this->Value = $this->DataBinding->SelectedItem;
        }
        
        if (($this->DataSource[$this->DataBinding->Index] == $this->Value || $this->DataSource[$this->DataBinding->Text] == $this->Value || in_array($this->DataSource[$this->DataBinding->Index], (array) $this->selectedItems))) {

          $res .= '<option value="' . $this->DataSource[$this->DataBinding->Index] . '" selected="selected">' . htmlspecialchars($this->DataSource[$this->DataBinding->Text]) . '</option>' . PHP_EOL;
        } else {

          $res .= '<option value="' . $this->DataSource[$this->DataBinding->Index] . '">' . htmlspecialchars($this->DataSource[$this->DataBinding->Text]) . '</option>' . PHP_EOL;
        }
      }
    }
    $res .= '</select>';
    if ($this->ToolTip) {
      $res .= '&nbsp;<span class="toottip_msg">' . $this->ToolTip . '</span>';
    }

    return $res;
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  protected function DrawSimple() {
    $width = null;
    if ($this->Width != null) {
      if (intval($this->Width) == $this->Width) {
        $this->Width = $this->Width . 'px';
      }
      $width .= ' style="width:' . $this->Width . '"';
    }

    $res = '<select ' . $width . ' name="' . $this->Name . '" size="' . $this->Size . '"';

    $res .= $this->multiple ? ' multiple="multiple">' : '>';

    if ($this->DataSource instanceof Amhsoft_Data_Set) {
      $this->DataSource->rewind();

      if ($this->WithNullOption) {
        $res .= '<option value=""> </option>' . PHP_EOL;
      }

      //$dataSource = $this->DataSource->GetAsArray();
      foreach ($this->DataSource as $dataSource) {
        if ($dataSource == $this->Value) {
          $res .= '<option value="' . $dataSource . '" selected="selected">' . htmlspecialchars($dataSource) . '</option>';
        } else {
          $res .= '<option value="' . $dataSource . '">' . htmlspecialchars($dataSource) . '</option>';
        }
      }
    }

    $res .= '</select>';
    if ($this->ToolTip) {
      $res .= '&nbsp;' . $this->ToolTip;
    }

    return $res;
  }

}
