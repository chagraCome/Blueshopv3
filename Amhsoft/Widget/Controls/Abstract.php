<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Abstract.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * abstract control component
 * @author Amir Cherif
 */
abstract class Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var string the name of the Control */
  public $Name;

  /** @var string ID of the Control */
  public $Id;

  /** @var mixed Default value of the Control */
  public $DefaultValue;

  /** @var string Value of the Control */
  public $Value;

  /** @var string Label text of the Control */
  public $Label;

  /** @var string Width attribute value */
  public $Width;

  /** @var boolean True if the Control ReadOnly, false otherweise */
  public $ReadOnly = false;

  /** @var DataBinding Databinding of the Control */
  public $DataBinding;

  /** @var string style attribute value */
  public $DockStyle;

  /** @var boolean True, if you want to check/validate values, false otherwise */
  public $Required = false;
  public $Format;

  /** @var string class attribute value */
  public $Class;

  /** @var string javascript attribute value */
  public $JavaScript;
  public $Parent;

  /** @var boolean True if direction is left to right, false otherwise (rtl) */
  public $LTR;

  /** @var string tooltip */
  public $ToolTip;
  /*   * @var string validate event call */
  public $onValidate;

  /** @var boolean status */
  public $Disabled;

  /** @var string error message */
  public $errorMessage;
  public $validators = array();
  public $Identification;
  public $Tag;
  protected $filters = array();

  /**
   * Construct Control
   * @param string $name id-name of component
   * @param string $value value of component
   */
  public function __construct($name, $value = null) {
    $this->Name = (string) $name;
    $this->Value = $value;
    $this->Id = $name;
    $this->Value = ($value == null) ?
            (isset($_POST[$this->Name]) ? $_POST[$this->Name] : null) : $value;

    if (isset($_FILES['trigger_' . $this->Name])) {
      $this->Value = isset($_FILES['trigger_' . $this->Name]) ? $_FILES['trigger_' . $this->Name] : NULL;
    }
    $this->onValidate = new Amhsoft_Widget_Event();
  }

  public function getTagName() {
    return $this->Name;
  }

  public function getIdentification() {
    return $this->Identification;
  }

  public function setIdentification($Identification) {
    $this->Identification = $Identification;
  }

  public function addFilter(Amhsoft_Widget_Filter_Interface $filter) {
    $this->filters[] = $filter;
  }

  public function getFilter() {
    return $this->filters;
  }

  public function applyFilters() {
    foreach ($this->filters as $filter) {
      $this->Value = $filter->apply($this->Value);
    }
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  abstract public function Draw();

  /**
   * check if attribute values are valid
   * @return boolean true if valid, otherwise false
   */
  public function Validate() {
    $validation_msg = _t('is required');
    $e = true;
    if (!is_array($this->Value)) {
      $e = ($this->Value != null && (trim($this->Value) != ''));
    }
    if (is_array($this->Value)) {
      $e = count($this->Value) > 0;
    }

    foreach ($this->getValidators() as $validator) {
      $validator->setValue($this->Value);
      $isValid = $validator->isValid();
      if ($isValid == false) {
        $validation_msg = $validator->getErrorMessage();
      }
      $e &= $isValid;
    }

    
    $result= null;
    if ($this->onValidate) {
      $result = $this->onValidate->dispatchEvent($this);
    }
    if ($result !== NULL) {
      $e = $result;
    }
    if (!$e) {
      if ($this->Class) {
        $this->Class .= ' invalid error';
      } else {
        $this->Class = 'invalid error';
      }
      $this->ToolTip = ($this->errorMessage) ? $this->errorMessage : $this->Label . ': ' . $validation_msg; //($this->ToolTip == null) ? _t('invalid input') : $this->ToolTip;
    }
    
    
    
    return $e;
  }

  /**
   * Draw/Render component
   * @return string output like HTML
   */
  public function Render() {
    return $this->Draw();
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   * @see Draw()
   */
  public function __toString() {
    return $this->Render();
  }

  /**
   * get the name of the Control
   * @return string the name of the Control
   */
  public function getName() {
    return $this->Name;
  }

  /**
   * set the name of the Control
   * @param string $Name the name of the Control
   */
  public function setName($Name) {
    $this->Name = $Name;
    return $this;
  }

  /**
   * get the ID of the Control
   * @return string ID of the Control
   */
  public function getId() {
    return $this->Id;
  }

  /**
   * set the ID of the Control
   * @param string $Id ID of the Control
   */
  public function setId($Id) {
    $this->Id = $Id;
    return $this;
  }

  /**
   * get the default value of the Control
   * @return mixed Default value of the Control
   */
  public function getDefaultValue() {
    return $this->DefaultValue;
  }

  /**
   * set the default value of the Control
   * @param mixed $DefaultValue Default value of the Control
   */
  public function setDefaultValue($DefaultValue) {
    $this->DefaultValue = $DefaultValue;
    return $this;
  }

  /**
   * get the value of the Control
   * @return string Value of the Control
   */
  public function getValue() {
    return $this->Value;
  }

  /**
   * set the value of the Control
   * @param string $Value Value of the Control
   */
  public function setValue($Value) {
    $this->Value = $Value;
    return $this;
  }

  /**
   * get the label text of the Control
   * @return string Label text of the Control
   */
  public function getLabel() {
    if ($this->Required == true) {
      return $this->Label . ' *';
    }
    return $this->Label;
  }

  /**
   * set the label text of the Control
   * @param string $Label Label text of the Control
   */
  public function setLabel($Label) {
    $this->Label = $Label;
    return $this;
  }

  /**
   * get the width attribute value
   * @return string Width attribute value
   */
  public function getWidth() {
    return $this->Width;
  }

  /**
   * set the width attribute value
   * @param string $Width Width attribute value
   */
  public function setWidth($Width) {
    $this->Width = $Width;
    return $this;
  }

  /**
   * get status, if the Control is ReadOnly
   * @return boolean True if the Control is ReadOnly, false otherweise
   */
  public function getReadOnly() {
    return $this->ReadOnly;
  }

  /**
   * set true if the Control is ReadOnly, false otherweise
   * @param boolean $ReadOnly True if the Control ReadOnly, false otherweise
   */
  public function setReadOnly($ReadOnly) {
    $this->ReadOnly = $ReadOnly;
    return $this;
  }

  /**
   * get the style attribute value
   * @return string style attribute value
   */
  public function getDockStyle() {
    return $this->DockStyle;
  }

  /**
   * set the style attribute value
   * @param string $DockStyle style attribute value
   */
  public function setDockStyle($DockStyle) {
    $this->DockStyle = $DockStyle;
    return $this;
  }

  /**
   * get status, if check/validate values are on or off
   * @return boolean True, if you want to check/validate values, false otherwise
   */
  public function getRequired() {
    return $this->Required;
  }

  /**
   * Set status, to turn check/validate values on or off.
   * @param boolean $Required True, if you want to check/validate values, false otherwise.
   */
  public function setRequired($Required) {
    $this->Required = $Required;
    return $this;
  }

  /**
   * get class attribute value
   * @return string class attribute value
   */
  public function getClass() {
    return $this->Class;
  }

  /**
   * set class attribute value
   * @param string $Class class attribute value
   */
  public function setClass($Class) {
    $this->Class = $Class;
    return $this;
  }

  /**
   * get javascript attribute value
   * @return string javascript attribute value
   */
  public function getJavaScript() {
    return $this->JavaScript;
  }

  /**
   * set javascript attribute value
   * @param string $JavaScript javascript attribute value
   */
  public function setJavaScript($JavaScript) {
    $this->JavaScript = $JavaScript;
    return $this;
  }

  /**
   * get the direction, true, if left to right, false otherwise (right to left)
   * @return True if direction is left to right, false otherwise (rtl)
   */
  public function getLTR() {
    return $this->LTR;
  }

  /**
   * set to true if you want the direction to be left to right, false otherwise
   * @param boolean $LTR True if direction is left to right, false otherwise (rtl)
   */
  public function setLTR() {
    $this->LTR = true;
    return $this;
  }

  /**
   * Set error message.
   * @param string $message 
   */
  public function setErrorMessage($message) {
    $this->errorMessage = $message;
  }

  /**
   * Sets error message.
   * @return string error message
   */
  public function getErrorMessage() {
    return $this->errorMessage;
  }

  public function addValidator($validator) {
    if ($validator instanceof Amhsoft_Abstract_Validator) {
      $this->validators[] = $validator;
      $this->Required = true;
    }

    if (is_string($validator)) {
      if (!$validator) {
        return;
      }
      $_validator_args = explode('|', $validator);
      if (count($_validator_args) == 0) {
        return;
      }
      $validatorClassName = 'Amhsoft_' . ucfirst(array_shift($_validator_args)) . '_Validator';
      if (class_exists($validatorClassName)) {
        $reflectionClass = new ReflectionClass($validatorClassName);
        $instance = $reflectionClass->newInstanceArgs($_validator_args);
        $this->validators[] = $instance;
      }
    }
  }

  public function getValidators() {
    return $this->validators;
  }

  public function Bind($dataSource) {
    
  }

  public static function Create($name, $type = null) {
    switch ($type) {
      case '1':
        return new Amhsoft_Input_Control($name);
        break;
      case 'password':
        return new Amhsoft_Password_Control($name);
        break;
      case '2':
        return new Amhsoft_ListBox_Control($name);
        break;
      case '7':
        return new Amhsoft_TextArea_Control($name);
        break;
      case '6':
        return new Amhsoft_TextArea_Wysiwyg_Control($name);
        break;
      case 'radiobox':
        return new Amhsoft_RadioBox_Control($name);
        break;
      case '4':
        $com = new Amhsoft_CheckBox_Control($name);
        $com->Value = 1;
        return $com;
        break;
      case '8':
        return new Amhsoft_Label_Control($name);
        break;
      case '9':
        return new Amhsoft_YesNo_ListBox_Control($name, null, null);
        break;
      case '3':
        return new Amhsoft_Date_Input_Control($name);
        break;
      case 'text':
        return new Amhsoft_TextLabel_Control($name);
        break;
      case '5':
        return new Amhsoft_Currency_Input_Control($name);
        break;
      case '9':
        return new Amhsoft_YesNo_ListBox_Control($name, null, $name, 0);
        break;
      case '10':
        return new Amhsoft_Unit_KiloMeter_Input_Control($name);
        break;
      case '11':
        return new Amhsoft_Unit_Mile_Input_Control($name);
        break;
      case '12':
        return new Amhsoft_Unit_Gramm_Input_Control($name);
        break;
      case '13':
        return new Amhsoft_Unit_KiloGramm_Input_Control($name);
        break;
      case '14':
        return new Amhsoft_Unit_Meter_Input_Control($name);
        break;
      case '15':
        return new Amhsoft_Unit_Feed_Input_Control($name);
        break;
      case '16':
        return new Amhsoft_Unit_Meter_Input_Control($name);
        break;
      case '17':
        return new Amhsoft_Unit_Second_Input_Control($name);
        break;
      case '18':
        return new Amhsoft_Unit_Centiliter_Input_Control($name);
        break;
      case '19':
        return new Amhsoft_Unit_Milliliter_Input_Control($name);
        break;
      case '20':
        return new Amhsoft_Unit_Hour_Input_Control($name);
        break;
      case '21':
        return new Amhsoft_Unit_Color_Input_Control($name);
        break;
      case '22':
        return new Amhsoft_Unit_Centimeter_Input_Control($name);
        break;
      case '23':
        $validator = new Amhsoft_File_Validator(8000, Amhsoft_Mimetype::PDF . ';' . Amhsoft_Mimetype::DOC . ';' . Amhsoft_Mimetype::IMAGES);
        return new Amhsoft_FileInput_Control($name, null, _t('Upload'), $validator);
        break;
      default:
        return new Amhsoft_Input_Control($name);
        break;
    }
  }

  public static function CreateFrontEnd($name, $type = null) {
    if ($type == 9) {
      return new Amhsoft_YesNo_Image_Control($name, 0);
    } else if ($type > 9 && $type < 21) {
      $input = self::Create($name, $type);
      return new Amhsoft_Unit_Label_Control($name, $input->Unit);
    } else if ($type == 23) {
      return new Amhsoft_FileInput_Control($name);
    } else if ($type == 21) {
      return new Amhsoft_ColorLabel_Control($name);
    } else if ($type == 5) {
      return new Amhsoft_Currency_Label_Control($name);
    } else if ($type == 4) {
      return new Amhsoft_YesNo_Image_Control($name, 0);
    } else {
      return new Amhsoft_Label_Control($name);
    }
  }

  public static function getComponentId($className) {
    if ($className == 'Amhsoft_Input_Control') {
      return 1;
    }
    if ($className == 'Amhsoft_ListBox_Control') {
      return 2;
    }
    if ($className == 'Amhsoft_Label_Control') {
      return 8;
    }
    return 1;
  }

}

?>