<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Shoppingcart_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $expire;
    public $total;
    public $shippingcost;
    public $account;
    public $shippingAddress;
    public $invoiceAddress;

    /** @var Shipping_Shipping_Model $shippingMethod */
    public $shippingMethod;

    /** @var Payment_Payment_Model $paymentMethod */
    public $paymentMethod;
    public $comment;
    public $products = array();
    public $coupon_code_id;
    public $total_taxes;

    /** @var Coupon_Code_Modsel $coupon */
    public $coupon;

    /** @var ShoppingCartModel $instance */
    private static $instance = NULL;

    const CONFIG_TABLE = 'cart';
    const ENABLE_POLICY = 'enable_policy';
    const ENABLE_RETOUR_POLICY = 'enable_retour_policy';
    const CHECKOUT_TYPE = "checkout_type";

    /**
     * Gets Handle Fee
     * @return int
     */
    public function getHandlingFee() {
        if ($this->paymentMethod instanceof Payment_Payment_Model) {
            return $this->paymentMethod->getHandlingFeeAsAmount();
        } else {
            return 0;
        }
    }

    /**
     * Sets id.
     * @param <type> id
     * @return Shoppingcart
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets id.
     * @return <type> id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets expire.
     * @param <type> expire
     * @return Shoppingcart
     */
    public function setExpire($expire) {
        $this->expire = $expire;
        return $this;
    }

    /**
     * Gets expire.
     * @return <type> expire
     */
    public function getExpire() {
        return $this->expire;
    }

    /**
     * Sets total.
     * @param <type> total
     * @return Shoppingcart
     */
    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    /*
     * Check if Has Coupon
     */

    public function hasCoupon() {
        if (Amhsoft_System_Module_Manager::isModuleInstalled('Coupon')) {
            return ($this->coupon instanceof Coupon_Code_Model) && ($this->coupon->state_id == 1);
        } else {
            return false;
        }
    }

    /**
     * Gets total.
     * @return double total
     */
    public function getTotal() {
        $total = $this->getSubTotal() + $this->getHandlingFee();
        if ($this->getShippingMethod() instanceof Shipping_Shipping_Model) { //shipping_method_defined
            $shippingMehtod = $this->calculateShippingCost($this->getShippingMethod());
            if ($shippingMehtod) {
                $this->setShippingcost($shippingMehtod->shipping_cost);
                $total += $this->getShippingcost();
            }
        }
        $total += $this->getTotaleTaxRate();
        return $this->total = $total;
    }

    /**
     * Gets Grand Total
     * @return type
     */
    public function getGrandTotal() {
        $grandTotal = $this->getTotal() - $this->getCouponCodeDiscount();
        if ($grandTotal <= 0) {
            return 0;
        } else {
            return $grandTotal;
        }
    }

    /**
     * Gets Coupon Discount Code
     * @return int
     */
    public function getCouponCodeDiscount() {
        if (!$this->hasCoupon()) {
            return 0;
        }
        if ($this->getSubTotal() < $this->coupon->coupon->getMinumShoppingCartAmount()) {
            return 0;
        }
        if ($this->coupon->coupon->getType()->getId() == Coupon_Type_Model::FREE_SHIPPING) {
            if ($this->getShippingMethod() instanceof Shipping_Shipping_Model) {
                return $this->getShippingcost();
            }
        }
        if ($this->coupon->coupon->getPercent() > 0) {
            return $this->getSubTotal() * $this->coupon->coupon->getPercent() / 100;
        }
        if ($this->coupon->coupon->getAmount() > 0) {
            return $this->coupon->coupon->getAmount();
        }
    }

    /**
     * Gets total.
     * @return <type> total
     */
    public function getSubTotal() {
        $total = 0;
        foreach ($this->getProducts() as $product) {
            $total += $product->getSubTotal();
        }
        return $total;
    }

    /**
     * Sets shippingcost.
     * @param <type> shippingcost
     * @return Shoppingcart
     */
    public function setShippingcost($shippingcost) {
        $this->shippingcost = $shippingcost;
        return $this;
    }

    /**
     * Gets shippingcost.
     * @return <type> shippingcost
     */
    public function getShippingcost() {
        return $this->shippingcost;
    }

    /**
     * Sets shipping method.
     * @param Shipping_Shipping_Model $shippingMethod
     * @return Shoppingcart
     */
    public function setShippingMethod(Shipping_Shipping_Model $shippingMethod) {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * Gets shipping method.
     * @return Shipping_Shipping_Model shipping method
     */
    public function getShippingMethod() {
        return $this->shippingMethod;
    }

    /**
     * Sets payment method
     * @param Payment_Payment_Model $paymentMethod
     * @return Cart_Shoppingcart_Model
     */
    public function setPaymentMethod(Payment_Payment_Model $paymentMethod) {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Gets payment method.
     * @return Payment_Payment_Model payment method
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * Sets shipping address.
     * @param Crm_Address_Model $shippingAddress
     * @return \ShoppingcartModel
     */
    public function setShippingAddress(Crm_Address_Model $shippingAddress) {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * Gets shipping address.
     * @return Crm_Address_Model shipping address
     */
    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    /**
     * Sets invoice address.
     * @param Crm_Address_Model $invoiceAddress
     * @return \ShoppingcartModel
     */
    public function setInvoiceAddress(Crm_Address_Model $invoiceAddress) {
        $this->invoiceAddress = $invoiceAddress;
        return $this;
    }

    /**
     * Gets invoice address.
     * @return Crm_Address_Model invoice address.
     */
    public function getInvoiceAddress() {
        return $this->invoiceAddress;
    }

    /**
     * Sets account.
     * @param Crm_Account_Model $account
     * @return Cart_Shoppingcart_Model model
     */
    public function setAccount(Crm_Account_Model $account) {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets account.
     * @return Crm_Account_Model account
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * Get Comment
     * @return type
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * Set Comment
     * @param type $comment
     */
    public function setComment($comment) {
        $this->comment = $comment;
    }

    /**
     * Add product to shoppingcart
     * @param ProductModel $product
     * @return ShoppingcartModel shoppingcart
     */
    public function addProduct(Product_Product_Model $product, $quantity = 1) {
        if ($quantity < 1) {
            throw new Amhsoft_Exception(_t('Quantity is finshed'));
        }
        if ($this->isGlobalStockManagementEnabled()) {

            if ($this->isStockManagementEnabledForProduct($product) && !$this->enougthQuantity($product, $quantity)) {
                throw new Product_NoEnougthQuantity_Exception(_t('No enough quantity for this product %s Max Quantity is %s', array($product->getTitle(), $product->getQuantity())));
            }
        }
        if ($this->isEmpty()) {
            $product->quantity_in_cart = $quantity;
            $this->products[] = $product;
            return $this;
        }
        $index = $this->containsProduct($product);
        if ($index === false) {
            $product->quantity_in_cart = $quantity;
            $this->products[] = $product;
        } else {
            $this->products[$index]->quantity_in_cart += $quantity;
        }
        return $this;
    }

    /**
     * Check if Global Stock Management is Enable
     * @return type
     */
    protected function isGlobalStockManagementEnabled() {
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        return (bool) $productConfig->getValue('stock_enable_auto_stk_management');
    }

    protected function isStockManagementEnabledForProduct(Product_Product_Model $product) {
        return (bool) $product->getManageStock();
    }

    protected function enougthQuantity(Product_Product_Model $product, $requestedQuantity) {
        $e = $product->getQuantity() >= $requestedQuantity;
        if (!$e) {
            return false;
        }
        $g = true;
        if ($product->isGrouped()) {
            foreach ($product->getGroupedProducts() as $p) {
                if ($this->isStockManagementEnabledForProduct($p)) {
                    $g &= ($p->getQuantity() >= $requestedQuantity);
                }
            }
        }
        return $g;
    }

    /**
     * 
     * @param type $index
     * @param type $quantity
     * @throws Exception
     */
    public function modifyProductQuantityByIndex($index, $quantity) {
        if (intval($quantity) < 1) {
            throw new Amhsoft_Exception(_t('Quantity is finshed'));
        }
        if (isset($this->products[$index]) && $this->products[$index] instanceof Product_Product_Model) {
            if ($this->isGlobalStockManagementEnabled()) {
                if ($this->isStockManagementEnabledForProduct($this->products[$index]) && !$this->enougthQuantity($this->products[$index], $quantity)) {
                    throw new Product_NoEnougthQuantity_Exception(_t('No enough quantity for this product %s Max Quantity is %s', array($this->products[$index]->getTitle(), $this->products[$index]->getQuantity())));
                }
            }
            $this->products[$index]->quantity_in_cart = $quantity;
        }
    }

    /**
     * 
     * @param type $index
     * @param type $quantity
     * @throws Exception
     */
    public function modifyProductQuantityByProductId($productId, $quantity) {
        if (intval($quantity) < 1) {
            throw new Amhsoft_Exception(_t('Quantity is finshed'));
        }
        $product = new Product_Product_Model();
        $product->id = $productId;
        $index = $this->containsProduct($product);
        if ($index === false) {
            throw new Product_Not_Available_Exception();
        }
        $this->modifyProductQuantityByIndex($index, $quantity);
    }

    /**
     * Persist Shoppingcart
     */
    public function Persist() {
        $shoppingCartModelAdapter = new Cart_Shoppingcart_Model_Adapter();
        $shoppingCartModelAdapter->save($this);
        $cleanup_cart = "DELETE FROM shoppingcart WHERE id NOT IN (SELECT `session_value` FROM `session` WHERE `session_key` = 'shopping_cart_id')";
        Amhsoft_Database::getInstance()->exec($cleanup_cart);
    }

    /**
     * Gets products.
     * @return array products
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * Check if shoppingcart contains a product.
     * @param ProductModel $product
     * @return boolean
     */
    public function containsProduct(Product_Product_Model $product) {
        for ($i = 0; $i < $this->getProductsCount(); $i++) {
            if ($this->products[$i]->getId() == $product->getId()) {
                return $i;
            }
        }
        return false;
    }

    /**
     * Get count of products in shoppingcart
     * @return int
     */
    public function getProductsCount() {
        return count($this->products);
    }

    /**
     * Gets Quantity Count
     * @return type
     */
    public function getProductsQuantityCount() {
        $count = 0;
        foreach ((array) $this->products as $product) {
            $count += $product->quantity_in_cart;
        }
        return $count;
    }

    /**
     * Remove by Product Id
     * @param type $id
     * @return \Cart_Shoppingcart_Model
     */
    public function removeProductByProductId($id) {
        $product = new Product_Product_Model();
        $product->setId($id);
        $index = $this->containsProduct($product);
        if ($index !== false) {
            $this->removeProductByIndex($index);
        }
        return $this;
    }

    /**
     * Remove Product By Index
     * @param type $index
     * @return \Cart_Shoppingcart_Model
     */
    public function removeProductByIndex($index) {
        if (isset($this->products[$index])) {
            unset($this->products[$index]);
        }
        return $this;
    }

    /**
     * Check if shoppingcart contains no products.
     * @return boolean
     */
    public function isEmpty() {
        return $this->getProductsCount() == 0;
    }

    /**
     * ResetShoppingcart
     * @return  ShoppingcartModel shoppingcart.
     */
    public function reset() {
        $this->account = null;
        $this->shippingAddress = null;
        $this->invoiceAddress = null;
        $this->shippingMethod = null;
        $this->paymentMethod = null;
        $this->products = array();
        $adapter = new Cart_Shoppingcart_Model_Adapter();
        $adapter->save($this);
        return $this;
    }

    /**
     * Gets Shoppingcart
     * @return Cart_Shoppingcart_Model shoppingcart
     */
    public static function getInstance() {
        if (!Amhsoft_System_Module_Manager::isModuleInstalled('Cart')) {
            return new Cart_Shoppingcart_Model();
        }


        $id = Amhsoft_Session::read('shopping_cart_id');
        $shoppingCartModelAdapter = new Cart_Shoppingcart_Model_Adapter();
        if (intval($id) > 0) {
            $cart = $shoppingCartModelAdapter->fetchById($id);
            if ($cart instanceof Cart_Shoppingcart_Model) {
                $cart->getTotal();
                self::$instance = $cart;
            } else {
                self::$instance = self::createCart();
            }
        } else {
            self::$instance = self::createCart();
        }
        return self::$instance;
    }

    /**
     * Create persistable shopping cart.
     * @return \ShoppingCartModel
     * @throws Exception
     */
    public static function createCart() {
        $cleanup_cart = "DELETE FROM shoppingcart WHERE id NOT IN (SELECT `session_value` FROM `session` WHERE `session_key` = 'shopping_cart_id')";
        Amhsoft_Database::getInstance()->exec($cleanup_cart);
        $cart = new Cart_Shoppingcart_Model();
        $shoppingCartModelAdapter = new Cart_Shoppingcart_Model_Adapter();
        $e = $shoppingCartModelAdapter->save($cart);
        if ($e) {
            Amhsoft_Session::write('shopping_cart_id', $cart->getId());
            self::$instance = $cart;
        } else {
            throw new Exception("Cannot create Shoppingcart");
        }
        return $cart;
    }

    /**
     * Calculate Shipping Cost
     * shipping cost depends on custmer shipping address and the shipping method.
     * @param Shipping_Shipping_Model $model
     * @return \Shipping_Shipping_Model|null
     */
    public function calculateShippingCost(Shipping_Shipping_Model $model) {
        $shippingAddress = $this->getShippingAddress();
        if (!$shippingAddress instanceof Crm_Address_Model) {
            $shippingAddress = $this->getInvoiceAddress();
        }
        if ($shippingAddress == null) {
            return $model;
        }
        if (empty($model->countries)) {
            $model->countries = array('ALL');
        }
        if (in_array('ALL', (array) $model->countries) || in_array($shippingAddress->getCountry(), (array) $model->countries)) {
            $model->shipping_cost = 0;
            if ($model->shipping_type_id == 1) { //free
                return $model;
            }
            if ($model->shipping_type_id == 2) { //flaterate
                if ($model->cost_type == 1) { //per item
                    $model->shipping_cost = $model->cost * $this->getProductsQuantityCount();
                }
                if ($model->cost_type == 2) { //per cart
                    $model->shipping_cost = $model->cost;
                }
                if ($model->packaging_cost_type == 1) { //per item
                    $model->shipping_cost += $model->packaging_cost * $this->getProductsQuantityCount();
                }
                if ($model->packaging_cost_type == 2) { //per cart
                    $model->shipping_cost += $model->packaging_cost;
                }
                return $model;
            }
        } else {
            return null;
        }
    }

    public function containsTangible() {
        foreach ($this->getProducts() as $product) {
            if ($product->isTangible()) {
                return $type = 'tangible';
            }
            if ($product->isGrouped()) {
                foreach ($product->getGroupedProducts() as $p) {
                    if ($p->isTangible()) {
                        return $type = 'tangible';
                    }
                }
            }
        }
    }

    public function productExist($id) {
        foreach ($this->getProducts() as $product) {
            if ($product->getId() == $id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets Cart Type
     * @return string
     */
    public function getCartType() {
        $all_products_are_services = true;
        $all_products_are_downloadble = true;
        foreach ($this->getProducts() as $prodcut) {
            if ($prodcut->isTangible()) {
                return $type = 'tangible';
            }
            if ($prodcut->isService()) {
                $all_products_are_services &= true;
                $all_products_are_downloadble &= false;
            }
            if ($prodcut->isDownloadable()) {
                $all_products_are_services &= false;
                $all_products_are_downloadble &= true;
            }
            if ($prodcut->isGrouped()) {
                foreach ($prodcut->getGroupedProducts() as $p) {
                    if ($p->isTangible()) {
                        return $type = 'tangible';
                    }
                    if ($prodcut->isService()) {
                        $all_products_are_services &= true;
                        $all_products_are_downloadble &= false;
                    }
                    if ($prodcut->isDownloadable()) {
                        $all_products_are_services &= false;
                        $all_products_are_downloadble &= true;
                    }
                }
            }
        }
        if ($all_products_are_services) {
            return 'service';
        }
        if ($all_products_are_downloadble) {
            return 'downloadable';
        }
        return 'tangible';
    }

    /**
     * Get Checkout URL
     * @return string
     */
    public function getCheckoutUrl() {
        if ($this->getCartType() == 'tangible') {
            $configurationTable = new Amhsoft_Config_Table_Adapter(Cart_Shoppingcart_Model::CONFIG_TABLE);

            $checkoutType = $configurationTable->getValue(Cart_Shoppingcart_Model::CHECKOUT_TYPE);
            if ($checkoutType == 1) {
                return 'index.php?module=cart&page=checkout-quickpay';
            } else {
                return 'index.php?module=cart&page=checkout-address';
            }
        }
        if ($this->getCartType() == 'service') {
            return 'index.php?module=cart&page=checkout-service-address';
        }
        if ($this->getCartType() == 'downloadable') {
            return 'index.php?module=cart&page=checkout-downloadable-address';
        }
        return 'index.php?module=cart&page=checkout-address';
    }

    public function getProductsTaxRate() {
        $products_taxes = 0;
        foreach ($this->getProducts() as $product) {
            $products_taxes += $product->getTaxRate();
        }

        return $products_taxes;
    }

    public function getShippingTaxRate() {
        $shipping_taxes = 0;
        if ($this->getShippingMethod() && $this->getShippingMethod()->tax) {
            $shipping_taxes = ($this->getShippingcost() * $this->getShippingMethod()->tax->getValue()) / 100;
        }

        return $shipping_taxes;
    }

    public function getTotaleTaxRate() {
        return $this->total_taxes = $this->getShippingTaxRate() + $this->getProductsTaxRate();
    }

    public function isSubTotalBewteen($min = 0, $max = 0) {

        $_min = doubleval($min);
        $_max = doubleval($max);

        $subtotal = $this->getSubTotal();
        $_subtotal = doubleval($subtotal);

        if ($_max == 0) {
            return $_subtotal >= $min;
        }

        if ($min == 0) {
            return $_subtotal <= $_max;
        }

        return $_subtotal <= $_max && $subtotal >= $_min;
    }

    public function incrementQuantityByProductId($id, $quantity) {
        foreach ((array) $this->products as $key => $product) {
            if ($product->id == $id) {
                $product->quantity_in_cart = $product->quantity_in_cart + $quantity;
                if ($product->quantity_in_cart <= 0) {
                    $this->removeProductByProductId($product->id, $product->quantity_in_cart);
                    return null;
                }
                $this->products[$key] = $product;
                return $product;
            }
        }
    }

}

?>