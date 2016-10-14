<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_State_Form extends Amhsoft_Widget_Form {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $tPanel = new Amhsoft_Widget_Panel(_t('General Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');


    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';

    $tPanel->addComponent($this->nameInput);
    $navPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navPanel->addComponent($this->submitButton);
    
    $this->addComponent($tPanel);
    $this->addComponent($navPanel);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
