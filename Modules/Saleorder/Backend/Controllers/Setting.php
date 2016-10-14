<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    protected $mainPanel;
    protected $recordNumberingForm;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $layout = new Amhsoft_Grid_Layout(2);
        $this->getView()->setMessage(_t('Sales Order Settings'), View_Message_Type::INFO);
    }

    public function loadSaleOrderStateGrid() {
        $panel2 = new Amhsoft_Widget_Panel(_t('Sales Order State'));
        $saleOrderStateDataGridView = new Saleorder_State_DataGridView();
        $saleOrderStateDataGridView->DataSource = new Amhsoft_Data_Set(new Saleorder_State_Model_Adapter());
        $saleOrderStateDataGridView->removeByIdentName("delete");
        $panel2->addComponent($saleOrderStateDataGridView);
        $this->mainPanel->addComponent($panel2);
    }

    protected function loadRecordNumberingForm() {
        $panel = new Amhsoft_Widget_Panel(_t('Record Numbering'));
        $prefixInput = new Amhsoft_Input_Control('prefix', _t('Prefix'));
        $prefixInput->ToolTip = _t('Like: SO');
        $prefixInput->setWidth(60);
        $prefixInput->DataBinding = new Amhsoft_Data_Binding('prefix');
        $prefixInput->Required = true;
        $prefixInput->DefaultValue = 'SO';

        $startInput = new Amhsoft_Input_Control('start', _t('Start Record'));
        $startInput->DataBinding = new Amhsoft_Data_Binding('start');
        $startInput->Required = true;
        $startInput->DefaultValue = 1;

        $submit = new Amhsoft_Button_Submit_Control('record_submit', _t('Save'));


        $panel->addComponent($prefixInput);
        $panel->addComponent($startInput);
        $panel->addComponent($submit);
        $this->recordNumberingForm = new Amhsoft_Widget_Form('record_numbering_form', 'POST');
        $this->recordNumberingForm->addComponent($panel);
        $this->mainPanel->addComponent($this->recordNumberingForm);
    }
protected function generateSaleorderEmailForm() {
   $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $panel2 = new Amhsoft_Widget_Panel(_t('Manage Notifications Emails'));
        $form = new Amhsoft_Widget_Form('settings', 'POST');


        $useEmailOnRegistration = new Amhsoft_ListBox_Control(Saleorder_Model::NOTIFICATION_EMAIL_FROM, _t('Use this email to send notifications'));
        $useEmailOnRegistration->DataBinding = new Amhsoft_Data_Binding(Saleorder_Model::NOTIFICATION_EMAIL_FROM, 'id', 'email', $saleOrderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM));
        $adapter = new Webmail_Setting_Model_Adapter();
        $adapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
        $useEmailOnRegistration->DataSource = new Amhsoft_Data_Set($adapter);
        $useEmailOnRegistration->setWidth(250);
	
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $submitButton->setClass('ButtonSave');

        $form->addComponent($useEmailOnRegistration);
        $form->addComponent($submitButton);
	
        $panel2->addComponent($form);
        $this->mainPanel->addComponent($panel2);
	if ($this->getRequest()->isPost('submit')) {
            $form->DataSource = Amhsoft_Data_Source::Post();
            $values = $form->getValues();
            foreach ($values as $key => $val) {
                $saleOrderConfiguration->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }

        $form->DataSource = new Amhsoft_Data_Set($saleOrderConfiguration->getConfiguration());
        $form->Bind();
}
    protected function generateSaleorderEmailTemplate() {
       
        $panel = new Amhsoft_Widget_Panel(_t('Sales Order Notification Settings'));

        $dataGridView = new Setting_Template_Email_DataGridView();
        $modelAdapter = new Setting_Template_Email_Model_Adapter();
        $modelAdapter->where('id IN(13,12,16,17,19,20)');
        $dataGridView->setSearchable(false);
        $dataGridView->setSortable(false);

        $dataGridView->DataSource = new Amhsoft_Data_Set($modelAdapter);
        $dataGridView->removeByIdentName("delCol");
        $panel->addComponent($dataGridView);
	//$this->mainPanel->addComponent($panel);

        return $panel;
    }

    protected function generateSaleorderPrintTemplate() {
        $panel3 = new Amhsoft_Widget_Panel(_t('Sales Order Prints Settings'));
        $dataGridView = new Setting_Template_Print_DataGridView();
        $modelAdapter = new Setting_Template_Print_Model_Adapter();
        $modelAdapter->where('id = 1');
        $dataGridView->setSearchable(false);
        $dataGridView->setSortable(false);

        $dataGridView->DataSource = new Amhsoft_Data_Set($modelAdapter);
        $dataGridView->removeByIdentName("delCol");
        $panel3->addComponent($dataGridView);

        return $panel3;
    }

    protected function getSetupForm() {

        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);


        $form = new Amhsoft_Widget_Form('setup_form', 'POST');

        $form->addComponent($this->generateSaleorderEmailTemplate());
        $form->addComponent($this->generateSaleorderPrintTemplate());

        $panel3 = new Amhsoft_Widget_Panel(_t('Action'));

        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));

        $submitButton->setClass('ButtonSave');
        $panel3->addComponent($submitButton);


        $form->addComponent($panel3);

        $this->mainPanel->addComponent($form);
        if ($this->getRequest()->isPost('submit')) {
            $form->DataSource = Amhsoft_Data_Source::Post();
            $values = $form->getValues();
            foreach ($values as $key => $val) {
                $saleOrderConfiguration->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }

        $form->DataSource = new Amhsoft_Data_Set($saleOrderConfiguration->getConfiguration());
        $form->Bind();
    }

    /**
     * Default event
     */
    public function __default() {
        $this->loadRecordNumberingForm();
        $this->loadSaleOrderStateGrid();
	$this->generateSaleorderEmailForm();
        $this->generateSaleorderPrintTemplate();
        $this->getSetupForm();
	


        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');

        if ($this->getRequest()->isPost('record_submit')) {
            if ($this->recordNumberingForm->isFormValid()) {
                $values = $this->recordNumberingForm->getValues();
                $saleOrderConfiguration->setValue('prefix', $values['prefix']);
                $saleOrderConfiguration->setValue('start', $values['start']);
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            }
        }

        $this->recordNumberingForm->DataSource = new Amhsoft_Data_Set($saleOrderConfiguration->getConfiguration());
        $this->recordNumberingForm->Bind();
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->mainPanel);
        $this->show();
    }

}

?>
