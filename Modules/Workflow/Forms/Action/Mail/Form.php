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
class Workflow_Action_Mail_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {
  /*   * @var Amhsoft_Input_Control $toInput */

  public $toInput;
  public $fromInput;

  /*   * Amhsoft_Input_Control $subjectInput */
  public $subjectInput;

  /** @var ListBox $variableList */
  public $variableList;

  /** TextArea $contentTextArea */
  public $contentTextArea;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNoListBox * */
  public $stateYesNoListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {


    $toPanel = new Amhsoft_Widget_Panel('');

    $this->toInput = new Amhsoft_Input_Control('to', _t('To'));
    $this->toInput->DataBinding = new Amhsoft_Data_Binding('to');
    $this->toInput->Required = true;
    $this->toInput->setWidth(400);
    $toPanel->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Grid_Layout::APPEND));
    $toPanel->addComponent($this->toInput);
    $toVariableListBox = new Amhsoft_WorkFlow_Attribute_ListBox_Control('varToList', 'varToList', _t('Variables'), 'mail', 'to');
    $toVariableListBox->setWidth(150);
    $toPanel->addComponent($toVariableListBox);


    $this->fromInput = new Amhsoft_Input_Control('from', _t('From'));
    $this->fromInput->DataBinding = new Amhsoft_Data_Binding('from');
    $this->fromInput->setWidth(300);
    $this->fromInput->Required = true;


    $bccPanel = new Amhsoft_Widget_Panel('');

    $this->bccInput = new Amhsoft_Input_Control('bcc', _t('Bcc'));
    $this->bccInput->DataBinding = new Amhsoft_Data_Binding('bcc');
    $this->bccInput->setWidth(400);
    $bccPanel->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Grid_Layout::APPEND));
    $bccPanel->addComponent($this->bccInput);
    $bccVariableListBox = new Amhsoft_WorkFlow_Attribute_ListBox_Control('varBccList', 'varBccList', _t('Variables'), 'mail', 'bcc');
    $bccPanel->addComponent($bccVariableListBox);


    $this->subjectInput = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subjectInput->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subjectInput->setWidth(400);
    $this->variableList = new Amhsoft_WorkFlow_Attribute_ListBox_Control('variablelist', 'variablelist', _t('Variables'));
    $this->variableList->JavaScript = 'appendToTinyMce(this.value)';

    $this->contentTextArea = new Amhsoft_TextArea_Wysiwyg_Control('body', _t('Content'));
    $this->contentTextArea->DataBinding = new Amhsoft_Data_Binding('body');

    $this->stateYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('Active'), 'state', 1);

    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';

    $this->addComponent($toPanel);
    $this->addComponent($bccPanel);
    $this->addComponent($this->fromInput);
    $this->addComponent($this->subjectInput);
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
