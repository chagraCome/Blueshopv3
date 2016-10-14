<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Preview.php 447 2016-02-19 16:13:27Z montassar.amhsoft $
 * $Rev: 447 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 17:13:27 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 17:13:27 +0100 (ven., 19 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Preview_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=cart&page=checkout-preview', 'label' => _t('Preview')));
        $cart = Cart_Shoppingcart_Model::getInstance();
        if ($cart->isEmpty()) {
            $this->getRedirector()->go('index.php?module=cart&page=list');
        }
        if ($cart->account instanceof Crm_Account_Model) {
            $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
            $accountModel = $crmAccountModelAdapter->fetchById($cart->account->id);
        }

        if (!$cart->getShippingAddress() instanceof Crm_Address_Model) {
            if ($cart->getInvoiceAddress() instanceof Crm_Address_Model) {
                $cart->setShippingAddress($cart->getInvoiceAddress());
            } else {
                $addressBookModel = new Crm_Address_Model();
                $addressBookModel->setAccountId($accountModel->getId());
                $addressBookModel->setCity($accountModel->getCity());
                $addressBookModel->setCountry($accountModel->getCountry());
                $addressBookModel->setProvince($accountModel->getProvince());
                $addressBookModel->setName($accountModel->getName());
                $addressBookModel->setZipCode($accountModel->getZipcode());
                $addressBookModel->setStreet($accountModel->getStreet());
                $addressBookModelAdapter = new Crm_Address_Model_Adapter();
                $addressBookModelAdapter->save($addressBookModel);
                $cart->setShippingAddress($addressBookModel);
            }
        }
        $cart->setComment($this->getRequest()->post('comment'));
        $cart->setAccount($accountModel)->Persist();
    }

    /**
     * Default Event
     */
    public function __default() {
        if ($this->getRequest()->isPost('promotion')) {
            $this->getRedirector()->go('?module=coupon&page=verify');
        }
        if ($this->getRequest()->isPost('submit')) {
            $result = $this->convertToSalesOrder();
            if ($result instanceof Saleorder_Model) {
                Amhsoft_Event_Handler::trigger('firsttime.saleorder.saved', $this, $result);
                $cart = Cart_Shoppingcart_Model::getInstance();
                if (Amhsoft_System_Module_Manager::isModuleInstalled('Coupon')) {
                    $couponcodeModelAdapter = new Coupon_Code_Model_Adapter();
                    $couponcodeModelAdapter->where('state_id = 1');
                    $couponcodeModel = $couponcodeModelAdapter->fetchById($cart->coupon_code_id);
                    if ($couponcodeModel instanceof Coupon_Code_Model) {
                        $couponcodeModel->state_id = 2;
                        $couponcodeModelAdapter->save($couponcodeModel);
                    }
                }
                $cartNotificationModel = new Cart_Notification_Model($result);
                $cartNotificationModel->notifySalesOrderSubmitted();
                $paymentModuleName = $result->getPayment()->getModulename();
                Cart_Shoppingcart_Model::getInstance()->reset();
                if ($paymentModuleName != null) {
                    $this->getRedirector()->go('index.php?module=' . strtolower($paymentModuleName) . '&page=index&id=' . $result->getId());
                } else {
                    $this->getRedirector()->go('index.php?module=cart&page=checkout-thankyou&id=');
                }
            } else {
                $this->getView()->assign('error_message', _t('Cannot Proccess your saleorder'));
                Amhsoft_Log::error("error cannot process saleorder because saleorder not converted correctly");
            }
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $cart = Cart_Shoppingcart_Model::getInstance();
        $this->getView()->assign('cart', $cart);
        $configurationTable = new Amhsoft_Config_Table_Adapter(Cart_Shoppingcart_Model::CONFIG_TABLE);
        $this->getView()->assign('cart_policy_enabled', $configurationTable->getValue(Cart_Shoppingcart_Model::ENABLE_POLICY));
        $this->getView()->assign('cart_policy_retour_enabled', $configurationTable->getValue(Cart_Shoppingcart_Model::ENABLE_RETOUR_POLICY));
        $this->show();
    }

    /**
     * Convert Cart to Saleorder.
     */
    protected function convertToSalesOrder() {
        $cart = Cart_Shoppingcart_Model::getInstance();
        $saleOrder = new Saleorder_Model();
        $saleOrder->setNumber($saleOrder->getNextSaleOrderNumber());
        $saleOrder->setCreatorName($cart->getAccount()->getName());
        $saleOrder->setName(_t('Online Order %s', $cart->getAccount()->getName()));
        $saleOrder->setDescription($cart->getComment());
        $saleOrder->setDiscount(0);
        $saleOrder->setDueDate(Amhsoft_Locale::UCTDateTime());
        $saleOrder->setInsertAt(Amhsoft_Locale::UCTDateTime());
        $saleOrder->setUpdateAt(Amhsoft_Locale::UCTDateTime());
        $saleOrder->setPayment($cart->getPaymentMethod());
        $saleOrder->setPaymentLog("");
        $saleOrderInvoiceAddress = new Saleorder_Address_Model();
        $saleOrderInvoiceAddress->setCity($cart->getInvoiceAddress()->getCity());
        $saleOrderInvoiceAddress->setCountry($cart->getInvoiceAddress()->getCountry());
        $saleOrderInvoiceAddress->setName($cart->getInvoiceAddress()->getName());
        $saleOrderInvoiceAddress->setProvince($cart->getInvoiceAddress()->getProvince());
        $saleOrderInvoiceAddress->setStreet($cart->getInvoiceAddress()->getStreet());
        $saleOrderInvoiceAddress->setZipCode($cart->getInvoiceAddress()->getZipCode());
        $saleOrderShippingAddress = new Saleorder_Address_Model();
        $saleOrderShippingAddress->setCity($cart->getShippingAddress()->getCity());
        $saleOrderShippingAddress->setCountry($cart->getShippingAddress()->getCountry());
        $saleOrderShippingAddress->setName($cart->getShippingAddress()->getName());
        $saleOrderShippingAddress->setProvince($cart->getShippingAddress()->getProvince());
        $saleOrderShippingAddress->setStreet($cart->getShippingAddress()->getStreet());
        $saleOrderShippingAddress->setZipCode($cart->getShippingAddress()->getZipCode());
        $saleOrder->setInvoiceAddress($saleOrderInvoiceAddress);
        $saleOrder->setShippingAddress($saleOrderShippingAddress);
        $saleOrder->setTotalPrice($cart->getTotal());
        $saleOrder->setSubTotal($cart->getSubTotal());
        $saleOrder->setDiscount($cart->getCouponCodeDiscount());
        $saleOrder->setHandlingFee($cart->getHandlingFee()); //setup handling fee
        $saleOrder->setShippingCost($cart->getShippingcost());
        $saleOrder->setAccount($cart->getAccount());
        $saleOrder->setAccountName($cart->getAccount()->getName());
        $saleOrder->setAccountEmail($cart->getAccount()->getEmail());
        $saleOrder->setAccountMobile($cart->getAccount()->getMobile());
        $saleOrder->setCurrency(Amhsoft_Locale::getCurrencyIso3());
        $saleOrder->total_taxes = $cart->total_taxes;
        $saleOrder->setBaseCurrency(Amhsoft_System_Config::getProperty('base_currency'));
        $currencySetModelAdapter = new Setting_Local_Model_Adapter();
        $currency_set_id = $currencySetModelAdapter->getLastLocalId();
        $saleOrder->setCurrencySetId($currency_set_id);
        $saleOrder->setPaymentMethodName($cart->getPaymentMethod()->getName());
        if ($cart->getShippingMethod()) {
            $saleOrder->setShippingMethodName($cart->getShippingMethod()->getTitle());
        }
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $policy = $saleOrderConfiguration->getValue('sale_order_policy', null);
        $saleOrder->setPolicy($policy);
        $saleOrder->sale_order_state_id = Saleorder_State_Model::SEND;
        $saleOrder->setSaleOrderState(Saleorder_State_Model::SEND);

        return $this->saveSaleorder($saleOrder, $cart->getProducts(), $saleOrderInvoiceAddress, $saleOrderShippingAddress);
    }

    /**
     * Handler Saleorders , addresses and comments.
     * @param Saleorder_Model $saleOrder
     * @param Cart_Shoppingcart_Model $cart
     * @param Saleorder_Address_Model $saleOrderInvoiceAddress
     * @param Saleorder_Address_Model $saleOrderShippingAddress
     * @return \Saleorder_Model
     */
    protected function saveSaleorder(Saleorder_Model $saleOrder, $products, Saleorder_Address_Model $saleOrderInvoiceAddress, Saleorder_Address_Model $saleOrderShippingAddress) {
        $db = Amhsoft_Database::newInstance();
        $db->beginTransaction();
        try {
            $saleOrderAddressAdapter = new Saleorder_Address_Model_Adapter();
            $saleOrderAddressAdapter->setDbAdapter($db);
            $saleOrderAddressAdapter->save($saleOrderInvoiceAddress);
            $saleOrderAddressAdapter->save($saleOrderShippingAddress);
            $saleOrderAdapter = new Saleorder_Model_Adapter();
            $saleOrderAdapter->setDbAdapter($db);
            $saleOrderAdapter->save($saleOrder);
            //save products
            foreach ((array) $products as $product) {
                $saleOrderItemModel = new Saleorder_Item_Model();
                $saleOrderItemModel->setItemNumber($product->getNumber());
                $saleOrderItemModel->setItemName($product->getTitle());
                $saleOrderItemModel->setQuantity($product->quantity_in_cart);
                $saleOrderItemModel->setUnitPrice($product->getUnitPrice());
                $saleOrderItemModel->setProductNumber($product->getNumber());
                $saleOrderItemModel->setRegularPrice($product->getPrice());
                $saleOrderItemModel->setSubTotal($product->getSubTotal());
                $saleOrderItemModel->setProduct($product);
                $saleOrderItemModel->tax_id = $product->tax_id;
                $saleOrderItemModel->setItemDescription(/* implode("\n", $product->getAttributeLabeledValues()) */''); //only for amhshop pro 
                $saleOrderItemModel->sale_order_id = $saleOrder->getId();
                $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
                $saleOrderItemModelAdapter->setDbAdapter($db);
                $saleOrderItemModelAdapter->save($saleOrderItemModel);
                Product_Product_Model::liveDecrementQuantity($db, $product->getId(), $product->quantity_in_cart);
                if ($product->isGrouped()) {
                    foreach ($product->getGroupedProducts() as $groupedProduct) {
                        $groupedProduct->quantity_in_cart = $product->quantity_in_cart;
                        $saleOrderItemModel = new Saleorder_Item_Model();
                        $saleOrderItemModel->setItemNumber($groupedProduct->getNumber());
                        $saleOrderItemModel->setItemName($groupedProduct->getTitle());
                        $saleOrderItemModel->setQuantity($groupedProduct->quantity_in_cart);
                        $saleOrderItemModel->setUnitPrice(0);
                        $saleOrderItemModel->setProductNumber($groupedProduct->getNumber());
                        $saleOrderItemModel->setRegularPrice($groupedProduct->getPrice());
                        $saleOrderItemModel->setSubTotal(0);
                        $saleOrderItemModel->tax_id = $product->tax_id;
                        $saleOrderItemModel->setProduct($groupedProduct);
                        $saleOrderItemModel->setItemDescription(/* implode("\n", $product->getAttributeLabeledValues()) */''); //only for amhshop pro 
                        $saleOrderItemModel->sale_order_id = $saleOrder->getId();
                        $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
                        $saleOrderItemModelAdapter->setDbAdapter($db);
                        $saleOrderItemModelAdapter->save($saleOrderItemModel);
                        Product_Product_Model::liveDecrementQuantity($db, $groupedProduct->getId(), $groupedProduct->quantity_in_cart);
                    }
                }
            }
            $saleOrderCommentAdapter = new Saleorder_Comment_Model_Adapter();
            $saleOrderCommentAdapter->setDbAdapter($db);
            $commentText = $saleOrder->getDescription();
            if ($commentText && $saleOrder->getId() > 0) {
                if (Amhsoft_System_Module_Manager::isModuleInstalled('Comment')) {
                    $commentModelAdapter = new Comment_Model_Adapter();
                    $commentModelAdapter->setDbAdapter($db);
                    $commentModel = new Comment_Model();
                    $commentModel->setAuthor_name($saleOrder->getAccountName());
                    $commentModel->setComment($commentText);
                    $commentModel->setEntity('Saleorder_Model');
                    $commentModel->setEntityId($saleOrder->getId());
                    $commentModel->setInsertat(Amhsoft_Locale::UCTDateTime());
                    $commentModel->setPublic(1);
                    $commentModel->setPublic_seen(1);
                    $commentModel->setUser_seen(0);
                    $commentModel->setSubject($saleOrder->getName());
                    $commentModelAdapter->save($commentModel);
                }
            }
            $db->commit();
            return $saleOrder;
        } catch (Exception $e) {
            $db->rollBack();
            Amhsoft_Log::error('shopping cart save sales order: ' . $e->getMessage(), $saleOrder);
            return null;
        }
    }

}

?>
