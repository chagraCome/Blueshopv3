<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quickpay.php 447 2016-02-19 16:13:27Z montassar.amhsoft $
 * $Rev: 447 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 17:13:27 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 17:13:27 +0100 (ven., 19 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Quickpay_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_Panel $shippingAddressPanel */
    protected $shippingAddressPanel;

    /** @var Amhsoft_Widget_Panel $invoiceAddressPanel */
    protected $invoiceAddressPanel;

    /** @var AddressModel $shippingAddress */
    protected $shippingAddress;

    /** @var AddressModel $invoiceAddress */
    protected $invoiceAddress;

    /** @var PaymentModelAdapter $paymentModelAdapter */
    protected $paymentModelAdapter;
    protected $payment_id;

    /** @var ShippingModelAdapter $shippingModelAdapter */
    protected $shippingModelAdapter;
    protected $shipping_id;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $auth = Amhsoft_Authentication::getInstance();
        $cart = Cart_Shoppingcart_Model::getInstance();

        if ($cart->isEmpty()) {
            $this->getRedirector()->go('index.php?module=cart&page=list');
        }
		
        $this->shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
        $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $this->shippingAddressPanel = new Amhsoft_Widget_Panel();
        $this->invoiceAddressPanel = new Amhsoft_Widget_Panel();
        $addresses = $this->getAvailabeleAddresses();
        $this->getView()->assign('av_addresses', $addresses);
    }

    /**
     * Gets Addresses
     * @return type
     */
    protected function getAvailabeleAddresses() {
        $addressModelAdapter = new Crm_Address_Model_Adapter();
        $auth = Amhsoft_Authentication::getInstance();
		$cart = Cart_Shoppingcart_Model::getInstance();

        if ($auth->isAuthenticated()) {
            $addressModelAdapter->where('account_id = ?', $auth->getObject()->id);
            return $addressModelAdapter->fetch()->fetchAll();
        }else{
			 $addressModelAdapter->where('account_id = ?', $cart->account->id);
            return $addressModelAdapter->fetch()->fetchAll();
		}
        return array();
    }

    public function setupshippingaddress() {
        $id = $this->getRequest()->getInt('aid');
        $type = $this->getRequest()->get('type');
        if ($id <= 0) {
            return;
        }
        $addressAdapter = new Crm_Address_Model_Adapter();
        $address = $addressAdapter->fetchById($id);
        if ($address instanceof Crm_Address_Model) {
            $cart = Cart_Shoppingcart_Model::getInstance();
            if ($type == 's') {
                $cart->setShippingAddress($address);
            } else {
                $cart->setInvoiceAddress($address);
                $cart->shipping_address_id = null;
                $cart->shippingAddress = null;
            }
            $cart->Persist();

            $this->__initialize();
        }
    }

    /**
     * Default Event
     */
    public function __default() {

        if ($this->getRequest()->isPost('checkout')) {
            $shippingAddressId = $this->getRequest()->postInt('shipping_address_id');

            $user_different_shipping_address = $this->getRequest()->postInt('use_other_shipping_address');

            $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
            $this->payment_id = $this->getRequest()->postInt('payment_id');

            $this->shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
            $this->shipping_id = $this->getRequest()->postInt('shipping_id');

            $shippingMehtod = $this->shippingModelAdapter->fetchById($this->shipping_id);

            $cart = Cart_Shoppingcart_Model::getInstance();
            if ($shippingMehtod instanceof Shipping_Shipping_Model) {
                $cart->setShippingMethod($shippingMehtod);
                $cart->getTotal();
                $cart->Persist();
            }
            if ($this->payment_id > 0 && $this->shipping_id > 0) {

                $paymentMehtod = $this->paymentModelAdapter->fetchById($this->payment_id);
                if ($paymentMehtod instanceof Payment_Payment_Model) {
                    $cart->setPaymentMethod($paymentMehtod);
                    $cart->Persist();
                } else {
                    $this->getView()->assign('error_message', _t('Selected payment method was deleted, please contact shop owner'));
                }

                $addressAdapter = new Crm_Address_Model_Adapter();
                $cart = Cart_Shoppingcart_Model::getInstance();
                $shippingAddress = $addressAdapter->fetchById($shippingAddressId);
                if ($shippingAddress instanceof Crm_Address_Model) {
                    $cart->setShippingAddress($shippingAddress);
                    $cart->setInvoiceAddress($shippingAddress);
                    $cart->Persist();
                } else {
                    $this->getView()->assign('error_message', _t('Please Select All options'));
                }
                $this->getRedirector()->go('index.php?module=cart&page=checkout-preview');
            } else {
                $this->getView()->assign('error_message', _t('Please Select All options'));
            }
        }
    }

    public function getBankTransfertPayment() {
        $paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $paymentModelAdapter->where('id IN (13,14,15)');

        return $paymentModelAdapter->fetch();
    }

    /**
     * Finalize Event
     */
    public function __finalize() {

        $this->getView()->assign('bank_account', $this->getBankTransfertPayment());
        $allowedShippingMethodsIds = array();
        $cart = Cart_Shoppingcart_Model::getInstance();
        $products = $cart->getProducts();
        foreach ($products as $product) {
            $allowedShippingMethodsIds = array_merge($allowedShippingMethodsIds, (array) $product->getEnabledShippingMethods());
        }
        if (!empty($allowedShippingMethodsIds)) {
            $shipping_methods_string = implode(',', $allowedShippingMethodsIds);
            $this->shippingModelAdapter->where('id IN (' . $shipping_methods_string . ')');
        }
        $this->shippingModelAdapter->where("state = 1");
        $result = $this->shippingModelAdapter->fetch();
        $shippingmethods = array();
        while ($method = $result->fetch()) {
            if ($cart->isSubTotalBewteen($method->getMinOrderAmount(), $method->getMaxOrderAmount())) {
                $method = $cart->calculateShippingCost($method);
                if ($method instanceof Shipping_Shipping_Model) {
                    $shippingmethods[] = $method;
                }
            }
        }
        $this->paymentModelAdapter->where("online = 1");
        $this->paymentModelAdapter->orderBy('sortid ASC');

        $this->getView()->assign('payments', $this->paymentModelAdapter->fetch());
        $this->getView()->assign('shippings', $shippingmethods);

        $this->getView()->assign('cart', $cart);
        $this->show();
    }

}
