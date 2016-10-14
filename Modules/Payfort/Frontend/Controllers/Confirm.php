<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Confirm.php 470 2016-03-07 13:04:30Z montassar.amhsoft $
 * $Rev: 470 $
 * @package    Payfort
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-03-07 14:04:30 +0100 (lun., 07 mars 2016) $
 * $Author: montassar.amhsoft $
 */
class Payfort_Frontend_Confirm_Controller extends Amhsoft_System_Web_Controller {

    protected $orderId;
    protected $saleOrder;
    protected $hashedKEY;
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

        $this->hashedKEY = $this->getRequest()->get('hash');
        if ($this->hashedKEY) {
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $saleOrderModelAdapter->where("sha1(id) = ?", addslashes($this->hashedKEY), PDO::PARAM_STR);
            $this->saleOrder = $saleOrderModelAdapter->fetch()->fetch();
            $this->orderId = $this->saleOrder->getId();
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
    }

    /**
     * Return event
     */
    public function __return() {
        $this->saleOrder->updateSaleorder(Saleorder_State_Model::SEND, _t('Sales order was Not completed'), @$_POST);
        Cart_Shoppingcart_Model::getInstance()->reset();
        $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was not paid'));
    }

    /**
     * Cancel event
     */
    public function __cancel() {
        $this->saleOrder->updateSaleorder(Saleorder_State_Model::CANCELED, _t('Sales order was canceled by user during payment'), @$_POST);
        $this->saleOrder->notifyCanceled();
        Cart_Shoppingcart_Model::getInstance()->reset();
        $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was canceled'));
    }

    /**
     * Notify event
     */
    public function __notify() {
        $status = $this->getRequest()->post('payment_status');
        $payer_status = $this->getRequest()->post('payer_status');
        if ($status == 4 || $payer_status == 5 || $payer_status == 9) {
            $this->saleOrder->updateSaleorder(Saleorder_State_Model::PAID, _t('Sales order was Paid'), @$_POST);
            Cart_Shoppingcart_Model::getInstance()->reset();
            $this->saleOrder->notifyPaid();
        } else {
            $this->saleOrder->updateSaleorder(Saleorder_State_Model::CANCELED, _t('Sales order was not paid'), @$_POST);
            $this->saleOrder->notifyNotPaid();
            Cart_Shoppingcart_Model::getInstance()->reset();
            $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was not paid'));
        }
    }

    protected function convertInvoice() {
        $invoiceModel = $this->saleOrder->convertToInvoice();
        if ($invoiceModel instanceof Invoice_Model) {
            $this->getRedirector()->go('index.php?module=invoice&page=details&id=' . $invoiceModel->getId() . "&success=true");
        } else {
            $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&success=true");
        }
    }

    /**
     * Default event
     */
    public function __default() {
        
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>