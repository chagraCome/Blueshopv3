<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Contactsetting.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

/**
 * Description of setting
 *
 * @author Montasser
 */
class Crm_Backend_Contactsetting_Controller extends Amhsoft_System_Web_Controller {

  protected $mainPanel;
  protected $conactRecordNumberingForm;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('CRM Settings'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->loadContactRecordNumberingForm();
    $this->getSettingForm();
  }

  protected function generateContactEmailTemplate() {
    $panel = new Amhsoft_Widget_Panel(_t('Manage Contact Notifications Templates'));
    $dataGridView = new Setting_Template_Email_DataGridView();
    $modelAdapter = new Setting_Template_Email_Model_Adapter();
    $modelAdapter->where('id = ' . Crm_Notification_Contact_Model::CONTACT_US_AUTO_REPLY);
    $dataGridView->setSearchable(false);
    $dataGridView->setSortable(false);
    $dataGridView->DataSource = new Amhsoft_Data_Set($modelAdapter);
    $dataGridView->removeByIdentName("delCol");
    $panel->addComponent($dataGridView);
    return $panel;
  }

  protected function getSettingForm() {
    $form = new Amhsoft_Widget_Form('settings', 'POST');
    $contactSetting = new Amhsoft_Widget_Panel(_t('Contact Notification Settings'));
    $form->addComponent($this->generateContactEmailTemplate());
    $contactConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $panel3 = new Amhsoft_Widget_Panel(_t('Navigation'));
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $submitButton->setClass('ButtonSave');
    $panel3->addComponent($submitButton);
    $form->addComponent($contactSetting);
    $form->addComponent($panel3);
    $this->mainPanel->addComponent($form);
    if ($this->getRequest()->isPost('contact_record_submit')) {
      if ($this->conactRecordNumberingForm->isFormValid()) {
	$values = $this->conactRecordNumberingForm->getValues();
	$contactConfiguration->setValue('contact_prefix', $values['contact_prefix']);
	$contactConfiguration->setValue('contact_start', $values['contact_start']);
	$this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
      }
    }
    if ($this->getRequest()->isPost('submit')) {
      $form->DataSource = Amhsoft_Data_Source::Post();
      $values = $form->getValues();
      foreach ($values as $key => $val) {
	$contactConfiguration->setValue($key, $val);
      }
      $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
    }
    $this->conactRecordNumberingForm->DataSource = new Amhsoft_Data_Set($contactConfiguration->getConfiguration());
    $this->conactRecordNumberingForm->Bind();
  }

  protected function loadContactRecordNumberingForm() {
    $panel = new Amhsoft_Widget_Panel(_t('Contact Record Numbering'));
    $prefixInput = new Amhsoft_Input_Control('contact_prefix', _t('Prefix'));
    $prefixInput->ToolTip = _t('Like: C');
    $prefixInput->setWidth(60);
    $prefixInput->DataBinding = new Amhsoft_Data_Binding('contact_prefix');
    $prefixInput->Required = true;
    $prefixInput->DefaultValue = 'C';
    $startInput = new Amhsoft_Input_Control('contact_start', _t('Start Record'));
    $startInput->DataBinding = new Amhsoft_Data_Binding('contact_start');
    $startInput->Required = true;
    $startInput->DefaultValue = 1;
    $submit = new Amhsoft_Button_Submit_Control('contact_record_submit', _t('Save'));
    $panel->addComponent($prefixInput);
    $panel->addComponent($startInput);
    $panel->addComponent($submit);
    $this->conactRecordNumberingForm = new Amhsoft_Widget_Form('contact_record_numbering_form', 'POST');
    $this->conactRecordNumberingForm->addComponent($panel);
    $this->mainPanel->addComponent($this->conactRecordNumberingForm);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show('');
  }

}

?>
