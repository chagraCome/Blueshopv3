<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=cart&page=list', 'label' => _t('Shopping Cart')));
    }

    /**
     * Default Event
     */
    public function __default() {
        if ($this->getRequest()->isPost('checkout')) {
            $cart = Cart_Shoppingcart_Model::getInstance();
            $auth = Amhsoft_Authentication::getInstance();
            if ($auth->isAuthenticated()) {
                $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
                $accountModel = $crmAccountModelAdapter->fetchById($auth->getObject()->id);
                if ($accountModel instanceof Crm_Account_Model) {
                    $cart->setAccount($accountModel);
                    $cart->Persist();
                    $this->getRedirector()->go($cart->getCheckoutUrl());
                } else {
                    Amhsoft_Registry::register('after_login', $cart->getCheckoutUrl());
                    $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
                }
            } else {
                Amhsoft_Registry::register('after_login', $cart->getCheckoutUrl());
                $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
            }
        }
        if ($this->getRequest()->isPost('continue')) {
            $this->getRedirector()->go('index.php?module=product&page=list');
        }
        if ($this->getRequest()->isPost('coupon_code')) {
            $this->getRedirector()->go('?module=coupon&page=verify');
        }
        if ($this->getRequest()->get('ret') == 'true') {
            $this->getView()->assign('shopping_cart_message', _t('Action was successfully done'));
        }
        if ($this->getRequest()->get('erg') == 'true') {
            $this->getView()->assign('shopping_cart_message', _t('Product was successfully deleted from shopping cart'));
        }
        if ($this->getRequest()->get('up') == 'true') {
            $this->getView()->assign('shopping_cart_message', _t('Your Shopping cart was updated'));
        }
        if ($this->getRequest()->get('message')) {
            $this->getView()->assign('shopping_cart_message', $this->getRequest()->get('message'));
        }
        if ($this->getRequest()->isPost('update')) {
            $updated = $this->updateCart();
            if ($updated) {
                $this->getRedirector()->go('index.php?module=cart&page=list&up=true');
            }
        }
    }

    /**
     * Update Cart
     * @return boolean
     */
    protected function updateCart() {
        $quattites = $this->getRequest()->postInts('qnt');
        if (!empty($quattites)) {
            try {
                $cart = Cart_Shoppingcart_Model::getInstance();
                foreach ($quattites as $index => $quantity) {
                    $cart->modifyProductQuantityByIndex($index, $quantity);
                }
                $cart->Persist();
                return true;
            } catch (Exception $e) {
                $this->getView()->assign('shopping_cart_message', $e->getMessage());
                return false;
            }
        }
    }

    /**
     * Load Up & Cross Selling
     */
    public function loadUpAndCrossSelling() {
        $upSelling = array();
        $crossSelling = array();
        $cart = Cart_Shoppingcart_Model::getInstance();
        foreach ($cart->getProducts() as $product) {
            $upSelling = array_merge($product->getUpProducts(), $upSelling);
            $crossSelling = array_merge($product->getCrossProducts(), $crossSelling);
        }
        $upSelling = array_unique($upSelling);
        $crossSelling = array_unique($crossSelling);
        $this->getView()->assign('upProducts', $upSelling);
        $this->getView()->assign('crossProducts', $crossSelling);
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $cart = Cart_Shoppingcart_Model::getInstance();
        $this->getView()->assign('cart', $cart);
        $this->loadUpAndCrossSelling();
        $this->show();
    }

}

?>
