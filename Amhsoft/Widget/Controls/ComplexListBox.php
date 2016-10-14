<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ComplexListBox.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * complex listbox component
 * @author Amir Cherif
 */
class Amhsoft_ComplexListBox_Control extends Amhsoft_ListBox_Control implements Amhsoft_Widget_Interface {

  public $NullValue;

  public function __construct($name, $label = null) {
      parent::__construct($name, $label);
  }
  
  
  
  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {
    //if ($this->DataBinding == null || $this->DataBinding->Text == null) {
    //  return $this->DrawSimple();
    //}

      $javascript = $this->JavaScript == null ? null : 'onChange="'.$this->JavaScript.'"';
      
    $res = '<select name="' . $this->Name . '"  id="' . $this->Id . '" size="' . $this->Size . '"' .$javascript;

    $res .= $this->multiple ? ' multiple="multiple">' : '>';

    if ($this->DataSource instanceof Amhsoft_Data_Set) {
   
      $this->DataSource->rewind();
      if ($this->WithNullOption) {
        $res .= '<option value="'.$this->NullValue.'"> </option>' . PHP_EOL;
      }
      foreach ($this->DataSource as $datasource) {
 
        if ($this->Value == '') {
          $this->Value = $this->DataBinding->SelectedItem;
        }
        if(!isset($datasource[$this->DataBinding->Text])){
            
          return null;
        }
         
        if (is_array($datasource[$this->DataBinding->Text])) {
          $res .= '<optgroup label="' . $datasource[$this->DataBinding->Index] . '">';
          foreach ($datasource[$this->DataBinding->Text] as $key => $val) {
            if ($key == $this->Value) {
              $res .= '<option value="' . $key . '" selected="selected">' . $val . '</option>' . PHP_EOL;
            } else {
              $res .= '<option value="' . $key . '">' . $val . '</option>' . PHP_EOL;
            }
          }
          $res .= '</optgroup>';
          continue;
        }

        if ($datasource[$this->DataBinding->Index] == $this->Value) {
          $res .= '<option value="' . $datasource[$this->DataBinding->Index] . '" selected="selected">' . $datasource[$this->DataBinding->Text] . '</option>' . PHP_EOL;
        } else {
          $res .= '<option value="' . $datasource[$this->DataBinding->Index] . '">' . $datasource[$this->DataBinding->Text] . '</option>' . PHP_EOL;
        }
      }
    }
    $res .= '</select>';
 
    return $res;
  }
  
  public function Render() {
      return parent::Render();
  }

}
