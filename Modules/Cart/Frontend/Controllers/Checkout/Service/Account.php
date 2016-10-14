<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Account.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Service_Account_Controller extends Cart_Frontend_Checkout_Account_Controller {

  /**
   * Default Event
   */
  public function __default() {
    if ($this->accountForm->isSend()) {
      if ($this->accountForm->isFormValid()) {
	$this->accountForm->DataBinding = $this->accountModel;
	$this->accountForm->Bind();
	$this->accountModel = $this->accountForm->getDataBindItem();
	$accountModelAdapter = new Crm_Account_Model_Adapter();
	$accountModelAdapter->save($this->accountModel);
	$cart = Cart_Shoppingcart_Model::getInstance();
	$cart->setAccount($this->accountModel)->Persist();
	$this->getRedirector()->go('index.php?module=cart&page=checkout-service-address');
      }
    }
  }

}

?>
