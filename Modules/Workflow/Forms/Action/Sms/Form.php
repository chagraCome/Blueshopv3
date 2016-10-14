<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Action_Sms_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $fromInput * */
  public $fromInput;

  /** @var Amhsoft_Input_Control $phoneInput * */
  public $phoneInput;

  /** TextArea $contentTextArea */
  public $contentTextArea;

  /** @var ListBox $variableList */
  public $variableList;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNoListBox * */
  public $stateYesNoListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->fromInput = new Amhsoft_Input_Control('from', _t('From'));
    $this->fromInput->DataBinding = new Amhsoft_Data_Binding('from');
    $this->fromInput->setRequired(true);

    $phonePanel = new Amhsoft_Widget_Panel();
    $phonePanel->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Grid_Layout::APPEND));
    $this->phoneInput = new Amhsoft_Input_Control('phone', _t('Phone'));
    $this->phoneInput->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->phoneInput->setSize(600);
    $toVariableListBox = new Amhsoft_WorkFlow_Attribute_ListBox_Control('varPhoneList', 'varPhoneList', _t('Variables'), 'mobile', 'phone');
    $phonePanel->addComponent($this->phoneInput);
    $phonePanel->addComponent($toVariableListBox);
    
    $this->variableList = new Amhsoft_WorkFlow_Attribute_ListBox_Control("listvariable", "listvariable", "Variables", "", 'body');

    $this->contentTextArea = new Amhsoft_TextArea_Control('body', _t('Content'));
    $this->contentTextArea->DataBinding = new Amhsoft_Data_Binding('body');


    $this->stateYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('Active'), 'state', 1);

    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';

    $this->addComponent($this->fromInput);
    $this->addComponent($phonePanel);
    $this->addComponent($this->variableList);
    $this->addComponent($this->contentTextArea);
    $this->addComponent($this->stateYesNoListBox);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
