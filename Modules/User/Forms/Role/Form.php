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
class User_Role_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_ListBox_Control $parentListBox */
  public $parentListBox;

  /** @var YesNoListBox $stateYesNoListBox */
  public $stateYesNoListBox;
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
    $panel = new Amhsoft_Widget_Panel(_t('Role Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(250);
    $this->nameInput->setRequired(true);
    $this->parentListBox = new Amhsoft_ListBox_Control('parent_id', _t('Parent:'));
    $this->parentListBox->DataBinding = new Amhsoft_Data_Binding('parent_id', 'rbac_role_id', 'name');
    $this->parentListBox->DataSource = Amhsoft_Data_Source::Table('rbac_role_lang', 'rbac_role_id', 'name', " WHERE lang = '" . Amhsoft_System::getCurrentLang() . "'");
    $this->parentListBox->WithNullOption = true;
    $this->stateYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $panel->addComponent($this->nameInput);
    $panel->addComponent($this->parentListBox);
    $panel->addComponent($this->stateYesNoListBox);
    $panel1 = new Amhsoft_Widget_Panel(_t('Navigation'));
    $panel1->addComponent($this->submitButton);
    $this->addComponent($panel)
	    ->addComponent($panel1);
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
