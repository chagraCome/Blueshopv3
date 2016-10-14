<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Paynow.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Paynow_Controller extends Amhsoft_System_Web_Controller {

  /** @var PaymentModelAdapter $paymentModelAdapter */
  protected $paymentModelAdapter;
  protected $payment_id;
  protected $saleOrderModelAdapter;
  protected $saledOrderModel;
  protected $account_id;
  protected $id;

  /**
   * Initialize Event
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getInt('id');
    $this->setBreadCrumb(array('link' => 'index.php?module=cart&page=paynow&id='.$this->id, 'label' => _t('Pay Now')));
    if (intval($this->id) > 0) {
      $auth = Amhsoft_Authentication::getInstance();
      if ($auth->isAuthenticated()) {
	$this->account_id = $auth->getObject()->id;
      } else {
	Amhsoft_Registry::register('after_login', 'index.php?module=cart&page=paynow&type=so&id=' . $this->id);
	$this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
      }
      $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
      $this->saleOrderModelAdapter->where('account_id = ' . $this->account_id);
      $this->saledOrderModel = $this->saleOrderModelAdapter->fetchById($this->id);
      if (!$this->saledOrderModel instanceof Saleorder_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    if (!$this->saledOrderModel->getItems()) {
      $this->getView()->assign('error_message', _t('You have no items to sale'));
    }
    $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
    $this->payment_id = $this->getRequest()->postInt('payment_id');
    if ($this->getRequest()->post('continue')) {
      if ($this->payment_id > 0) {
	$paymentModelAdapter = new Payment_Payment_Model_Adapter();
	$paymentMehtod = $paymentModelAdapter->fetchById($this->payment_id);
	if ($paymentMehtod instanceof Payment_Payment_Model) {
	  Amhsoft_Event_Handler::trigger('firsttime.saleorder.saved', $this, $this->saledOrderModel);
	  $cartNotificationModel = new Cart_Notification_Model($this->saledOrderModel);
	  $cartNotificationModel->notifySalesOrderSubmitted();
	  $paymentModuleName = $paymentMehtod->getModulename();
	  if ($paymentModuleName != null) {
	    $this->saledOrderModel->payment_method_name = $paymentMehtod;
	    $this->saleOrderModelAdapter->save($this->saledOrderModel);
	    $this->getRedirector()->go('index.php?module=' . strtolower($paymentModuleName) . '&page=index&id=' . $this->saledOrderModel->getId());
	  } else {
	    $this->saledOrderModel->payment_method_name = $paymentMehtod;
	    $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
	    $this->saledOrderModel->sale_order_state_id = Saleorder_State_Model::ACCEPTED;
	    $this->saleOrderModelAdapter->save($this->saledOrderModel);
	    $this->getRedirector()->go('index.php?module=cart&page=checkout-thankyou');
	  }
	} else {
	  $this->getView()->assign('error_message', _t('Selected payment method was deleted, please contact shop owner'));
	}
      } else {
	$this->getView()->assign('error_message', _t('Please select a payment method'));
      }
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
    $this->paymentModelAdapter->where("online = 1");
    $this->getView()->assign('saleorder', $this->saledOrderModel);
    $this->getView()->assign('payments', $this->paymentModelAdapter->fetch());
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Comment')) {
      $commentModelAdapter = new Comment_Model_Adapter();
      $commentModelAdapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
      $commentModelAdapter->where('entity_id = ?', $this->saledOrderModel->getId());
      $commentModelAdapter->where('public = 1');
      $this->getView()->assign("comments", $commentModelAdapter->fetch());
    }
    $this->show();
  }

}

?>
