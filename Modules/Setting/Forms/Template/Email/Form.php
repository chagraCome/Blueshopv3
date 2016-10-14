<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Template_Email_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {
  /*   * Amhsoft_Input_Control $nameInput */

  public $nameInput;

  /*   * Amhsoft_Input_Control $subjectInput */
  public $subjectInput;

  /** @var ListBox $variableList */
  public $variableList;

  /** TextArea $contentTextArea */
  public $contentTextArea;
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
     $tPanel = new Amhsoft_Widget_Panel(_t('Template Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(300);
    $this->nameInput->Required = true;
    $this->subjectInput = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subjectInput->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subjectInput->setWidth(300);
    $this->variableList = new Amhsoft_WorkFlow_Attribute_ListBox_Control('variablelist', 'variablelist', _t('Variables'));
    $this->variableList->JavaScript = 'appendToTinyMce(this.value)';
    $this->contentTextArea = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
    $this->contentTextArea->DataBinding = new Amhsoft_Data_Binding('content');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $tPanel->addComponent($this->nameInput);
    $tPanel->addComponent($this->subjectInput);
    $tPanel->addComponent($this->variableList);
    $tPanel->addComponent($this->contentTextArea);
    $navPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navPanel->addComponent($this->submitButton);
    
    $this->addComponent($tPanel);
    $this->addComponent($navPanel);
  }

  /**
   * Get Variables
   * @return string
   */
  protected function getVariables() {
    $publishedModels = Amhsoft_System::getPublishedModels();
    if (empty($publishedModels)) {
      return array();
    }
    $source = array();
    while (list($modelClass, $modelName) = each($publishedModels)) {
      $attrs = get_class_vars($modelClass);
      $datasource = array();
      foreach ($attrs as $key => $val) {
	$datasource['__' . $modelClass . '::' . $key . '__'] = $modelName . '::' . $key;
      }
      $source[] = array('var' => $modelName, 'text' => $datasource);
    }
    return $source;
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