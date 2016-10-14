<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_MailInbox_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $subjectInput */
  public $subjectInput;

  /** @var ListBox $personListBox */
  public $personTo;

  /** @var Input $CCInput */
  public $CCInput;

  /** @var Input $BCCInput */
  public $BCCInput;

  /** @var TextArea $content */
  public $contentTextArea;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->subjectInput = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subjectInput->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subjectInput->Required = true;
    $this->personTo = new Amhsoft_Input_Control('email_to', _t('To'));
    $this->personTo->DataBinding = new Amhsoft_Data_Binding('email_to', 'id');
    $this->CCInput = new Amhsoft_Input_Control('cc', _t('CC '));
    $this->CCInput->DataBinding = new Amhsoft_Data_Binding('cc');
    $this->BCCInput = new Amhsoft_Input_Control('bcc', _t('BCC'));
    $this->BCCInput->DataBinding = new Amhsoft_Data_Binding('bcc');
    $this->contentTextArea = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Message Content'));
    $this->contentTextArea->DataBinding = new Amhsoft_Data_Binding('content');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->addComponent($this->subjectInput);
    $this->addComponent($this->personTo);
    $this->addComponent($this->CCInput);
    $this->addComponent($this->BCCInput);
    $this->addComponent($this->contentTextArea);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
