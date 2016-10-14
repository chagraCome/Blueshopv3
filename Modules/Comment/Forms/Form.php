<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_Form extends Amhsoft_Widget_Form {

  public $comment;
  public $subject;
  public $public;
  public $submitButton;
  public $captcha;
  public $commentPanel;

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
   * Form Initialize Components
   */
  public function initializeComponents() {
    $this->commentPanel = new Amhsoft_Widget_Panel();
    $this->subject = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subject->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->subject->setWidth(300);
    $this->subject->Required = true;
    $this->comment = new Amhsoft_TextArea_Control('comment', _t('Comment'));
    $this->comment->DataBinding = new Amhsoft_Data_Binding('comment');
    $this->public = new Amhsoft_YesNo_ListBox_Control('public', _t('Is Public'), 'public', false);
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
    $this->submitButton->Class = "ButtonSave";
    $this->commentPanel->addComponent($this->subject);
    $this->commentPanel->addComponent($this->comment);
    $this->commentPanel->addComponent($this->public);
    $nav = new Amhsoft_Widget_Panel();
    $nav->addComponent($this->submitButton);
    $this->addComponent($this->commentPanel);
    $this->addComponent($nav);
  }

  /**
   * Send Form
   * @return type
   */
  public function isSend() {
    return isset($_POST["submit"]);
  }

}

?>