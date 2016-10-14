<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Address.php 465 2016-03-02 16:44:11Z imen.amhsoft $
 * $Rev: 465 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-03-02 17:44:11 +0100 (mer., 02 mars 2016) $
 * $LastChangedDate: 2016-03-02 17:44:11 +0100 (mer., 02 mars 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Address_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_Panel $shippingAddressPanel */
    protected $shippingAddressPanel;

    /** @var Amhsoft_Widget_Panel $invoiceAddressPanel */
    protected $invoiceAddressPanel;

    /** @var AddressModel $shippingAddress */
    protected $shippingAddress;

    /** @var AddressModel $invoiceAddress */
    protected $invoiceAddress;

    /**
     * Initialize Controller
     */
    public function __initialize() {

        $cart = Cart_Shoppingcart_Model::getInstance();
        if ($cart->isEmpty()) {
            $this->getRedirector()->go('index.php?module=cart&page=list');
        }
        $this->shippingAddressPanel = new Amhsoft_Widget_Panel();
        $this->invoiceAddressPanel = new Amhsoft_Widget_Panel();
        $addresses = $this->getAvailabeleAddresses();
        $this->getView()->assign('av_addresses', $addresses);
        foreach ($addresses as $addr) {
            $address_string = '<div class="amh-right" style="margin: 5px; width: 300px; height: 200px;  padding: 8px; border-radius: 10px; background: url(Modules/Cart/images/shopcart-address-bg.png)">
                <div style="width: 100%; height: 100%; background-color: white; padding: 0 30px"><b>' . $addr->getName() . '</b><a href="?module=crm&page=intern-shop-address-modify&id=' . $addr->getId() . '" class="cart_edit"><i class="fa fa-edit"></i>&nbsp;</a>' . '<br />' . $addr->getStreet() . '<br /> ' . $addr->getZipCode() . '<br /> ' . $addr->getCity() . '<br /> ' . $addr->getProvince() . '<br />' . $addr->getCountry() . '</div></div>';
            $checkBoxInvoiceAddressid = new Amhsoft_RadioBox_Control('invoice_address_id', $address_string, $addr->getId());
            $checkBoxInvoiceAddressid->setId('invoice_address_id' . $addr->getId());
            $checkBoxInvoiceAddressid->DataBinding = new Amhsoft_Data_Binding('id');
            if ($cart->getInvoiceAddress() != null && $cart->getInvoiceAddress()->getId() == $addr->getId()) {
                $checkBoxInvoiceAddressid->Checked = true;
            }
            $checkBoxShippingAddressid = new Amhsoft_RadioBox_Control('shipping_address_id', $address_string, $addr->getId());
            $checkBoxShippingAddressid->setId('shipping_address_id' . $addr->getId());
            $checkBoxShippingAddressid->DataBinding = new Amhsoft_Data_Binding('id');
            if ($cart->getShippingAddress() != null && $cart->getShippingAddress()->getId() == $addr->getId()) {
                $checkBoxShippingAddressid->Checked = true;
            }
            $this->invoiceAddressPanel->addComponent($checkBoxInvoiceAddressid);
            $this->shippingAddressPanel->addComponent($checkBoxShippingAddressid);
        }
        //$this->invoiceAddressPanel->addComponent(new Amhsoft_Link_Control(_t('Add new Address'), 'index.php?module=crm&page=intern-shop-address-add&ret=checkout'));
        $checkBox = new Amhsoft_CheckBox_Control('use_other_shipping_address', _t('Use a different shipping address'), 1);
        $checkBox->DataBinding = new Amhsoft_Data_Binding('use_other_shipping_address');
        if ($cart->getShippingAddress() != null) {
            $checkBox->Checked = true;
        }
        $this->invoiceAddressPanel->addComponent($checkBox);
        $submit = new Amhsoft_Button_Submit_Control('continue', _t('Save and continue'));
        $this->invoiceAddressPanel->addComponent($submit);
    }

    /**
     * Get Addresses
     * @return type
     */
    protected function getAvailabeleAddresses() {
        $addressModelAdapter = new Crm_Address_Model_Adapter();
        $cart = Cart_Shoppingcart_Model::getInstance();
        if ($cart->account instanceof Crm_Account_Model) {
            $addressModelAdapter->where('account_id = ?', $cart->account->id);
            return $addressModelAdapter->fetch()->fetchAll();
        }
        return array();
    }

    /**
     * DEfault Event
     */
    public function __default() {
        if ($this->getRequest()->isPost('continue')) {
            $invoiceAddressId = $this->getRequest()->postInt('invoice_address_id');
            $shippingAddressId = $this->getRequest()->postInt('shipping_address_id');
            $user_different_shipping_address = $this->getRequest()->postInt('use_other_shipping_address');
            if ($invoiceAddressId > 0) {
                $addressAdapter = new Crm_Address_Model_Adapter();
                $cart = Cart_Shoppingcart_Model::getInstance();
                $invoiceAddress = $addressAdapter->fetchById($invoiceAddressId);
                if ($invoiceAddress instanceof Crm_Address_Model) {
                    $cart->setInvoiceAddress($invoiceAddress);
                }
                if ($user_different_shipping_address > 0) {
                    $shippingAddress = $addressAdapter->fetchById($shippingAddressId);
                    if ($shippingAddress instanceof Crm_Address_Model) {
                        $cart->setShippingAddress($shippingAddress);
                    }
                } else {
                    $cart->shipping_address_id = null;
                    $cart->shippingAddress = null;
                }
                $cart->Persist();
                $this->getRedirector()->go('index.php?module=cart&page=checkout-shipping');
            } else {
                $this->getView()->assign('error_message', _t('Please Select Invoice Address'));
            }
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $panel = new Amhsoft_Widget_Panel();
        $invoicePanel = new Amhsoft_Widget_Panel(_t('Invoice Address'));
        $invoicePanel->addComponent($this->invoiceAddressPanel);
        $shippingPanel = new Amhsoft_Widget_Panel(_t('Shipping Address'));
        $shippingPanel->setId('shippingpanel');
        $shippingPanel->addComponent($this->shippingAddressPanel);
        $panel->setLayout(new amhsoft_Grid_Layout(2));
        $panel->addComponent($invoicePanel);
        $panel->addComponent($shippingPanel);
        $this->getView()->assign('widget', $panel);
        $this->show();
    }

}

?>
