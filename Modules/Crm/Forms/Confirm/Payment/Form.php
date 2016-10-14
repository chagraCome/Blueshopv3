<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 231 2016-02-01 12:37:46Z imen.amhsoft $
 * $Rev: 231 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-01 13:37:46 +0100 (lun., 01 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Confirm_Payment_Form extends Amhsoft_Widget_Form {

    /** @var Amhsoft_Input_Control $nameInput * */
    public $nameInput;

    /** @var Amhsoft_Input_Control $emailInput * */
    public $emailInput;

    /** @var Amhsoft_Input_Control $mobileInput * */
    public $mobileInput;

    /** @var Amhsoft_Input_Control $paymentMethodName * */
    public $paymentMethodName;

    /** @var Amhsoft_Date_Time_Input_Control $paymentDateTime * */
    public $paymentDateTime;

    /** @var Amhsoft_Input_Control $bankAccountNumberInput * */
    public $bankAccountNumberInput;

    /** @var Amhsoft_Input_Control $amountInput * */
    public $amountInput;

    /** @var Amhsoft_ListBox_Control $bankListBox * */
    public $bankListBox;

    /** @var Amhsoft_Input_Control $transfertIdInput * */
    public $transfertIdInput;

    /** @var Amhsoft_TextArea_Control $descriptionTextArea * */
    public $descriptionTextArea;
    public $paymentLogo;
    public $submitbutton;
    public $captcha;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;
        $this->nameInput->setWidth(250);

        $this->emailInput = new Amhsoft_Input_Control('email', _t('Email'));
        $this->emailInput->DataBinding = new Amhsoft_Data_Binding('email');
        $this->emailInput->Required = true;
        $this->emailInput->setWidth(250);

        $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
        $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
        $this->mobileInput->Required = true;
        $this->mobileInput->setWidth(250);

        $this->paymentMethodName = new Amhsoft_Input_Control('paymentMethod', _t('Payment Method'));
        $this->paymentMethodName->DataBinding = new Amhsoft_Data_Binding('paymentMethod');
        $this->paymentMethodName->setWidth(250);

        $this->paymentDateTime = new Amhsoft_Date_Time_Input_Control('paymentMethodDateTime', _t('Payment Date Time'));
        $this->paymentDateTime->DataBinding = new Amhsoft_Data_Binding('paymentMethodDateTime');
        $this->paymentDateTime->Required = true;
        $this->paymentDateTime->setWidth(250);
        
        $this->bankAccountNumberInput = new Amhsoft_Input_Control("bank_account", _t('Bank Account Number'));
        $this->bankAccountNumberInput->DataBinding = new Amhsoft_Data_Binding('bank_account');
        $this->bankAccountNumberInput->Required = true;
        $this->bankAccountNumberInput->setWidth(250);
        
        $this->bankListBox = new Amhsoft_ListBox_Control('payment_id', _t('Bank'));
        $this->bankListBox->DataBinding = new Amhsoft_Data_Binding('payment_id', 'id', 'name');
        $this->bankListBox->DataSource = new Amhsoft_Data_Set(new Payment_Payment_Model_Adapter());
        $this->bankListBox->WithNullOption = true;
        $this->bankListBox->setWidth(300);

        $this->amountInput = new Amhsoft_Currency_Input_Control('amount', _t('Transferred Amount'));
        $this->amountInput->DataBinding = new Amhsoft_Data_Binding('amount');
        $this->amountInput->Required = true;
        $this->amountInput->setWidth(250);

        $this->transfertIdInput = new Amhsoft_Input_Control('transfer_id', _t('Bank Transaction Id.'));
        $this->transfertIdInput->DataBinding = new Amhsoft_Data_Binding('transfer_id');
        $this->transfertIdInput->setWidth(250);

        $this->descriptionTextArea = new Amhsoft_TextArea_Control('description', _t('Description'));
        $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');

        $this->paymentLogo = new Amhsoft_ImageControl_Control('paymentLogo');
        $fileUpload = new Amhsoft_FileInput_Control('logo', _t('Upload'), _t('Upload'));
        $this->paymentLogo->setUploadControl($fileUpload);
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
        $fileUpload->addValidator($ImageValidator);
        $this->paymentLogo->setWidth(200);
        $this->paymentLogo->DataBinding = new Amhsoft_Data_Binding('paymentLogo');

        $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
        $this->captcha->setRequired(true);
        $this->captcha->setClass('captcha');


        $this->submitbutton = new Amhsoft_Button_Submit_Control('submit', _t('Save!'));


        $this->addComponent($this->nameInput);
        $this->addComponent($this->emailInput);
        $this->addComponent($this->mobileInput);
        $this->addComponent($this->bankListBox);
        $this->addComponent($this->bankAccountNumberInput);
        $this->addComponent($this->paymentMethodName);
        $this->addComponent($this->amountInput);
        $this->addComponent($this->transfertIdInput);
        $this->addComponent($this->paymentDateTime);
        $this->addComponent($this->descriptionTextArea);
        $this->addComponent($this->paymentLogo);
        $this->addComponent($this->captcha);
        $this->addComponent($this->submitbutton);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
