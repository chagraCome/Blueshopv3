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
class Newsletter_Emails_Groups_Form extends Amhsoft_Widget_Form {

  public $name;
  public $desc;
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
   * Initialize Form Components
   */
  public function initializeComponents() {
    $generealInformationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $this->name = new Amhsoft_Input_Control('name', _t('Name'));
    $this->name->setWidth(250);
    $this->name->DataBinding = new Amhsoft_Data_Binding('name');
    $this->name->Required = TRUE;
    $generealInformationPanel->addComponent($this->name);
    $this->desc = new Amhsoft_TextArea_Control('desc', _t('Description'));
    $this->desc->DataBinding = new Amhsoft_Data_Binding('desc');
    $this->desc->Required = true;
    $generealInformationPanel->addComponent($this->desc);
    $navigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
    $this->submitButton->Class = "ButtonSave";
    $navigation->addComponent($this->submitButton);
    $this->addComponent($generealInformationPanel);
    $this->addComponent($navigation);
  }

  /*
   * Send Form
   */

  public function isSend() {
    return isset($_POST["submit"]);
  }

}

?>