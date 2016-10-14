<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Shipping.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Shipping_Controller extends Amhsoft_System_Web_Controller {

    /** @var ShippingModelAdapter $shippingModelAdapter */
    protected $shippingModelAdapter;
    protected $shipping_id;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $cart = Cart_Shoppingcart_Model::getInstance();
        if ($cart->isEmpty()) {
            $this->getRedirector()->go('index.php?module=cart&page=list');
        }
        $this->shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
        $this->shipping_id = $this->getRequest()->postInt('shipping_id');
        if ($this->getRequest()->post('continue')) {
            if ($this->shipping_id > 0) {
                $shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
                $shippingMehtod = $shippingModelAdapter->fetchById($this->shipping_id);
                if ($shippingMehtod instanceof Shipping_Shipping_Model) {
                    $cart->setShippingMethod($shippingMehtod);
                    $cart->getTotal();
                    $cart->Persist();
                    $this->getRedirector()->go('index.php?module=cart&page=checkout-payment');
                } else {
                    $this->getView()->assign('error_message', _t('Selected shipping method was deleted, please contact shop owner'));
                }
            } else {
                $this->getView()->assign('error_message', _t('Please Select Shipping Method'));
            }
        }
        if ($cart->getShippingMethod()) {
            $this->getView()->assign('selectedshipping', $cart->getShippingMethod()->getId());
        }
    }

    /**
     * Default Event
     */
    public function __default() {
        
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
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
            if (doubleval($cart->getSubTotal()) > doubleval($method->getMinOrderAmount())) {
                $method = $cart->calculateShippingCost($method);
                if ($method instanceof Shipping_Shipping_Model) {
                    $shippingmethods[] = $method;
                }
            }
        }
        $this->getView()->assign('shippings', $shippingmethods);
        $this->show();
    }

}

?>