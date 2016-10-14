<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Settings.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Paytabs
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Paytabs_Backend_Settings_Controller extends Amhsoft_System_Web_Controller {

    public $panel;
	public $oldPassword;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->panel = new Amhsoft_Widget_Panel(_t('Paytabs Settings'));
        $this->getView()->setMessage(_t('Manage Paytabs Settings'), View_Message_Type::INFO);
		$paytabConfiguration = new Amhsoft_Config_Table_Adapter('paytabs');
		$this->oldPassword = $paytabConfiguration->getValue('merchant_password');
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getSetupForm();
    }

    protected function getSetupForm() {
        $paytabConfiguration = new Amhsoft_Config_Table_Adapter('paytabs');


        $form = new Amhsoft_Widget_Form('setup_form', 'POST');

        $merchantId = new Amhsoft_Input_Control('merchant_id', _t('Merchant ID'));
        $merchantId->DataBinding = new Amhsoft_Data_Binding('merchant_id', $paytabConfiguration->getValue('merchant_id'));
        $merchantId->addValidator('Email');
        $merchantId->Required = true;
        $form->addComponent($merchantId);
		
		$merchantPassword = new Amhsoft_Password_Control('merchant_password', _t('Merchant Password'));
        $merchantPassword->DataBinding = new Amhsoft_Data_Binding('merchant_password', $paytabConfiguration->getValue('merchant_password'));
        $merchantPassword->Required = true;
		$merchantPassword->DefaultValue = sha1($paytabConfiguration->getValue('merchant_password'));
        $form->addComponent($merchantPassword);
		
        $currencyListBox = new Amhsoft_ListBox_Control('paytabs_currency', _t('Currency'));
        $currencyListBox->DataBinding = new Amhsoft_Data_Binding('paytabs_currency', $paytabConfiguration->getValue('paytab_currency'));
        $array = array('USD', 'EUR','SAR','BHD');
        $currencyListBox->DataSource = new Amhsoft_Data_Set($array);
        $currencyListBox->Required = true;
        $form->addComponent($currencyListBox);
		
		$languageListBox = new Amhsoft_ListBox_Control('paytabs_lang', _t('Language'));
        $languageListBox->DataBinding = new Amhsoft_Data_Binding('paytabs_lang','id','value',$paytabConfiguration->getValue('paytabs_lang'));
        $array = array(
		array('id'=>'Arabic','value'=>_t('Arabic')),
		array('id'=>'English','value'=>_t('English')),
		);
        $languageListBox->DataSource = new Amhsoft_Data_Set($array);
        $languageListBox->Required = true;
        $form->addComponent($languageListBox);

        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));

        $submitButton->setClass('ButtonSave');
        $form->addComponent($submitButton);

        $this->panel->addComponent($form);

        if ($this->getRequest()->isPost('submit')) {
            if ($form->isFormValid()) {
                $form->DataSource = Amhsoft_Data_Source::Post();
                $values = $form->getValues();
                foreach ($values as $key => $val) {
					if($key == 'merchant_password'){
						if($val != "******"){
							$paytabConfiguration->setValue('merchant_password', $val);
						}else{
							$paytabConfiguration->setValue('merchant_password', $this->oldPassword);
						}
						
					}
                    $paytabConfiguration->setValue($key, $val);
                }
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }

        //very important, this lines must be in the bottom of afer adding components to form
		$data = $paytabConfiguration->getConfiguration();
		$data["merchant_password"] = "******";
        $form->DataSource = new Amhsoft_Data_Set($data);
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
