<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 384 2016-02-10 14:51:22Z montassar.amhsoft $
 * $Rev: 384 $
 * @package    Cart
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-10 15:51:22 +0100 (mer., 10 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Cart_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    protected $mainPanel;
    protected $settingForm;

    /**
     * Initialize Controler
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $this->getView()->setMessage(_t('Shopping cart Settings'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->getSettingForm();
        $configurationTable = new Amhsoft_Config_Table_Adapter(Cart_Shoppingcart_Model::CONFIG_TABLE);
        if ($this->getRequest()->isPost('save')) {
            if ($this->settingForm->isFormValid()) {
                $values = $this->settingForm->getValues();
                $configurationTable->setValue(Cart_Shoppingcart_Model::CHECKOUT_TYPE, $values[Cart_Shoppingcart_Model::CHECKOUT_TYPE]);
                $configurationTable->setValue('allow_checkout_without_registration', $values['allow_checkout_without_registration']);
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            }
        }
        $this->settingForm->DataSource = new Amhsoft_Data_Set($configurationTable->getConfiguration());
        $this->settingForm->Bind();
    }

    /**
     * Setup Setting Form
     */
    protected function getSettingForm() {
        $panel = new Amhsoft_Widget_Panel(_t('Shopping cart Policies'));


        $checkoutTypeListBox = new Amhsoft_ListBox_Control('checkout_type', _t('Checkout Type'));
        $array = array(
            array('id' => 1, 'name' => _t('Quickpay')),
            array('id' => 2, 'name' => _t('Full Pay')),
        );
        $checkoutTypeListBox->DataBinding = new Amhsoft_Data_Binding('checkout_type', 'id', 'name');
        $checkoutTypeListBox->DataSource = new Amhsoft_Data_Set($array);
        $checkoutTypeListBox->Required = true;

        $panel->addComponent($checkoutTypeListBox);

        $allowCheckoutWithoutRegistration = new Amhsoft_YesNo_ListBox_Control('allow_checkout_without_registration', _t('Allow checkout without registration'), 'allow_checkout_without_registration');

        $panel->addComponent($allowCheckoutWithoutRegistration);

        $submit = new Amhsoft_Button_Submit_Control('save', _t('Save'));
        $submit->setClass('ButtonSave');

        $this->settingForm = new Amhsoft_Widget_Form('cart_form', 'POST');
        $this->settingForm->addComponent($panel);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($submit);
        $this->settingForm->addComponent($navigationPanel);

        $this->mainPanel->addComponent($this->settingForm);
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->mainPanel);
        $this->show('');
    }

}

?>
