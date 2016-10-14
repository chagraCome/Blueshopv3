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
class Crm_Account_Source_Form extends Amhsoft_Widget_Form {

  public $name;
  public $submitButton;
  public $captcha;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $panel = New Amhsoft_Widget_Panel(_t('Add Account Source'));
    $this->name = new Amhsoft_Input_Control('name', _t('Name'));
    $this->name->DataBinding = new Amhsoft_Data_Binding('name');
    $this->name->Required = true;
    $panel->addComponent($this->name);
    $panelNavigation = New Amhsoft_Widget_Panel(_t('Navigation'));
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
    $this->submitButton->Class = "ButtonSave";
    $panelNavigation->addComponent($this->submitButton);
    $this->addComponent($panel);
    $this->addComponent($panelNavigation);
  }

  public function isSend() {
    return isset($_POST["submit"]);
  }

}

?>