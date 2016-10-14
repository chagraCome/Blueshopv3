<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Setting_Form extends Amhsoft_Widget_Form {

    public $name;
    public $email;
    public $password;
    public $type;
    public $host;
    public $port;
    public $encryption;
    public $cert;
    public $global;
    public $signature;
    public $submitButton;

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
        $this->name = new Amhsoft_Input_Control('name', _t('Name'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('name');
        $this->name->Required = true;
        $this->email = new Amhsoft_Input_Control('email', _t('Email'));
        $this->email->DataBinding = new Amhsoft_Data_Binding('email');
        $this->email->Required = true;
        $this->password = new Amhsoft_Password_Control('password', _t('Password'));
        $this->password->DataBinding = new Amhsoft_Data_Binding('password');
        $this->password->Required = true;
        $this->type = new Amhsoft_ListBox_Control('type', _t('Type'));
        $typeSource = array(Webmail_Setting_Model::OUTGOING/*, Webmail_Setting_Model::INCOMING*/);
        $this->type->DataBinding = new Amhsoft_Data_Binding('type');
        $this->type->DataSource = new Amhsoft_Data_Set($typeSource);
        $this->type->Required = true;
        $this->type->ToolTip = _t('Server Type : smtp');
        $this->host = new Amhsoft_Input_Control('host', _t('Host'));
        $this->host->DataBinding = new Amhsoft_Data_Binding('host');
        $this->host->Required = true;
        $this->port = new Amhsoft_Input_Control('port', _t('Port'));
        $this->port->DataBinding = new Amhsoft_Data_Binding('port');
        $this->port->DefaultValue = '25';
        $this->port->Required = true;
        $this->port->ToolTip = _t('Default port : 25');
        $this->encryption = new Amhsoft_ListBox_Control('encryption', _t('Encryption'));
        $this->encryption->DataBinding = new Amhsoft_Data_Binding('encryption', 'value', 'label');
        $encryptionSource = array(
            array('value' => '', 'label' => _t('No Encryption')),
            array('value' => 'ssl', 'label' => _t('SSL')),
            array('value' => 'tls', 'label' => _t('TLS')),
        );
        $this->encryption->DataSource = new Amhsoft_Data_Set($encryptionSource);
        $this->encryption->ToolTip = _t('Encryption : if you use ssl note to change port to 993');
        $this->encryption->Required = false;
        $this->cert = new Amhsoft_ListBox_Control('cert', _t('Cert'));
        $this->cert->DataBinding = new Amhsoft_Data_Binding('cert', 'value', 'label');
        $this->cert->ToolTip = _t('Certificate : use \'validate-cert\' if you have a valid Certificate');
        $certSource = array(
            array('value' => 'novalidate-cert', 'label' => _t('Certificate is not valid')),
            array('value' => 'validate-cert', 'label' => _t('Certificate is valid')),
        );
        $this->cert->DataSource = new Amhsoft_Data_Set($certSource);
        $this->cert->Required = false;
        $this->cert->WithNullOption = true;
        $this->global = new Amhsoft_YesNo_ListBox_Control('global', _t('Global'), 'global', 1);
        $this->signature = new Amhsoft_TextArea_Wysiwyg_Control('signature', _t('Signature'));
        $this->signature->DataBinding = new Amhsoft_Data_Binding('signature');
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
        $this->submitButton->Class = "ButtonSave";
        $panel = new Amhsoft_Widget_Panel(_t('Authentication Information'));
        $panel->addComponent($this->name);
        $panel->addComponent($this->email);
        $panel->addComponent($this->password);
        $serverPanel = new Amhsoft_Widget_Panel(_t('Server Informations'));
        $serverPanel->addComponent($this->global);
        $serverPanel->addComponent($this->type);
        $serverPanel->addComponent($this->host);
        $serverPanel->addComponent($this->port);
        $serverPanel->addComponent($this->encryption);
        $serverPanel->addComponent($this->cert);
        $serverPanel->addComponent($this->signature);
        $this->addComponent($panel);
        $this->addComponent($serverPanel);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
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