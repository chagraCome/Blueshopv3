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
class Saleorder_Form extends Amhsoft_Widget_Form {

    /** @var Amhsoft_Input_Control $nameInput * */
    public $nameInput;

    /** @var Amhsoft_Input_Control $numberInput * */
    public $numberInput;

    /** @var Amhsoft_Input_Control $priceInput * */
    public $priceInput;

    /** @var Amhsoft_TextArea_Control $paymentLogTextArea * */
    public $paymentLogTextArea;

    /** @var Amhsoft_ListBox_Control $saleOrderDiscountTypeListBox * */
    public $saleOrderDiscountTypeListBox;

    /** @var Amhsoft_ListBox_Control $userListBox * */
    public $userListBox;

    /** @var Amhsoft_ListBox_Control $personListBox * */
    public $personListBox;

    /** @var Amhsoft_ListBox_Control $personNameInput * */
    public $personNameInput;

    /** @var Amhsoft_Input_Control $creatorNameInput * */
    public $creatorNameInput;

    /** @var Amhsoft_Input_Control $paymentMethodNameInput * */
    public $paymentMethodNameInput;

    /** @var Amhsoft_ListBox_Control $shippingMethodNameListBox * */
    public $shippingMethodNameListBox;

    /** @var Amhsoft_Date_Input_Control $dueDate * */
    public $dueDate;

    /** @var Amhsoft_TextArea_Control $descriptionTextArea * */
    public $descriptionTextArea;

    /** @var Amhsoft_ListBox_Control $paymentListBox * */
    public $paymentListBox;

    /** @var Amhsoft_Date_Input_Control $insertAtDateControl * */
    public $insertAtDateControl;

    /** @var HiddenInput $updateInput * */
    public $updateInput;

    /** @var Amhsoft_Input_Control $saleOrderStateInput * */
    public $saleOrderStateInput;

    /** @var Amhsoft_Input_Control $discountInput * */
    public $discountInput;

    /** @var Amhsoft_TextArea_Control $policyTextArea * */
    public $policyTextArea;
    public $submitButton;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Subject'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->setWidth("300");
        $this->nameInput->Required = true;

        $this->numberInput = new Amhsoft_Input_Control('number', _t('Sales Order No.'));
        $this->numberInput->DataBinding = new Amhsoft_Data_Binding('number');
        $this->numberInput->Required = true;

        $this->paymentLogTextArea = new Amhsoft_TextArea_Control('payment_log', _t('Payment Log'));
        $this->paymentLogTextArea->DataBinding = new Amhsoft_Data_Binding('payment_log');

        $this->userListBox = new Amhsoft_ListBox_Control('user_id', _t('Assigned To'));
        $this->userListBox->DataBinding = new Amhsoft_Data_Binding('user_id', 'id', 'username', Amhsoft_Authentication::getInstance()->getObject()->id);
        $this->userListBox->DataSource = Amhsoft_Data_Source::Table('user');

        $this->personListBox = new Amhsoft_DirectoryInput_Control('account', _t('Account'));
        $this->personListBox->DataBinding = new Amhsoft_Data_Binding('account', 'id', 'account_id');
        $this->personListBox->PopUpUrl = 'admin.php?module=crm&page=account-quicklist';
        $this->personListBox->AddPopUpUrl = 'admin.php?module=crm&page=account-quickadd';

        $this->shippingMethodNameListBox = new Amhsoft_ListBox_Control('shipping_id', _t('Shipping Method'));
        $this->shippingMethodNameListBox->DataBinding = new Amhsoft_Data_Binding('shipping_id', 'id', 'title');
        $this->shippingMethodNameListBox->DataSource = new Amhsoft_Data_Set(new Shipping_Shipping_Model_Adapter());
        $this->shippingMethodNameListBox->Required = true;

        $this->discountInput = new Amhsoft_Input_Control('discount', _t('Discount'));
        $this->discountInput->DataBinding = new Amhsoft_Data_Binding('discount');
        $this->discountInput->ToolTip = _t("Like 30% or 30 (Fixed or percent)");

        $this->dueDate = new Amhsoft_Date_Input_Control('due_date', _t('Due Date'));
        $this->dueDate->DataBinding = new Amhsoft_Data_Binding('due_date');

        $this->descriptionTextArea = new Amhsoft_TextArea_Control('description', _t('Descrtiption'));
        $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');

        $this->paymentListBox = new Amhsoft_ListBox_Control('payment_id', _t('Payment Method'));
        $this->paymentListBox->DataBinding = new Amhsoft_Data_Binding('payment_id', 'id', 'name');
        $this->paymentListBox->DataSource = new Amhsoft_Data_Set(new Payment_Payment_Model_Adapter());
        $this->paymentListBox->Required = true;


        $this->policyTextArea = new Amhsoft_TextArea_Control('policy', _t('Policy'));
        $this->policyTextArea->DataBinding = new Amhsoft_Data_Binding('policy');

        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $informationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
        $informationPanel->addComponent($this->numberInput);
        $informationPanel->addComponent($this->nameInput);
        $informationPanel->addComponent($this->userListBox);
        $informationPanel->addComponent($this->personListBox);
        $informationPanel->addComponent($this->dueDate);
        $informationPanel->addComponent($this->paymentListBox);
        $informationPanel->addComponent($this->shippingMethodNameListBox);
        $descriptionPanel = new Amhsoft_Widget_Panel(_t('Descriptions'));
        $descriptionPanel->addComponent($this->descriptionTextArea);
        $descriptionPanel->addComponent($this->policyTextArea);
        $pricesPanel = new Amhsoft_Widget_Panel(_t('Discount Informations'));
        $pricesPanel->addComponent($this->discountInput);
        $this->addComponent($informationPanel);
        $this->addComponent($pricesPanel);
        $this->addComponent($descriptionPanel);
        $this->addComponent($this->submitButton);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
