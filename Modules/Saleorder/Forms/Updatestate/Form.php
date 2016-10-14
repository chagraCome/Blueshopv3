<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Updatestate_Form extends Amhsoft_Widget_Form {

    public $from_email;
    public $to_emails;
    public $cc_emails;
    public $bcc_emails;
    public $subject;
    public $content;

    /** @var Amhsoft_Input_Control $saleOrderStateInput * */
    public $saleOrderStateInput;
    public $submitButton;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $statePanel = new Amhsoft_Widget_Panel(_t('Sales Order'));

        $this->saleOrderStateInput = new Amhsoft_ListBox_Control('sale_order_state_id', _t('Sales Order State'));
        $this->saleOrderStateInput->DataBinding = new Amhsoft_Data_Binding('sale_order_state_id', 'id', 'name');
        $this->saleOrderStateInput->DataSource = new Amhsoft_Data_Set(new Saleorder_State_Model_Adapter());
        $this->saleOrderStateInput->Required = true;
        $statePanel->addComponent($this->saleOrderStateInput);
        $this->addComponent($statePanel);
        $this->templateDirectoryInput = new Amhsoft_DirectoryInput_Control('emailtemplate', _t('Select from template'));
        $this->templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist&target=saleorder&target_id=' . Amhsoft_Web_Request::getId();
        $this->templateDirectoryInput->OnlyIcon = true;

        $panel = new Amhsoft_Widget_Panel('Header');
        $fromDataSource = array();
        if (Amhsoft_System_Module_Manager::isModuleInstalled('Webmail')) {
            $webmailSettingAdapter = new Webmail_Setting_Model_Adapter();
            $webmailSettingAdapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
            $result = $webmailSettingAdapter->fetch();
            foreach ($result as $r) {
                $fromDataSource[] = array('id' => $r->getId(), 'name' => $r->getName() . '<' . $r->getEmail() . '>');
            }
        }

        $panelContent = new Amhsoft_Widget_Panel(_t('Email Content'));
        $panelSubject = new Amhsoft_Widget_Panel(_t('Subject'));
        $panelSubject->setLayout(new Amhsoft_Grid_Layout(2, Amhsoft_Abstract_Layout::APPEND));
        $this->subject = new Amhsoft_Input_Control('subject', _t('Subject'));
        $this->subject->DataBinding = new Amhsoft_Data_Binding('subject');
        $this->subject->setWidth(400);
        $panelSubject->addComponent($this->subject);
        $panelSubject->addComponent($this->templateDirectoryInput);
        $this->addComponent($panelSubject);
        $this->content = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
        $this->content->DataBinding = new Amhsoft_Data_Binding('content');
        $panelContent->addComponent($this->content);
        $this->addComponent($panelContent);
        $panelNotifications = new Amhsoft_Widget_Panel(_t('Notifications'));
        $notifyCheckBox = new Amhsoft_CheckBox_Control('notify', _t('Notify Customer'), 1);
        $panelNotifications->addComponent($notifyCheckBox);
        $this->addComponent($panelNotifications);
        $panelAction = new Amhsoft_Widget_Panel(_t('Navigation'));
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
        $this->submitButton->Class = "ButtonSave";
        $panelAction->addComponent($this->submitButton);
        $this->addComponent($panelAction);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>