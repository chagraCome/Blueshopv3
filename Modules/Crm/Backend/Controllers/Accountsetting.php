<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Accountsetting.php 383 2016-02-10 14:43:34Z montassar.amhsoft $
 * $Rev: 383 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-10 15:43:34 +0100 (mer., 10 févr. 2016) $
 * $Author: montassar.amhsoft $
 */

/**
 * Description of setting
 *
 * @author Montasser
 */
class Crm_Backend_Accountsetting_Controller extends Amhsoft_System_Web_Controller {

    protected $mainPanel;
    protected $accountSettingsForm;
    protected $accountConfiguration;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $this->getView()->setMessage(_t('CRM Settings'), View_Message_Type::INFO);
        $this->accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $this->accountSettingsForm = new Amhsoft_Widget_Form('account_record_numbering_form', 'POST');
        $this->loadAccountRecordNumberingForm();
        $this->loadFacebookSettings();
        $this->generateAccountEmailFrom();
        $this->generateAccountEmailTemplate();
        $panel = new Amhsoft_Widget_Panel(_t('Action'));
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $panel->addComponent($submitButton);
        $this->accountSettingsForm->addComponent($panel);
    }

    /**
     * Default event
     */
    public function __default() {


        if ($this->getRequest()->isPost('submit')) {
            $values = $this->accountSettingsForm->getValues();
            foreach ($values as $key => $val) {
                $this->accountConfiguration->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }

        $this->accountSettingsForm->DataSource = new Amhsoft_Data_Set($this->accountConfiguration->getConfiguration());
        $this->accountSettingsForm->Bind();
    }

    protected function generateAccountEmailFrom() {

        $panel2 = new Amhsoft_Widget_Panel(_t('Manage Notifications Emails'));
        $useEmailOnRegistration = new Amhsoft_ListBox_Control(Crm_Account_Model::FROM_EMAIL, _t('Use this email to send notifications'));
        $useEmailOnRegistration->DataBinding = new Amhsoft_Data_Binding(Crm_Account_Model::FROM_EMAIL, 'id', 'email', $this->accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL));
        $adapter = new Webmail_Setting_Model_Adapter();
        $adapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
        $useEmailOnRegistration->DataSource = new Amhsoft_Data_Set($adapter);
        $useEmailOnRegistration->setWidth(250);
        $panel2->addComponent($useEmailOnRegistration);
        $this->accountSettingsForm->addComponent($panel2);
    }

    protected function generateAccountEmailTemplate() {
        $panel = new Amhsoft_Widget_Panel(_t('Manage Account Notifications Templates'));
        $dataGridView = new Setting_Template_Email_DataGridView();
        $modelAdapter = new Setting_Template_Email_Model_Adapter();
        $in = Crm_Notification_Account_Model::WELCOME_EMAIl_TEMPLATE . ',' . Crm_Notification_Account_Model::RESET_PASSWORD_EMAIL_TEMPLATE . ',' . Crm_Notification_Account_Model::ACCOUNT_REGISTRED_EMAIL_TEMPLATE;
        $modelAdapter->where('id IN(' . $in . ')');
        $dataGridView->setSearchable(false);
        $dataGridView->setSortable(false);
        $dataGridView->setWithPagination(false);
        $dataGridView->DataSource = new Amhsoft_Data_Set($modelAdapter);
        $dataGridView->removeByIdentName("delCol");
        $panel->addComponent($dataGridView);
        $this->accountSettingsForm->addComponent($panel);
    }

    protected function loadFacebookSettings() {
        $panel = new Amhsoft_Widget_Panel(_t('Facebook Settings'));

        $facebookState = new Amhsoft_YesNo_ListBox_Control('facebook_login_state', _t('Enable Login/Register with facebook'), 'facebook_login_state');

        $appID = new Amhsoft_Input_Control('facebook_app_id', _t('Facebook APP Id'));
        $appID->DataBinding = new Amhsoft_Data_Binding('facebook_app_id');
        $appID->Required = false;

        $secretKey = new Amhsoft_Input_Control('facebook_secret_key', _t('Facebook Secret Key'));
        $secretKey->DataBinding = new Amhsoft_Data_Binding('facebook_secret_key');
        $secretKey->Required = false;




        $panel->addComponent($facebookState);
        $panel->addComponent($appID);
        $panel->addComponent($secretKey);

        $this->accountSettingsForm->addComponent($panel);
    }

    protected function loadAccountRecordNumberingForm() {
        $panel = new Amhsoft_Widget_Panel(_t('Account Record Numbering'));
        $prefixInput = new Amhsoft_Input_Control('account_prefix', _t('Prefix'));
        $prefixInput->ToolTip = _t('Like: A');
        $prefixInput->setWidth(60);
        $prefixInput->DataBinding = new Amhsoft_Data_Binding('account_prefix');
        $prefixInput->Required = true;
        $prefixInput->DefaultValue = 'A';
        $startInput = new Amhsoft_Input_Control('account_start', _t('Start Record'));
        $startInput->DataBinding = new Amhsoft_Data_Binding('account_start');
        $startInput->Required = true;
        $startInput->DefaultValue = 1;

        $panel->addComponent($prefixInput);
        $panel->addComponent($startInput);
        $this->accountSettingsForm->addComponent($panel);

        $this->mainPanel->addComponent($this->accountSettingsForm);
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
