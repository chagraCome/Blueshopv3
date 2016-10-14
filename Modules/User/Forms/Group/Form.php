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
class User_Group_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_Input_Control $aliasInput */
  public $aliasInput;

  /** @var Amhsoft_Button_Submit_Control $submitButton */
  public $submitButton;

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
    $tPanel = new Amhsoft_Widget_Panel(_t('General Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', 'اسم المجموعة', NULL, NULL);
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(200);
    $this->nameInput->Required = true;
    $this->aliasInput = new Amhsoft_Input_Control('alias', _t('Alias'), NULL, NULL);
    $this->aliasInput->DataBinding = new Amhsoft_Data_Binding('alias');
    $this->aliasInput->ToolTip = _t('Not important');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $tPanel->addComponent($this->nameInput);
    $tPanel->addComponent($this->aliasInput);
    $navPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navPanel->addComponent($this->submitButton);
    
    $this->addComponent($tPanel);
    $this->addComponent($navPanel);
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
