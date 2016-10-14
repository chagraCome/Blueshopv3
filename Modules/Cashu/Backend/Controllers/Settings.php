<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Settings.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cashu
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cashu_Backend_Settings_Controller extends Amhsoft_System_Web_Controller {

  public $panel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->panel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Manage Cashu Settings'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->getSetupForm();
  }

  /**
   * Setup Form
   */
  protected function getSetupForm() {
    $cashuConfiguration = new Amhsoft_Config_Table_Adapter('cashu');
    $form = new Amhsoft_Widget_Form('setup_form', 'POST');
    $businessEmail = new Amhsoft_Input_Control('cashuid', _t('Cashu ID'));
    $businessEmail->DataBinding = new Amhsoft_Data_Binding('cashuid', $cashuConfiguration->getValue('cashuid'));
    $businessEmail->Required = true;
    $encryptionKeyword = new Amhsoft_Input_Control('encryption_keyword', _t('Encryption Keyword'));
    $encryptionKeyword->DataBinding = new Amhsoft_Data_Binding('encryption_keyword');
    $encryptionKeyword->Required = true;
    $testModeListBox = new Amhsoft_YesNo_ListBox_Control('test_mode', _t('Test Mode'), 'test_mode', 1);
    $currencyListBox = new Amhsoft_ListBox_Control('cashu_currency', _t('Currency'));
    $currencyListBox->DataBinding = new Amhsoft_Data_Binding('cashu_currency', $cashuConfiguration->getValue('cashu_currency'));
    $array = array('USD', 'EUR');
    $currencyListBox->DataSource = new Amhsoft_Data_Set($array);
    $currencyListBox->Required = true;
    $cashuLanguage = new Amhsoft_ListBox_Control("cashu_language", _t('Language'));
    $cashuLanguage->Required = true;
    $cashuLanguage->DataBinding = new Amhsoft_Data_Binding("cashu_language", 'id', 'text');
    $array = array(
	array('id' => 'ar', 'text' => 'Arabic'),
	array('id' => 'en', 'text' => 'English'),
    );
    $cashuLanguage->DataSource = new Amhsoft_Data_Set($array);
    $panelGeneralInformation = new Amhsoft_Widget_Panel(_t('Login Informations'));
    $panelGeneralInformation->addComponent($businessEmail);
    $panelGeneralInformation->addComponent($encryptionKeyword);
    $form->addComponent($panelGeneralInformation);
    $panel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $panel->addComponent($testModeListBox);
    $panel->addComponent($currencyListBox);
    $panel->addComponent($cashuLanguage);
    $form->addComponent($panel);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $submitButton->setClass('Button Save');
    $navigationPanel->addComponent($submitButton);
    $form->addComponent($navigationPanel);
    $this->panel->addComponent($form);
    if ($this->getRequest()->isPost('submit')) {
      if ($form->isFormValid()) {
	$values = $form->getValues();
	foreach ($values as $key => $val) {
	  $cashuConfiguration->setValue($key, $val);
	}
      }
      $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
    }
    $form->DataSource = new Amhsoft_Data_Set($cashuConfiguration->getConfiguration());
    $form->Bind();
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->panel);
    $this->show();
  }

}

?>
