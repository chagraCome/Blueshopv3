<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Payment.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Service_Payment_Controller extends Cart_Frontend_Checkout_Payment_Controller {

  /** @var PaymentModelAdapter $paymentModelAdapter */
  protected $paymentModelAdapter;
  protected $payment_id;

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $auth = Amhsoft_Authentication::getInstance();
    if (!$auth->isAuthenticated()) {
      $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
    }
    $cart = Cart_Shoppingcart_Model::getInstance();
    if ($cart->isEmpty()) {
      $this->getRedirector()->go('index.php?module=cart&page=list');
    }
    $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
    $this->payment_id = $this->getRequest()->postInt('payment_id');
    if ($this->getRequest()->post('continue')) {
      if ($this->payment_id > 0) {
	$paymentModelAdapter = new Payment_Payment_Model_Adapter();
	$paymentMehtod = $paymentModelAdapter->fetchById($this->payment_id);
	if ($paymentMehtod instanceof Payment_Payment_Model) {
	  $cart->setPaymentMethod($paymentMehtod);
	  $cart->Persist();
	  $this->getRedirector()->go('index.php?module=cart&page=checkout-service-preview');
	} else {
	  $this->getView()->assign('error_message', _t('Selected payment method was deleted, please contact shop owner'));
	}
      } else {
	$this->getView()->assign('error_message', _t('Please select a payment method'));
      }
    }
    if ($cart->getPaymentMethod()) {
      $this->getView()->assign('selectedpayment', $cart->getPaymentMethod()->getId());
    }
  }

}

?>
