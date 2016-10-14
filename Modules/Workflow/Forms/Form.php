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
class Workflow_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_ListBox_Control $eventList */
  public $eventList;

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_ListBox_Control $modelList */
  public $modelList;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNoListBox */
  public $stateYesNoListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->modelList = new Amhsoft_ListBox_Control('modelname', _t('Model Name'));
    $publishesModels = Amhsoft_System::getPublishedModels();
    $array = array();
    foreach ($publishesModels as $className => $model) {
      list($modelAlias, $attributes) = each($model);
      $array[] = array('value' => $className, 'label' => $modelAlias);
    }
    $this->modelList->DataSource = new Amhsoft_Data_Set($array);
    $this->modelList->DataBinding = new Amhsoft_Data_Binding('modelname', 'value', 'label');

    $this->eventList = new Amhsoft_ListBox_Control('eventname', _t('Event Name'));
    $this->eventList->DataBinding = new Amhsoft_Data_Binding('eventname');
    $this->eventList->DataSource = new Amhsoft_Data_Set(array('Insert', 'Update', 'Delete'));

    $this->nameInput = new Amhsoft_Input_Control('name', _t('Workflow Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setRequired(true);
    $this->stateYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('Active'), 'state', 1);
    
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';

    $this->addComponent($this->nameInput);
    $this->addComponent($this->modelList);
    $this->addComponent($this->eventList);
    $this->addComponent($this->stateYesNoListBox);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
