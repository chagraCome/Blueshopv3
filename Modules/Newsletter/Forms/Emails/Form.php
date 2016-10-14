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
class Newsletter_Emails_Form extends Amhsoft_Widget_Form {

  public $email;
  public $state;
  public $group;
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
    $generealInformationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $this->email = new Amhsoft_Input_Control('email', _t('Email'));
    $this->email->DataBinding = new Amhsoft_Data_Binding('email');
    $this->email->Width = 180;
    $this->email->Required = true;
    $this->email->addValidator(new Amhsoft_Email_Validator());
    $generealInformationPanel->addComponent($this->email);
    $this->group = new Amhsoft_ListBox_Control('newsletter_email_groups_id', _t('Group'));
    $this->group->DataBinding = new Amhsoft_Data_Binding('newsletter_email_groups_id', 'id', 'name');
    $this->group->DataSource = new Amhsoft_Data_Set(new Newsletter_Email_Group_Model_Adapter());
    $this->group->Width = 180;
    $this->group->Required=TRUE;
    $generealInformationPanel->addComponent($this->group);
    $navigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
    $this->submitButton->Class = "ButtonSave";
    $navigation->addComponent($this->submitButton);
    $this->addComponent($generealInformationPanel);
    $this->addComponent($navigation);
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