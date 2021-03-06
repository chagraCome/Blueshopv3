<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Update.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Paytabs
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

class Paytabs_Frontend_Confirm_Controller extends Amhsoft_System_Web_Controller {

    protected $orderId;
    protected $saleOrder;
    protected $hashedKEY;
    protected $account_id;

    /**
     * Initialize event
     */
    public function __initialize() {

        $paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $paymentModelAdapter->where("modulename = ?", 'Paytabs');
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
            Amhsoft_Registry::register('after_login', 'index.php?module=paytabs&page=confirm&id=' . $this->hashedKEY);
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }

        if ($this->saleOrder->account->id != $this->account_id) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
		
		$paytabsConfiguration = new Amhsoft_Config_Table_Adapter('paytabs');
		
		$merchantID = $paytabsConfiguration->getValue('merchant_id');
		$merchantPassword = $paytabsConfiguration->getValue('merchant_password');
		$paytabsCurrency =  $paytabsConfiguration->getValue('paytabs_currency');
		$gateway_url = 'https://www.paytabs.com/';
		
		if (isset($_SESSION['api_key'])) {
				$api_key = $_SESSION['api_key'];
				$request_param =array('api_key'=>$api_key, 'payment_reference'=>$_POST['payment_reference']);
				$request_string = http_build_query($request_param);
				
				$response_data = $this->sendRequest($gateway_url . 'api/verify_payment', $request_string);
				$object = json_decode($response_data);
				
				if(@$object->response == '3' || @$object->response == '6'){
					  $this->saleOrder->updateSaleorder(Saleorder_State_Model::PAID, _t('Sales order was Paid'), @$_POST);
                      Cart_Shoppingcart_Model::getInstance()->reset();
                      $this->saleOrder->notifyPaid();
					  $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was paid'));
				} else {
					  $this->saleOrder->updateSaleorder(Saleorder_State_Model::NOTPAID, _t('Sales order was not paid'), @$_POST);
                      $this->saleOrder->notifyNotPaid();
                      Cart_Shoppingcart_Model::getInstance()->reset();
                      $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was not paid'));
				}
			} else {
				 $this->saleOrder->updateSaleorder(Saleorder_State_Model::NOTPAID, _t('Sales order was not paid'), @$_POST);
                 $this->saleOrder->notifyNotPaid();
                 Cart_Shoppingcart_Model::getInstance()->reset();
                 $this->getRedirector()->go('index.php?module=saleorder&page=details&id=' . $this->saleOrder->getId() . "&message=" . _t('Your Sales Order was not paid'));
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