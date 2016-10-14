<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Index.php 470 2016-03-07 13:04:30Z montassar.amhsoft $
 * $Rev: 470 $
 * @package    Paypal
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-03-07 14:04:30 +0100 (lun., 07 mars 2016) $
 * $Author: montassar.amhsoft $
 */
class Paypal_Frontend_Index_Controller extends Amhsoft_System_Web_Controller {

    protected $orderId;
    protected $hashedKEY;

    /** @var Saleorder_Model $saleOrder */
    protected $saleOrder;
    protected $account_id;

    /**
     * Initialize event
     */
    public function __initialize() {

        $paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $paymentModelAdapter->where("modulename = ?", 'Paypal');
        $paymentModelAdapter->where("online = 1");

        $paymentModel = $paymentModelAdapter->fetch()->fetch();

        if (!$paymentModel instanceof Payment_Payment_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->orderId = $this->getRequest()->getId();
        if ($this->orderId > 0) {
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $this->saleOrder = $saleOrderModelAdapter->fetchById($this->orderId);
        }

        if (!$this->saleOrder instanceof Saleorder_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $this->account_id = $auth->getObject()->id;
        } else {
            $cart = Cart_Shoppingcart_Model::getInstance();
            $this->account_id = $cart->account_id;
        }

        if ($this->saleOrder->account->id != $this->account_id) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->hashedKEY = sha1($this->saleOrder->getId());
    }

    /**
     * Default event
     */
    public function __default() {
        $paypalConfiguration = new Amhsoft_Config_Table_Adapter('paypal');
        $paymentAbstractModel = new Payment_Abstract_Model();
        $paymentAbstractModel->setWaitMessage("Please Wait");
        $paymentAbstractModel->setProductionUrl('https://www.paypal.com/cgi-bin/webscr');
        $paymentAbstractModel->setSandBoxUrl('https://www.sandbox.paypal.com/cgi-bin/webscr');
        $paymentAbstractModel->setTestMode($paypalConfiguration->getValue('test_mode')); //from setting
        $paymentAbstractModel->addField('cmd', '_cart');
        $paymentAbstractModel->addField('country', 'US');
        $paymentAbstractModel->addField('upload', '1');
        $paymentAbstractModel->addField('rm', '2');
        $paymentAbstractModel->addField('redirect_cmd', '_xclick');
        $paymentAbstractModel->addField('charset', 'utf-8');
        $paymentAbstractModel->addField('business', $paypalConfiguration->getValue('business')); //setting paypal email
        $currency = $paypalConfiguration->getValue('paypal_currency'); //from setting
        $paymentAbstractModel->addField('currency_code', $currency); //setting paypal currency
        $paymentAbstractModel->addField('return', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=paypal&page=confirm&event=return&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('notify_url', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=paypal&page=confirm&notify&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('cancel_return', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=paypal&page=confirm&event=cancel&hash=' . $this->hashedKEY);
        $i = 1;


        foreach ($this->saleOrder->getItems() as $item) {

            $paymentAbstractModel->addField('item_name_' . $i, $item->getItemName());
            $paymentAbstractModel->addField('quantity_' . $i, $item->getQuantity());
            $paymentAbstractModel->addField('amount_' . $i, Amhsoft_Currency_Converter::tableConvert($item->getUnitPrice(), $currency));
            $i++;
        }
        $paymentAbstractModel->addField('shipping_1', Amhsoft_Currency_Converter::tableConvert($this->saleOrder->getShippingCost(), $currency));
        $paymentAbstractModel->invokeAsHtml();
        exit;
        echo "yes";
        exit;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>
