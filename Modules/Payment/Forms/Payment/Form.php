<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Payment_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_Input_Control $descriptionTextArea */
  public $descriptionTextArea;

  /** @var Amhsoft_Input_Control $sortidInput */
  public $sortidInput;

  /** @var Amhsoft_Input_Control $onlineInput */
  public $onlineInput;

  /** @var Amhsoft_FileInput_Control $imagefileInput */
  public $imagefileInput;

  /** @var Amhsoft_Input_Control $feeInput */
  public $feeInput;

  /** @var Amhsoft_ImageControl_Control $imgCol */
  public $imgCol;
  public $submitButtonInput;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->setMultipart(true);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(300);
    $this->nameInput->Required = true;
    
    $this->feeInput = new Amhsoft_Input_Control('fee', _t('Fee'));
    $this->feeInput->DataBinding = new Amhsoft_Data_Binding('fee');
    $this->feeInput->ToolTip = _t('Fee can be 5.0 or 5%');
    
    $this->descriptionTextArea = new Amhsoft_TextArea_Wysiwyg_Control('description', _t('Description'));
    $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');
    $this->descriptionTextArea->Required = true;
    
    $this->onlineInput = new Amhsoft_YesNo_ListBox_Control('online', _t('Online'), 'online', 1);
    
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    
    $this->imgCol = new Amhsoft_ImageControl_Control('logosrc');
    $this->imgCol->DataBinding = new Amhsoft_Data_Binding('logosrc');
    $this->imgCol->setWidth(220);
    $this->imgCol->setHeight(60);
    $this->imagefileInput = new Amhsoft_FileInput_Control('image_file', 'Image to upload', 'Add Image');
   
    $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
    $this->imagefileInput->addValidator($ImageValidator);
    $this->imgCol->uploadControl = $this->imagefileInput;
   
    $paymentNamePanel = new Amhsoft_Widget_Panel(_t('Payment Name'));
    $paymentNamePanel->addComponent($this->nameInput);
    $paymentNamePanel->addComponent($this->feeInput);
    
    $paymentSettings = new Amhsoft_Widget_Panel(_t('Payment Settings'));
    $paymentSettings->addComponent($this->onlineInput);
    
    $imagePanel = new Amhsoft_Widget_Panel(_t('Logo'));
    $imagePanel->addComponent($this->imgCol);
    
    $descriptionPanel = new Amhsoft_Widget_Panel(_t('Description'));
    $descriptionPanel->addComponent($this->descriptionTextArea);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navigationPanel->addComponent($this->submitButton);
    
    $this->addComponent($paymentNamePanel);
    $this->addComponent($descriptionPanel);
    $this->addComponent($imagePanel);
    $this->addComponent($paymentSettings);
    $this->addComponent($navigationPanel);
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
