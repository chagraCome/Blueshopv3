<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Index.php 470 2016-03-07 13:04:30Z montassar.amhsoft $
 * $Rev: 470 $
 * @package    Payfort
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-03-07 14:04:30 +0100 (lun., 07 mars 2016) $
 * $Author: montassar.amhsoft $
 */
class Payfort_Frontend_Index_Controller extends Amhsoft_System_Web_Controller {

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
        $paymentModelAdapter->where("modulename = ?", 'Payfort');
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
        $payfortConfiguration = new Amhsoft_Config_Table_Adapter('payfort');
        $pspid = $payfortConfiguration->getValue('payfort_pspid');
        $currency = $payfortConfiguration->getValue('payfort_currency');
        $amount_total = Amhsoft_Currency_Converter::tableConvert($this->saleOrder->getTotalPrice(), $currency);
        $lang = $payfortConfiguration->getValue('payfort_language');
        $appUrl = Amhsoft_System_Config::getProperty("appurl");
        $appUrl = rtrim($appUrl, '/') . '/';
        $userid = ''; //;$payfortConfiguration->getValue('payfort_userid');
        $Inpassphrase = $payfortConfiguration->getValue('payfort_Inpassphrase');
        $Outpassphrase = $payfortConfiguration->getValue('payfort_Outpassphrase');


        $paymentAbstractModel = new Payment_Abstract_Model();
        $paymentAbstractModel->setWaitMessage("Please Wait");
        $paymentAbstractModel->setProductionUrl('https://secure.payfort.com/ ncol/prod/orderstandard.asp');
        $paymentAbstractModel->setSandBoxUrl('https://secure.payfort.com/ncol/test/orderstandard.asp');
        $paymentAbstractModel->setTestMode($payfortConfiguration->getValue('test_mode')); //from setting
        $paymentAbstractModel->addField('PSPID', $pspid);
        $paymentAbstractModel->addField('ORDERID', $this->saleOrder->getNumber());

        $paymentAbstractModel->addField('AMOUNT', $amount_total * 100);
        $paymentAbstractModel->addField('CURRENCY', $currency);
        $paymentAbstractModel->addField('LANGUAGE', $lang);
        $paymentAbstractModel->addField('EMAIL', $this->saleOrder->getAccountEmail());
        $paymentAbstractModel->addField('OWNERZIP', $this->saleOrder->getAccount()->getZipcode());
        $paymentAbstractModel->addField('OWNERADDRESS', $this->saleOrder->getAccount()->getStreet());
        $paymentAbstractModel->addField('OWNERCTY', $this->saleOrder->getAccount()->getCity());
        $paymentAbstractModel->addField('OWNERTOWN', $this->saleOrder->getAccount()->getProvince());


        $_shasign_string = 'AMOUNT=' . $amount_total . $Inpassphrase .
                'CURRENCY=' . $currency . $Inpassphrase .
                'LANGUAGE=' . $lang . $Inpassphrase .
                'ORDERID=' . $this->saleOrder->getNumber() . $Inpassphrase .
                'PSPID=' . $pspid . $Inpassphrase;
        $_shasign = sha1($_shasign_string);

        $paymentAbstractModel->addField('SHASIGN', $_shasign);
        $paymentAbstractModel->addField('TITLE', $this->saleOrder->getName());

        $paymentAbstractModel->addField('PM', 'CreditCard');
        $paymentAbstractModel->addField('BRAND', ''); //All credit card


        $paymentAbstractModel->addField('PMLIST', ''); //all payments
        $paymentAbstractModel->addField('WIN3DS', 'MAINW'); //it can be POPUP
        $paymentAbstractModel->addField('USERID', $userid);

        $paymentAbstractModel->addField('BACKURL', $appUrl . 'index.php?module=cart&page=checkout-preview&id=' . $this->saleOrder->getId()); //All credit card
        //$paymentAbstractModel->addField('return', $appUrl . 'index.php?module=payfort&page=confirm&event=return&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('ACCEPTURL', $appUrl . 'index.php?module=payfort&page=confirm&notify&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('CANCELURL', $appUrl . 'index.php?module=payfort&page=confirm&event=cancel&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('DECLINEURL', $appUrl . 'index.php?module=payfort&page=confirm&event=cancel&hash=' . $this->hashedKEY);
        $paymentAbstractModel->addField('EXCEPTIONURL', $appUrl . 'index.php?module=payfort&page=confirm&event=cancel&hash=' . $this->hashedKEY);

        $i = 1;

        foreach ($this->saleOrder->getItems() as $item) {

            $paymentAbstractModel->addField('ITEMID' . $i, $item->getId());
            $paymentAbstractModel->addField('ITEMNAME' . $i, $item->getItemName());
            $paymentAbstractModel->addField('ITEMQUANT' . $i, $item->getQuantity());
            $paymentAbstractModel->addField('ITEMPRICE' . $i, Amhsoft_Currency_Converter::tableConvert($item->getUnitPrice(), $currency) * 100);
            $paymentAbstractModel->addField('ITEMVATCODE' . $i, '');
            $i++;
        }
        $paymentAbstractModel->invokeAsHtml();
        exit;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>
