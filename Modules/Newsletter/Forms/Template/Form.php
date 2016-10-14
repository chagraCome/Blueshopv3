<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Newsletter_Template_Form extends Amhsoft_Widget_Form {

  public $title;
  public $content;
  public $submitButton;
  public $captcha;

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
   * Initialize Components
   */
  public function initializeComponents() {
    $this->title = new Amhsoft_Input_Control('title', _t('Title'));
    $this->title->DataBinding = new Amhsoft_Data_Binding('title');
    $this->title->setWidth(350);
    $this->title->Required = true;
    $this->content = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
    $this->content->DataBinding = new Amhsoft_Data_Binding('content');
    $this->content->Required = true;
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
    $this->submitButton->Class = "ButtonSave";
    $panelInformation = new Amhsoft_Widget_Panel(_t('NewsLetter Template Information'));
    $panelInformation->addComponent($this->title);
    $panelInformation->addComponent($this->content);
    $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $panelNavigation->addComponent($this->submitButton);
    $this->addComponent($panelInformation);
    $this->addComponent($panelNavigation);
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