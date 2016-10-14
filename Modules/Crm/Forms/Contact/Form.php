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
class Crm_Contact_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $numberInput */
  public $numberInput;

  /** @var Input $companyInput */
  public $compnayInput;

  /** @var Input $firstnameInput */
  public $firstnameInput;

  /** @var Input $lastnameInput */
  public $lastnameInput;

  /** @var Input $dateofbirthInput */
  public $dateofbirthInput;

  /** @var Input $phoneInput */
  public $phoneInput;

  /** @var Input $emailInput */
  public $emailInput;

  /** @var Input $mobileInput */
  public $mobileInput;

  /** @var Input $faxInput */
  public $faxInput;

  /** @var Input $noticeInput */
  public $noticeInput;

  /** @var Amhsoft_ListBox_Control $groupListBox */
  public $groupListBox;

  /** @var Amhsoft_ListBox_Control $companywebsiteInput */
  public $companywebsiteInput;

  /** @var YesNoListBox $stateYesNoListBox */
  public $stateYesNoListBox;
  public $accountListBox;
//  public $contactStageListBox;
  public $contactSourceListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->numberInput = new Amhsoft_Input_Control('number', _t('Number'));
    $this->numberInput->DataBinding = new Amhsoft_Data_Binding('number');
    $this->numberInput->Required = true;
    $this->compnayInput = new Amhsoft_Input_Control('company', _t('Company'), null, 64);
    $this->compnayInput->DataBinding = new Amhsoft_Data_Binding('company');
    $this->firstnameInput = new Amhsoft_Input_Control('firstname', _t('Name'), null, 54);
    $this->firstnameInput->DataBinding = new Amhsoft_Data_Binding('firstname');
    $this->firstnameInput->Required = true;
    $this->phoneInput = new Amhsoft_Input_Control('phone', _t('Phone'));
    $this->phoneInput->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->emailInput = new Amhsoft_Input_Control('email', _t('Email'), null, 64);
    $this->emailInput->DataBinding = new Amhsoft_Data_Binding('email');
    $this->emailInput->Required = true;
    $this->emailInput->addValidator('Email');
    $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
    $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
    $this->companywebsiteInput = new Amhsoft_Input_Control('company_website', _t('Company Website'));
    $this->companywebsiteInput->DataBinding = new Amhsoft_Data_Binding('company_website');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->numberInput);
    $generalPanel->addComponent($this->compnayInput);
    $generalPanel->addComponent($this->firstnameInput);
    $generalPanel->addComponent($this->phoneInput);
    $generalPanel->addComponent($this->emailInput);
    $generalPanel->addComponent($this->companywebsiteInput);
    $this->addComponent($generalPanel);
    $noticesPanel = new Amhsoft_Widget_Panel(_t('Notices'));
    $this->noticeInput = new Amhsoft_TextArea_Control('notice', _t('Notice'));
    $this->noticeInput->DataBinding = new Amhsoft_Data_Binding('notice');
    $noticesPanel->addComponent($this->noticeInput);
    $this->addComponent($noticesPanel);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navigationPanel->addComponent($this->submitButton);
    $this->addComponent($navigationPanel);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
