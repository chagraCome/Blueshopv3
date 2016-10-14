<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Settings.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payfort
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payfort_Backend_Settings_Controller extends Amhsoft_System_Web_Controller {

    public $panel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->panel = new Amhsoft_Widget_Panel(_t('Payfort Settings'));
        $this->getView()->setMessage(_t('Manage Payfort Settings'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getSetupForm();
    }

    protected function getSetupForm() {


        $payfortConfiguration = new Amhsoft_Config_Table_Adapter('payfort');


        $form = new Amhsoft_Widget_Form('setup_form', 'POST');

        $pspidInput = new Amhsoft_Input_Control('payfort_pspid', _t('Merchant affiliation Name (PSPID)'));
        $pspidInput->DataBinding = new Amhsoft_Data_Binding('payfort_pspid', $payfortConfiguration->getValue('payfort_pspid'));
        $pspidInput->Required = true;
        $form->addComponent($pspidInput);
        
        $shaInPassPhrase = new Amhsoft_Input_Control('payfort_Inpassphrase', _t('SHA1-IN-Phrase'));
        $shaInPassPhrase->DataBinding = new Amhsoft_Data_Binding('payfort_Inpassphrase', $payfortConfiguration->getValue('payfort_Inpassphrase'));
        $shaInPassPhrase->Required = true;
        $form->addComponent($shaInPassPhrase);
        
        $pspidInput = new Amhsoft_Input_Control('payfort_Outpassphrase', _t('SHA1-OUT-Phrase'));
        $pspidInput->DataBinding = new Amhsoft_Data_Binding('payfort_Outpassphrase', $payfortConfiguration->getValue('payfort_Outpassphrase'));
        $pspidInput->Required = true;
        $form->addComponent($pspidInput);


        $testModeListBox = new Amhsoft_YesNo_ListBox_Control('test_mode', _t('Test Mode'), 'test_mode', 1);
        $form->addComponent($testModeListBox);


        $currencyListBox = new Amhsoft_ListBox_Control('payfort_currency', _t('Currency'));
        $currencyListBox->DataBinding = new Amhsoft_Data_Binding('payfort_currency', $payfortConfiguration->getValue('payfort_currency'));
        $array = array('SAR', 'EGP', 'KWD', 'USD', 'AED');
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
                    $payfortConfiguration->setValue($key, $val);
                }
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }

        //very important, this lines must be in the bottom of afer adding components to form
        $form->DataSource = new Amhsoft_Data_Set($payfortConfiguration->getConfiguration());
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
