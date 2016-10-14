<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: zeroprice.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Zeroprice_Controller extends Amhsoft_System_Web_Controller {

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
    if (intval($this->id) > 0) {
      $auth = Amhsoft_Authentication::getInstance();
      if ($auth->isAuthenticated()) {
	$this->account_id = $auth->getObject()->id;
      } else {
	Amhsoft_Registry::register('after_login', 'index.php?module=cart&page=zeroprice&type=so&id=' . $this->id);

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
    $this->getView()->assign('saleorder', $this->saledOrderModel);
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
