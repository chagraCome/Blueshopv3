<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Sendtofreind_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput * */
  public $nameInput;

  /** @var Amhsoft_Input_Control $yourEmailInput * */
  public $yourEmailInput;

  /** @var Amhsoft_Input_Control $freindsNameInput * */
  public $freindsNameInput;

  /** @var Amhsoft_Input_Control $freindsEmailInput * */
  public $freindsEmailInput;

  /** @var Amhsoft_Input_Control $subjectInput * */
  public $subjectInput;

  /** @var Amhsoft_TextArea_Control $messageTextArea * */
  public $messageTextArea;
  public $captcha;
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
    $this->nameInput->addValidator('String|2');
    $this->nameInput->setWidth(300);
    $this->yourEmailInput = new Amhsoft_Input_Control('senderemail', _t('Email'));
    $this->yourEmailInput->DataBinding = new Amhsoft_Data_Binding('senderemail');
    $this->yourEmailInput->Required = true;
    $this->yourEmailInput->addValidator('Email');
    $this->yourEmailInput->setWidth(300);
    $this->freindsNameInput = new Amhsoft_Input_Control('recipientname', _t('Your freinds name'));
    $this->freindsNameInput->DataBinding = new Amhsoft_Data_Binding('recipientname');
    $this->freindsNameInput->Required = true;
    $this->freindsNameInput->addValidator('String|2');
    $this->freindsNameInput->setWidth(300);
    $this->freindsEmailInput = new Amhsoft_Input_Control('recipientemail', _t('Your freinds email'));
    $this->freindsEmailInput->DataBinding = new Amhsoft_Data_Binding('recipientemail');
    $this->freindsEmailInput->Required = true;
    $this->freindsEmailInput->addValidator('Email');
    $this->freindsEmailInput->setWidth(300);
    $this->subjectInput = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subjectInput->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subjectInput->Required = true;
    $this->subjectInput->addValidator('String|2');
    $this->subjectInput->setWidth(300);
    $this->messageTextArea = new Amhsoft_TextArea_Control(_t('Message'));
    $this->messageTextArea->DataBinding = new Amhsoft_Data_Binding('message');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Send'));
    $this->submitButton->Class = 'Button';
    $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
    $this->captcha->setRequired(true);

    $this->addComponent($this->nameInput);
    $this->addComponent($this->yourEmailInput);
    $this->addComponent($this->freindsNameInput);
    $this->addComponent($this->freindsEmailInput);
    $this->addComponent($this->subjectInput);
    $this->addComponent($this->messageTextArea);
    $this->addComponent($this->captcha);
    $this->addComponent($this->submitButton);
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
