<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Department_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $nameInput */
  public $nameInput;

  /** @var Input $countryInput */
  public $countryInput;

  /** @var Input $telefonInput */
  public $telefonInput;

  /** @var Input $addressInput */
  public $addressInput;

  /**
   * Construct
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
    $panel = new Amhsoft_Widget_Panel(_t('General Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->Required = true;
    $panel1 = new Amhsoft_Widget_Panel(_t('Adresses Information'));
    $this->countryInput = new Amhsoft_Input_Control('country', _t('Country'));
    $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country');
    $this->telefonInput = new Amhsoft_Input_Control('telefon', _t('Telefon'));
    $this->telefonInput->DataBinding = new Amhsoft_Data_Binding('telefon');
    $this->addressInput = new Amhsoft_TextArea_Control('address', _t('Address'));
    $this->addressInput->DataBinding = new Amhsoft_Data_Binding('address');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $panel->addComponent($this->nameInput);
    $panel->addComponent($this->telefonInput);
    $panel1->addComponent($this->countryInput);
    $panel1->addComponent($this->addressInput);
    $this->addComponent($panel);
    $this->addComponent($panel1);
    $panel2 = new Amhsoft_Widget_Panel(_t('Navigation'));
    $panel2->addComponent($this->submitButton);
    $this->addComponent($panel2);
  }

  /**
   * Form send method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
