<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Settings.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Paypal
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Paypal_Backend_Settings_Controller extends Amhsoft_System_Web_Controller {

    public $panel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->panel = new Amhsoft_Widget_Panel(_t('Paypal Settings'));
        $this->getView()->setMessage(_t('Manage Paypal Settings'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getSetupForm();
    }

    protected function getSetupForm() {


        $paypalConfiguration = new Amhsoft_Config_Table_Adapter('paypal');


        $form = new Amhsoft_Widget_Form('setup_form', 'POST');

        $businessEmail = new Amhsoft_Input_Control('business', _t('Business Email'));
        $businessEmail->DataBinding = new Amhsoft_Data_Binding('business', $paypalConfiguration->getValue('business'));
        $businessEmail->addValidator('Email');
        $businessEmail->Required = true;
        $form->addComponent($businessEmail);


        $testModeListBox = new Amhsoft_YesNo_ListBox_Control('test_mode', _t('Test Mode'), 'test_mode', 1);
        $form->addComponent($testModeListBox);


        $currencyListBox = new Amhsoft_ListBox_Control('paypal_currency', _t('Currency'));
        $currencyListBox->DataBinding = new Amhsoft_Data_Binding('paypal_currency', $paypalConfiguration->getValue('paypal_currency'));
        $array = array('USD', 'EUR');
        $currencyListBox->DataSource = new Amhsoft_Data_Set($array);
        $currencyListBox->Required = true;
        $form->addComponent($currencyListBox);

        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));

        $submitButton->setClass('ButtonSave');
        $form->addComponent($submitButton);

        $this->panel->addComponent($form);

        if ($this->getRequest()->isPost('submit')) {
            if ($form->isFormValid()) {
                $form->DataSource = Amhsoft_Data_Source::Post();
                $values = $form->getValues();
                foreach ($values as $key => $val) {
                    $paypalConfiguration->setValue($key, $val);
                }
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }

        //very important, this lines must be in the bottom of afer adding components to form
        $form->DataSource = new Amhsoft_Data_Set($paypalConfiguration->getConfiguration());
        $form->Bind();
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->panel);
        $this->show();
    }

}

?>
