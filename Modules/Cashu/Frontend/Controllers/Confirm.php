<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Confirm.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cashu
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cashu_Frontend_Confirm_Controller extends Amhsoft_System_Web_Controller {

  protected $orderId;
  protected $saleOrder;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->orderId = $this->getRequest()->getId();
    if ($this->orderId > 0) {
      $saleOrderModelAdapter = new Saleorder_Model_Adapter();
      $saleOrderModelAdapter->where("MD5(id) = ?", $this->orderId);
      $this->saleOrder = $saleOrderModelAdapter->fetch()->fetch();
    }
    if (!$this->saleOrder instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Return Event
   */
  public function __return() {
    $this->saleOrder->updateSaleorder(Saleorder_Statse_Model::PENDING, _t('Sales order was Not completed'), @$_POST);
    $this->saleOrder->notifyCanceled();
    Cart_Shoppingcart_Model::getInstance()->reset();
    $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . Amhsoft_Common::encrypt(_t('Your Sales Order was not paid'), 'saleorder'));
  }

  /**
   * Cancel Event
   */
  public function __cancel() {
    $this->saleOrder->updateSaleorder(Saleorder_State_Model::CANCELED, _t('Sales order was canceled by user during payment'), @$_POST);
    $this->saleOrder->notifyCanceled();
    Cart_Shoppingcart_Model::getInstance()->reset();
    $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . Amhsoft_Common::encrypt(_t('Your Sales Order was canceled'), 'saleorder'));
  }

  /**
   * Notify Event
   */
  public function __notify() {
    $status = $this->getRequest()->post('payment_status');
    $payer_status = $this->getRequest()->post('payer_status');
    if ($status == 'Completed' && $payer_status == 'verified') {
      $this->saleOrder->updateSaleorder(Saleorder_State_Model::PAID, _t('Sales order was Paid'), @$_POST);
      Cart_Shoppingcart_Model::getInstance()->reset();
      $this->saleOrder->notifyPaid();
    } else {
      $this->saleOrder->updateSaleorder(Saleorder_State_Model::PENDING, _t('Sales order was not paid'), @$_POST);
      $this->saleOrder->notifyNotPaid();
      Cart_Shoppingcart_Model::getInstance()->reset();
      $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . Amhsoft_Common::encrypt(_t('Your Sales Order was not paid'), 'saleorder'));
    }
  }

  /**
   * Convert To Invoive
   */
  protected function convertInvoice() {
    $invoiceModel = $this->saleOrder->convertToInvoice();
    if ($invoiceModel instanceof Invoice_Model) {
      $this->getRedirector()->go('index.php?module=invoice&page=details&id=' . $invoiceModel->getId() . "&success=true");
    } else {
      $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&success=true");
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
    
  }

}

?>