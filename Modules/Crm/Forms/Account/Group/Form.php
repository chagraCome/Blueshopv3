<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Account_Group_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_Input_Control $aliasInput */
  public $aliasInput;

  /** @var Amhsoft_CheckBox_Control $defaultCheckBox */
  public $defaultCheckBox;

  /** @var Amhsoft_Button_Submit_Control $submitButton */
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $panel = New Amhsoft_Widget_Panel(_t('Add Account Group'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Group Name'), NULL, NULL);
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(200);
    $this->nameInput->Required = true;
    $this->defaultCheckBox = new Amhsoft_YesNo_ListBox_Control("as_default", _t('Default Group'), 'as_default', 0);
    $panelNavigation = New Amhsoft_Widget_Panel(_t('Navigation'));
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $panel->addComponent($this->nameInput);
    $panel->addComponent($this->defaultCheckBox);
    $panelNavigation->addComponent($this->submitButton);
    $this->addComponent($panel);
    $this->addComponent($panelNavigation);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
