<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 432 2016-02-15 10:30:04Z montassar.amhsoft $
 * $Rev: 432 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-15 11:30:04 +0100 (lun., 15 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Saleorder_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $number;
    public $total_price;
    public $payment_log;
    public $insertat;
    public $updateat;
    public $discount;
    public $items = array();
    public $policy;
    public $total_discount;
    public $quotation_id;
    public $invoice_address_id;
    public $shipping_address_id;

    const NOTIFICATION_EMAIL_FROM = 'salesorder_notification_email_from';
    const NOTIFICATION_EMAIL_BCCS = 'salesorder_notification_email_bccs';
    const SALEORDER_ADD_NOTIFICATION_TEMPLATE = 16;
    const SALEORDER_REPLY_NOTIFICATION_TEMPLATE = 17;
    const SALEORDER_ADD_ADMIN_NOTIFICATION_TEMPLATE = 17;

    /** @var SaleOrderDiscountTypeModel $sale * */
    public $sale;

    /** @var SaleOrderStateModel $saleOrderState */
    public $saleOrderState;

    /** @var User_User_Model $user * */
    public $user;
    public $creator_name;
    public $payment_method_name;
    public $shipping_method_name;
    public $due_date;
    public $description;

    /** @var Payment_Payment_Model $payement * */
    public $payment;

    /** @var Crm_Account_Model $account */
    public $account;
    public $account_name;
    public $account_email;
    public $account_mobile;
    public $shipping_cost;
    public $currency;
    public $base_currency;
    public $currency_set_id;
    public $documents = array();
    public $shipping_id;
    public $payment_id;

    /** @var Shipping_Shipping_Model $shipping */
    public $shipping;
    public $shippingAddress;
    public $invoiceAddress;
    public $sub_total;
    public $handling_fee;
    public $sale_order_state_id;
    public $user_id;
    public $sale_order_discount_type_id;
    public $account_id;

    const SETTING = 'saleorder';

    /**
     * Sets SaleOrder id.
     * @param Integer $id
     * @return SaleOrderModel
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets SaleOrder id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    public function __get($name) {

        if ($name == 'accountlink') {
            if ($this->account instanceof Crm_Account_Model) {
                return '<a href="admin.php?module=crm&page=account-detail&id=' . $this->account->getId() . '">' . $this->account->getName() . '</a>';
            } else {
                return $this->account_name;
            }
        }
        if ($name = 'saleorderstate') {
            $saleorderstateModelAdapter = new Saleorder_State_Model_Adapter();
            $saleorderstateModelAdapter->where('id=' . $this->sale_order_state_id);
            $saleorderstateModel = $saleorderstateModelAdapter->fetchById($this->sale_order_state_id);
            return($saleorderstateModel->name);
        }
    }

    public function getSale_order_state_id() {
        return $this->sale_order_state_id;
    }

    public function setSale_order_state_id($sale_order_state_id) {
        $this->sale_order_state_id = $sale_order_state_id;
        return $this;
    }

    /**
     * Sets SaleOrder name.
     * @param String $name
     * @return SaleOrderModel
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets SaleOrder name.
     * @return String $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets SaleOrder number.
     * @param String $number
     * @return SaleOrderModel
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * Gets SaleOrder number.
     * @return String $number
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Sets SaleOrder price.
     * @param String $price
     * @return SaleOrderModel
     */
    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
        return $this;
    }

    /**
     * Gets SaleOrder price.
     * @return String $price
     */
    public function getTotalPrice() {
        return $this->total_price;
    }

    /**
     * Sets SaleOrder payment_log.
     * @param String $payment_log
     * @return SaleOrderModel
     */
    public function setPaymentLog($payment_log) {
        $this->payment_log = $payment_log;
        return $this;
    }

    /**
     * Gets SaleOrder payment_log.
     * @return String $payment_log
     */
    public function getPaymentLog() {
        return $this->payment_log;
    }

    /**
     * Sets SaleOrder creator_name.
     * @param String $creator_name
     * @return SaleOrderModel
     */
    public function setCreatorName($creator_name) {
        $this->creator_name = $creator_name;
        return $this;
    }

    /**
     * Gets SaleOrder creator_name.
     * @return String $creator_name
     */
    public function getCreatorName() {
        return $this->creator_name;
    }

    /**
     * Sets SaleOrder payment_method_name.
     * @param String $payment_method_name
     * @return SaleOrderModel
     */
    public function setPaymentMethodName($payment_method_name) {
        $this->payment_method_name = $payment_method_name;
        return $this;
    }

    /**
     * Gets SaleOrder payment_method_name.
     * @return String $payment_method_name
     */
    public function getPaymentMethodName() {
        return $this->payment_method_name;
    }

    /**
     * Sets  SaleOrder shipping_method_name.
     * @param String $shipping_method_name
     * @return SaleOrderModel
     */
    public function setShippingMethodName($shipping_method_name) {
        $this->shipping_method_name = $shipping_method_name;
        return $this;
    }

    /**
     * Gets SaleOrder shipping_method_name.
     * @return String $shipping_method_name
     */
    public function getShippingMethodName() {
        return $this->shipping_method_name;
    }

    /**
     * Sets SaleOrder due_date.
     * @param String $due_date
     * @return SaleOrderModel
     */
    public function setDueDate($due_date) {
        $this->due_date = $due_date;
        return $this;
    }

    /**
     * Gets SaleOrder due_date.
     * @return String $due_date
     */
    public function getDueDate() {
        return $this->due_date;
    }

    /**
     * Sets SaleOrder description.
     * @param String $description
     * @return SaleOrderModel
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets SaleOrder description.
     * @return String $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Gets SaleOrder sale.
     * @return SaleOrderDiscountTypeModel $sale
     */
    public function getSale() {
        return $this->sale;
    }

    /**
     * Sets SaleOrder sale
     * @param SaleOrderDiscountTypeModel $sale
     * @return SaleOrderModel 
     */
    public function setSale(Saleorder_Discount_Type_Model $sale) {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Gets SaleOrder user.
     * @return UserModel $user
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Sets SaleOrder user.
     * @param UserModel $user
     * @return SaleOrderModel 
     */
    public function setUser(User_Model $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Gets SaleOrder account.
     * @return Crm_Account_Model $account
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * Sets SaleOrder account.
     * @param Crm_Account_Model $account
     * @return Saleorder_Model 
     */
    public function setAccount(Crm_Account_Model $account) {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets SaleOrder payment.
     * @return PaymentModel $payment
     */
    public function getPayment() {
        return $this->payment;
    }

    /**
     * Sets SaleOrder sale.
     * @param PaymentModel $payment
     * @return SaleOrderModel 
     */
    public function setPayment(Payment_Payment_Model $payment) {
        $this->payment = $payment;
        return $this;
    }

    public function getLocaleInsertAt() {
        return Amhsoft_Locale::DateTime($this->insertat);
    }

    public function getLocaleUpdateAt() {
        return Amhsoft_Locale::DateTime($this->updateat);
    }

    /**
     * Gets SaleOrder insertat.
     * @return String $insertAt 
     */
    public function getInsertAt() {
        return $this->insertat;
    }

    /**
     * Sets SaleOrder insertat.
     * @param String $insertAt
     * @return SaleOrderModel 
     */
    public function setInsertAt($insertAt) {
        $this->insertat = $insertAt;
        return $this;
    }

    /**
     * Gets SaleOrder updateat.
     * @return String $updateAt
     */
    public function getUpdateAt() {
        return $this->updateat;
    }

    /**
     * Sets SaleOrder updatat.
     * @param type $updateAt
     * @return SaleOrderModel 
     */
    public function setUpdateAt($updateAt) {
        $this->updateat = $updateAt;
        return $this;
    }

    /**
     * Gets SaleOrder discount.
     * @return Integer $discount 
     */
    public function getDiscount() {
        return $this->discount;
    }

    /**
     * Sets SaleOrder discount.
     * @param Integer $discount
     * @return SaleOrderModel 
     */
    public function setDiscount($discount) {
        $this->discount = $discount;
        return $this;
    }

    public function getPolicy() {
        return $this->policy;
    }

    public function setPolicy($policy) {
        $this->policy = $policy;
        return $this;
    }

    public function getItems() {
        return (array) $this->items;
    }

    public function addItem(Saleorder_Item_Model $item) {
        $this->items[] = $item;
    }

    public function __toString() {
        return $this->getName();
    }

    public function getDocuments() {
        return $this->documents;
    }

    public function getOnlineDocuments() {
        $docs = array();
        foreach ($this->getDocuments() as $doc) {
            if ($doc->public) {
                $docs[] = $doc;
            }
        }
        return $docs;
    }

    public function addDocument(Saleorder_Document_Model $documents) {
        $this->documents[] = $documents;
    }

    /**
     * Gets SaleOrder state.
     * @return SaleOrderStateModel $saleOrderState 
     */
    public function getSaleOrderState() {
        return $this->saleOrderState;
    }

    /**
     * Sets SaleOrder state.
     * @param SaleOrderStateModel $saleOrderState
     * @return SaleOrderModel 
     */
    public function setSaleOrderState($saleOrderState) {
        $this->saleOrderState = $saleOrderState;
        return $this;
    }

    /**
     * Sets shipping address.
     * @param Saleorder_Address_Model $shippingAddress
     * @return Saleorder_Model
     */
    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * Gets shipping address.
     * @return Saleorder_Shipping_Address_Model shipping address
     */
    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    /**
     * Sets invoice address.
     * @param Saleorder_Address_Model $invoiceAddress
     * @return Saleorder_Model
     */
    public function setInvoiceAddress($invoiceAddress) {
        $this->invoiceAddress = $invoiceAddress;
        return $this;
    }

    /**
     * Gets invoice address.
     * @return Saleorder_Address_Model invoice address.
     */
    public function getInvoiceAddress() {
        return $this->invoiceAddress;
    }

    public function getAccountName() {
        return $this->account_name;
    }

    public function setAccountName($account_name) {
        $this->account_name = $account_name;
    }

    public function getAccountEmail() {
        return $this->account_email;
    }

    public function setAccountEmail($account_email) {
        $this->account_email = $account_email;
    }

    public function getAccountMobile() {
        return $this->account_mobile;
    }

    public function setAccountMobile($account_mobile) {
        $this->account_mobile = $account_mobile;
    }

    public function getShippingCost() {
        return $this->shipping_cost;
    }

    public function setShippingCost($shipping_cost) {
        $this->shipping_cost = $shipping_cost;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function getBaseCurrency() {
        return $this->base_currency;
    }

    public function setBaseCurrency($base_currency) {
        $this->base_currency = $base_currency;
    }

    public function getCurrencySetId() {
        return $this->currency_set_id;
    }

    public function setCurrencySetId($currency_set_id) {
        $this->currency_set_id = $currency_set_id;
    }

    public function getSubTotal() {
        return $this->sub_total;
    }

    public function setSubTotal($sub_total) {
        $this->sub_total = $sub_total;
    }

    public function getHandlingFee() {
        return $this->handling_fee;
    }

    public function setHandlingFee($handling_fee) {
        $this->handling_fee = $handling_fee;
    }

//    public function fixPrices() {
//        $this->sub_total = 0;
//        foreach ($this->getItems() as $item) {
//            $this->sub_total += $item->getSubTotal();
//        }
//        $this->discount = 0;
//        foreach ($this->getItems() as $item) {
//            $this->discount += $item->getDiscount();
//        }
//        $this->total_price = $this->sub_total - $this->discount + $this->shipping_cost;
//        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
//        $saleOrderModelAdapter->save($this);
//    }

    public function getNextSaleOrderNumber() {
        $orderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $prefix = $orderConfiguration->getValue('prefix', 'SO');
        $start = $orderConfiguration->getValue('start', 1);

        $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM sale_order WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
        if (!$lastNumber) {
            return $prefix . $start;
        } else {
            $lastNumberAsInt = str_replace($prefix, '', $lastNumber);
            if ($lastNumberAsInt >= $start) {
                $lastNumberAsInt = intval($lastNumberAsInt) + 1;
                return $prefix . $lastNumberAsInt;
            } else {
                return $prefix . $start;
            }
        }
    }

    public static function Qualify($attribute, $default = null) {
        $form = new Saleorder_Form();
        if ($attribute == 'payment') {
            $element = clone $form->paymentListBox;
            $element->Id = 'condition_right';
            $element->Name = 'condition_right';
            $element->Required = true;
            $element->Value = $default;
            return $element->Render();
        }
        if ($attribute == 'saleOrderState') {
            $element = clone $form->saleOrderStateInput;
            $element->Id = 'condition_right';
            $element->Name = 'condition_right';
            $element->Required = true;
            $element->Value = $default;
            return $element->Render();
        }

        if ($attribute == 'insertat') {
            $element = new Amhsoft_ListBox_Control('condition_right');
            $element->DataSource = new Amhsoft_Data_Set(array('_TODAY_', '_THIS_MONTH_', '_THIS_WEEK_'));
            $element->Required = true;
            $element->Value = $default;
            return $element->Render();
        }

        return null;
        exit;
    }

    /**
     * Gets Count of Quantity of all items.
     * @return int $count 
     */
    public function getItemsCount() {
        $count = 0;
        foreach ($this->getItems() as $item) {
            $count += $item->quantity;
        }
        return $count;
    }

    /**
     * Calculate subtotal: smme unit prices
     * @return double
     */
    public function calculateSubTotal() {
        $this->sub_total = 0;
        foreach ($this->getItems() as $item) {
            $this->sub_total += $item->getUnitPrice() * $item->getQuantity();
        }

        return $this->sub_total;
    }

    public function calculateTotalDiscount() {
        $saleorderdiscount = 0;
        if ($this->discount) {
            if (substr($this->discount, -1) == '%') {
                $saleorderdiscount = $this->calculateSubTotal() / 100 * (double) $this->discount;
            } else {
                $saleorderdiscount = (double) $this->discount;
            }
        }

        $itemsDiscount = 0;
        foreach ($this->getItems() as $item) {
            $itemsDiscount += $item->getAmountDiscount();
        }

        return $this->total_discount = $saleorderdiscount + $itemsDiscount;
    }

    public function calculateShippingCost() {
        $adapter = new Shipping_Shipping_Model_Adapter();

        if (intval($this->shipping_id) <= 0) {
            return $this->shipping_cost;
        }
        $model = $adapter->fetchById($this->shipping_id);
        if (!$model instanceof Shipping_Shipping_Model) {
            return;
        }

        $this->shipping_cost = 0;
        if (!$this->shippingAddress) {
            return;
        }
        if (in_array('ALL', $model->countries) || in_array($this->shippingAddress->getCountry(), $model->countries)) {

            $model->shipping_cost = 0;
            if ($model->shipping_type_id == 1) { //free
                return $this->shipping_cost = 0;
            }

            if ($model->shipping_type_id == 2) { //flaterate
                if ($model->cost_type == 1) { //per item
                    $this->shipping_cost = $model->cost * $this->getItemsCount();
                }
                if ($model->cost_type == 2) { //per cart
                    $this->shipping_cost = $model->cost;
                }

                if ($model->packaging_cost_type == 1) { //per item
                    $this->shipping_cost += $model->packaging_cost * $this->getItemsCount();
                }


                if ($model->packaging_cost_type == 2) { //per cart
                    $this->shipping_cost += $model->packaging_cost;
                }
                return $this->shipping_cost;
            }
        } else {
            return $this->shipping_cost = 0;
        }
    }

    public function calculateHandlingFee() {
        if ($this->payment instanceof Payment_Payment_Model) {
            $this->handling = intval($this->payment->fee);
            return $this->handling_fee;
        } else {
            return $this->handling_fee = 0;
        }
    }

    public function reCalculatePrices() {
        return $this->total_price = $this->calculateSubTotal() - $this->calculateTotalDiscount() + $this->calculateShippingCost() + $this->calculateHandlingFee();
    }

    public static function reCalculateAnsSavePricesId($id) {
        if (intval($id) <= 0) {
            throw new Exception('Sale order not found');
        }
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $model = $saleOrderModelAdapter->fetchById($id);
        if (!$model instanceof Saleorder_Model) {
            throw new Exception('Sale order not found');
        }
        $model->reCalculatePrices();
        $saleOrderModelAdapter->save($model);
    }

    public function fixLanguages() {
        try {
//get current lang
            $oldLang = Amhsoft_Registry::get('current_lang');

//get available langs
            $langs = Amhsoft_System::getAvailableLang();

//unset the current lang
            $index = array_search($oldLang, $langs);
            if ($index !== false) {
                unset($langs[$index]);
            }


            foreach ($langs as $langName => $langIso2) {

                Amhsoft_Registry::register('current_lang', $langIso2);
                $saleOrderAdapter = new Saleorder_Model_Adapter();

                $cart = Cart_Shoppingcart_Model::getInstance();
                $this->setName(_t('Online Order %s', $this->creator_name));

                $this->setPaymentMethodName($cart->getPaymentMethod()->getName());
                $this->setShippingMethodName($cart->getShippingMethod()->getTitle());
                $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
                $policy = $saleOrderConfiguration->getValue('sale_order_policy', null);
                $this->setPolicy($policy);
                $saleOrderAdapter->save($this);

                $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
                $saleOrderItemModelAdapter->where('sale_order_id = ?', $this->getId());
                //translate sale order items
                foreach ($saleOrderItemModelAdapter->fetch() as $saleOrderItemModel) {
                    $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
                    $saleOrderItemModel = $saleOrderItemModelAdapter->fetchById($saleOrderItemModel->getId());
                    $saleOrderItemModel->setItemName($saleOrderItemModel->getProduct()->getTitle());
                    $saleOrderItemModel->setItemDescription(implode("\n", $saleOrderItemModel->getProduct()->getAttributeLabeledValues()));
                    $saleOrderItemModelAdapter->save($saleOrderItemModel);
                }
            }
            Amhsoft_Registry::register('current_lang', $oldLang);
        } catch (Exception $e) {
            var_dump($e);
            exit;
            return null;
        }
    }

    /**
     * Convert Saleorder to Invoice.
     * @return Invoice_Model
     */
    public function convertToInvoice() {
        $db = Amhsoft_Database::newInstance();
        $db->beginTransaction();
        try {
            $InvoiceConfiguration = new Amhsoft_Config_Table_Adapter('Invoice');
            $invoiceModel = new Invoice_Model();
            $invoiceModel->account_id = $this->account_id;
            $invoiceModel->setAccountEmail($this->getAccountEmail());
            $invoiceModel->setAccountMobile($this->getAccountMobile());
            $invoiceModel->setAccountName($this->getAccountName());
            $invoiceModel->setCreatorName($this->getCreatorName());
            $invoiceModel->setBaseCurrency($this->getBaseCurrency());
            $invoiceModel->setCurrency($this->getCurrency());
            $invoiceModel->setCurrencySetId($this->getCurrencySetId());
            $invoiceModel->setDescription($this->getDescription());
            $invoiceModel->setDiscount($this->getDiscount());
            $invoiceModel->setDueDate($this->getDueDate());
            $invoiceModel->setHandlingFee($this->getHandlingFee());
            $invoiceModel->setInsertAt($this->getInsertAt());
            $invoiceModel->setInvoiceAddress($this->getInvoiceAddress());
            $invoiceModel->setName($this->getName());
            $invoiceModel->setNumber($invoiceModel->getNextInvoiceNumber());
            $invoiceModel->setPaymentLog($this->getPaymentLog());
            $invoiceModel->setPaymentMethodName($this->getPaymentMethodName());
            $invoiceModel->setPolicy($this->getPolicy());
            if ($InvoiceConfiguration->getValue(Invoice_State_Model::CREATED) > 0) {
                $invoiceModel->setInvoiceState($InvoiceConfiguration->getValue(Invoice_State_Model::CREATED));
                $invoiceModel->invoice_state_id = $InvoiceConfiguration->getValue(Invoice_State_Model::CREATED);
            }

            if ($this->getShippingAddress()) {
                $adress = new Invoice_Address_Model();
                $adress->setCity($this->getShippingAddress()->getCity());
                $adress->setCountry($this->getShippingAddress()->getCountry());
                $adress->setName($this->getShippingAddress()->getName());
                $adress->setProvince($this->getShippingAddress()->getProvince());
                $adress->setZipCode($this->getShippingAddress()->getZipCode());
                $adapter = new Invoice_Address_Model_Adapter();
                $adapter->setDbAdapter($db);
                $adapter->save($adress);
                $invoiceModel->setShippingAddress($adress);
            }

            if ($this->getInvoiceAddress()) {
                $adress = new Invoice_Address_Model();
                $adress->setCity($this->getShippingAddress()->getCity());
                $adress->setCountry($this->getShippingAddress()->getCountry());
                $adress->setName($this->getShippingAddress()->getName());
                $adress->setProvince($this->getShippingAddress()->getProvince());
                $adress->setZipCode($this->getShippingAddress()->getZipCode());
                $adapter = new Invoice_Address_Model_Adapter();
                $adapter->setDbAdapter($db);
                $adapter->save($adress);
                $invoiceModel->setInvoiceAddress($adress);
            }
            $invoiceModel->setShippingCost($this->getShippingCost());
            $invoiceModel->setShippingMethodName($this->getShippingMethodName());
            $invoiceModel->setSubTotal($this->getSubTotal());
            $invoiceModel->setTotalPrice($this->getTotalPrice());
            $invoiceModel->setUpdateAt($this->getUpdateAt());
            $invoiceModel->user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
            $invoiceModelAdapter = new Invoice_Model_Adapter();
            $invoiceModelAdapter->setDbAdapter($db);
            $invoiceModel->sale_order_id = $this->getId();
            $invoiceModelAdapter->save($invoiceModel);
            $invoiceItemModelAdapter = new Invoice_Item_Model_Adapter();
            if ($invoiceModel->getId()) {
                foreach ($this->getItems() as $item) {
                    $invoiceItem = new Invoice_Item_Model();
                    $invoiceItem->setItemDescription($item->getItemDescription());
                    $invoiceItem->setDiscount($item->getDiscount());
                    $invoiceItem->setItemName($item->getItemName());
                    $invoiceItem->setItemNumber($item->getItemNumber());
                    if ($item->getProduct()) {
                        $invoiceItem->setProduct($item->getProduct());
                    }
                    $invoiceItem->setProductNumber($item->getProductNumber());
                    $invoiceItem->setQuantity($item->getQuantity());
                    $invoiceItem->setSubTotal($item->getSubTotal());
                    $invoiceItem->setUnitPrice($item->getUnitPrice());
                    $invoiceItem->invoice_id = $invoiceModel->getId();
                    $invoiceItemModelAdapter->setDbAdapter($db);
                    $invoiceItemModelAdapter->save($invoiceItem);
                }
            }
            $db->commit();
            return $invoiceModel;
        } catch (Exception $transactionException) {
            Amhsoft_Log::error($transactionException->getMessage());
            $db->rollBack();
        }
    }

    public function updateSaleorder($state, $message, $post = null) {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $this->sale_order_state_id = $state;
        $this->payment_log = $message . "<br />";
        $this->payment_log .= var_export($post, true);

        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->save($this);
    }

    public function notifyPaid() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $templateModel = $this->getTemplate(Saleorder_State_Model::PAID_EMAIL_NOTIFICATION);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this)));
        } else {
            $subject = _t('Your sales order was paid');
            $content = _t('Your Sales order was paid');
        }
        $email = $saleOrderConfiguration->getValue('salesorder_notification_email_from');
        $customer_email = $this->account->getEmail1();
        $this->sendEmail($email, $customer_email, $subject, $content);
    }

    /**
     * Gets Email Template By State.
     * @param type $state
     * @return type
     */
    public function getTemplate($state) {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $templateID = $saleOrderConfiguration->getValue($state);
        $emailTemplateModel = null;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
        }
        return $emailTemplateModel;
    }

    public function notifyCanceled() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $templateModel = $this->getTemplate(Saleorder_State_Model::CANCELED_EMAIL_NOTIFICATION);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this)));
        } else {
            $subject = _t('Your sales order was canceled');
            $content = _t('Your Sales order was canceled');
        }
        $email = $saleOrderConfiguration->getValue('salesorder_notification_email_from');
        $customer_email = $this->account->getEmail1();
        $this->sendEmail($email, $customer_email, $subject, $content);
    }

    public function notifyNotPaid() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $templateModel = $this->getTemplate(Saleorder_State_Model::CANCELED);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this)));
        } else {
            $subject = _t('Your sales order was not paid');
            $content = _t('Your Sales order was not paid');
        }
        $email = $saleOrderConfiguration->getValue('salesorder_notification_email_from');
        $customer_email = $this->account->getEmail1();

        $this->sendEmail($email, $customer_email, $subject, $content);
    }

    /**
     * Send Email .
     * @param type $to
     * @param type $from
     * @param type $subject
     * @param type $message
     */
    public function sendEmail($to, $customer_email, $subject, $message) {
        $data = Webmail_Setting_Model::getMailClientOptionsById($to);
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $from = $data['From'];
        $to = $data['From'];

        $mailClient = new Amhsoft_Mail_Client($data);
        $mailClient->AddAddress($from);
        $mailClient->AddAddress($customer_email);
        $mailClient->setSubject($subject);
        $mailClient->SetFrom($from);
        $mailClient->SetHtmlBody($message);
        $mailClient->Send();
        if ($mailClient->IsError()) {
            Amhsoft_Log::error("cannot send email  $to , $subject , $message");
        }
    }

    /**
     * Decrement Saleorder Quantity.
     * @param Cart_Shoppingcart_Model $cart
     * @return type
     */
    public function decrementQuantity() {
        $productConfiguration = new Amhsoft_Config_Table_Adapter('product');
        $stock = $productConfiguration->getValue('stock_enable_auto_stk_management', 0);
        if (!$stock) {
            return;
        }
        $decrementDbAdapter = Amhsoft_Database::newInstance();
        $decrementDbAdapter->beginTransaction();

        foreach ($this->getItems() as $item) {
            if (!$item->item_id) {
                continue;
            }
            try {
                Product_Product_Model::liveDecrementQuantity($decrementDbAdapter, $item->item_id, $item->getQuantity());
            } catch (Exception $exp1) {
                
            }
        }
        try {
            $decrementDbAdapter->commit();
        } catch (Exception $e) {
            Amhsoft_Log::error($e->getMessage());
        }
    }

    /*
      public function getPaymentLink(){
      if( $this->getPayment()){

      $paymentModuleName = $this->getPayment()->getModulename();
      if ($paymentModuleName != null) {
      return 'index.php?module=' . strtolower($paymentModuleName) . '&page=index&id=' . $this->getId();
      }

      }
      return null;
      } */

    public function incrementQuantity() {
        $incrementDbAdapter = Amhsoft_Database::newInstance();
        $incrementDbAdapter->beginTransaction();

        foreach ($this->getItems() as $item) {
            if (!$item->item_id) {
                continue;
            }
            try {
                Product_Product_Model::liveIncrementQuantity($incrementDbAdapter, $item->item_id, $item->getQuantity());
            } catch (Exception $exp2) {
                Amhsoft_Log::error($e->getMessage());
            }
        }
        try {
            $incrementDbAdapter->commit();
        } catch (Exception $e) {
            Amhsoft_Log::error($e->getMessage());
        }
    }

    public function isCanceled() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $saleOrderConfiguration->getValue(Saleorder_State_Model::CANCELED);
        return $this->sale_order_state_id == $saleOrderConfiguration->getValue(Saleorder_State_Model::CANCELED);
    }

    public function isPaid() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $saleOrderConfiguration->getValue(Saleorder_State_Model::PAID);
        return $this->sale_order_state_id == $saleOrderConfiguration->getValue(Saleorder_State_Model::PAID);
    }

    public function getQuotation_id() {
        return $this->quotation_id;
    }

    public function setQuotation_id($quotation_id) {
        $this->quotation_id = $quotation_id;
    }

    public function showFrontendLinks() {
        $show = false;
        if ($this->sale_order_state_id != Saleorder_State_Model::CANCELED || $this->sale_order_state_id != Saleorder_State_Model::PAID) {
            $show = true;
        }

        return $show;
    }

    public function isLocked() {
        return $this->sale_order_state_id == Saleorder_State_Model::CLOSED;
    }

    public function isRefund() {
        return false;
    }

}

?>