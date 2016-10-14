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
class Workflow_Condition_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_ListBox_Control $conditionLeftInput */
  public $conditionLeftList;

  /** @var Amhsoft_Input_Control $conditionRightInput */
  public $conditionRightInput;

  /** @var Amhsoft_ListBox_Control $conditionOpListBox */
  public $conditionOpListBox;

  /** @var Amhsoft_YesNo_ListBox_Control $conditionYesNoListBox */
  public $conditionYesNoListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->conditionLeftList = new Amhsoft_WorkFlow_Attribute_ListBox_Control('condition_left', 'condition_left', _t('Variables'));
    $this->conditionLeftList->setRequired(true);

    $this->conditionRightInput = new Amhsoft_Input_Control('condition_right', _t('Condition Right'));
    $this->conditionRightInput->DataBinding = new Amhsoft_Data_Binding('condition_right');
    $this->conditionRightInput->setRequired(true);

    $this->conditionOpListBox = new Amhsoft_ListBox_Control('condition_op', _t('Condition Operator'));
    $this->conditionOpListBox->DataBinding = new Amhsoft_Data_Binding('condition_op', 'value', 'text');
    $this->conditionOpListBox->DataSource = new Amhsoft_Data_Set($this->getOperator());
    $this->conditionOpListBox->WithNullOption = true;

    $this->conditionYesNoListBox = new Amhsoft_YesNo_ListBox_Control('state', _t('Active'), 'state', 1);

    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';

    $this->addComponent($this->conditionLeftList);
    $this->addComponent($this->conditionOpListBox);
    $this->addComponent($this->conditionRightInput);
    $this->addComponent($this->conditionYesNoListBox);
    $this->addComponent($this->submitButton);
  }

  public function getVariableSource() {
    $publishedModels = Amhsoft_System::getPublishedModels();
    if (empty($publishedModels)) {
      return array();
    }

    $source = array();
    foreach ($publishedModels as $model) {
      while (list($alias, $attributes) = each($model)) {
        $source[] = array('var' => $alias, 'text' => $attributes);
      }
    }

    return $source;
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

  protected function getOperator() {
    $opArray = array();
    $opArray[] = array('value' => 'eq', 'text' => _t('Equals'));
    $opArray[] = array('value' => 'noteq', 'text' => _t('Not Equal'));
    $opArray[] = array('value' => 'contains', 'text' => _t('Contains'));
    $opArray[] = array('value' => 'notContains', 'text' => _t('Not Contains'));
    $opArray[] = array('value' => 'greaterThan', 'text' => _t('Greater Than'));
    $opArray[] = array('value' => 'lessThan', 'text' => _t('Less Than'));
    $opArray[] = array('value' => 'greaterEqualThan', 'text' => _t('Greater or Equal Than'));
    $opArray[] = array('value' => 'lessEqualThan', 'text' => _t('Less or Equal Than'));
    $opArray[] = array('value' => 'startWith', 'text' => _t('Start With'));
    $opArray[] = array('value' => 'endWith', 'text' => _t('End With'));


    return $opArray;
  }

}

?>
