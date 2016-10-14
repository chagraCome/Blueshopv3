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
class Crm_Lead_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Input $numberInput */
  public $numberInput;

  /** @var Input $companyInput */
  public $compnayInput;

  /** @var Input $companywebsiteInput */
  public $companywebsiteInput;

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

  /** @var Amhsoft_ListBox_Control $sourceListBox */
  public $sourceListBox;

  /** @var YesNoListBox $stateYesNoListBox */
  public $stateYesNoListBox;
  public $accountListBox;
  public $submitButton;
  public $created;
  public $updated;

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
    $this->companywebsiteInput = new Amhsoft_Input_Control('company_website', _t('Company Website'), null, 64);
    $this->companywebsiteInput->DataBinding = new Amhsoft_Data_Binding('company_website');
    $this->firstnameInput = new Amhsoft_Input_Control('firstname', _t('Name'), null, 54);
    $this->firstnameInput->DataBinding = new Amhsoft_Data_Binding('firstname');
    $this->firstnameInput->Required = true;
    $this->phoneInput = new Amhsoft_Input_Control('phone', _t('Phone'));
    $this->phoneInput->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->faxInput = new Amhsoft_Input_Control('fax', _t('Fax'));
    $this->faxInput->DataBinding = new Amhsoft_Data_Binding('fax');
    $this->emailInput = new Amhsoft_Input_Control('email', _t('Email'), null, 64);
    $this->emailInput->DataBinding = new Amhsoft_Data_Binding('email');
    $this->emailInput->Required = true;
    $this->emailInput->addValidator('Email');
    $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
    $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->accountListBox = new Amhsoft_ListBox_Control('account_id', _t('Account'));
    $this->accountListBox->WithNullOption = True;
    $this->accountListBox->DataBinding = new Amhsoft_Data_Binding('account_id', 'id', 'name');
    $this->accountListBox->DataSource = Amhsoft_Data_Source::Table('account');
    $this->accountListBox = new Amhsoft_DirectoryInput_Control('account', _t('Account'));
    $this->accountListBox->DataBinding = new Amhsoft_Data_Binding('account', 'id', 'account_id');
    $this->groupListBox = new Amhsoft_ListBox_Control('lead_group_id', _t('Lead Group'));
    $this->groupListBox->DataBinding = new Amhsoft_Data_Binding('lead_group_id', 'id', 'name');
    $this->groupListBox->DataSource = Amhsoft_Data_Source::Table('lead_group');
    $this->groupListBox->WithNullOption = true;
    $this->sourceListBox = new Amhsoft_ListBox_Control('lead_source_id', _t('Source'));
    $this->sourceListBox->DataBinding = new Amhsoft_Data_Binding('lead_source_id', 'id', 'name');
    $this->sourceListBox->DataSource = New Amhsoft_Data_Set(new Crm_Lead_Source_Model_Adapter());
    $this->sourceListBox->WithNullOption = TRUE;
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->numberInput);
    $generalPanel->addComponent($this->compnayInput);
    $generalPanel->addComponent($this->companywebsiteInput);
    $generalPanel->addComponent($this->firstnameInput);
    $generalPanel->addComponent($this->phoneInput);
    $generalPanel->addComponent($this->mobileInput);
    $generalPanel->addComponent($this->faxInput);
    $generalPanel->addComponent($this->emailInput);
    $generalPanel->addComponent($this->groupListBox);
    $generalPanel->addComponent($this->sourceListBox);
    $this->addComponent($generalPanel);
    $noticesPanel = new Amhsoft_Widget_Panel(_t('Notices'));
    $this->noticeInput = new Amhsoft_TextArea_Control('notice', _t('Notice'));
    $this->noticeInput->DataBinding = new Amhsoft_Data_Binding('notice');
    $noticesPanel->addComponent($this->noticeInput);
    $this->addComponent($noticesPanel);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
