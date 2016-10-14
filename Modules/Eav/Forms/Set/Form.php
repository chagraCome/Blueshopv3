<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eqv
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $

 * Application::import('Amhsoft.Core.Controls.Control');
 */
class Eav_Set_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput * */
  public $nameInput;
  public $submitButton;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->Required = true;
    $this->nameInput->setWidth(250);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $panel = new Amhsoft_Widget_Panel(_t('Entity Set Name'));
    $panel->addComponent($this->nameInput);
    $this->addComponent($panel);
    $panel2 = new Amhsoft_Widget_Panel(_t('Navigation'));
    $panel2->addComponent($this->submitButton);
    $this->addComponent($panel2);
  }

  /**
   * Send Form
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
