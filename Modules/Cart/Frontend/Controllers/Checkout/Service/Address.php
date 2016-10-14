<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Address.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Service_Address_Controller extends Cart_Frontend_Checkout_Address_Controller {

  /** @var Amhsoft_Widget_Panel $invoiceAddressPanel */
  protected $invoiceAddressPanel;

  /** @var AddressModel $invoiceAddress */
  protected $invoiceAddress;

  /**
   * Initialize Controller
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
    $this->invoiceAddressPanel = new Amhsoft_Widget_Panel();
    $addresses = $this->getAvailabeleAddresses();
    foreach ($addresses as $addr) {
      $address_string = '<strong>' . _t('Use this Address') . '</strong><br />' . $addr->getName() . '<br /> ' . $addr->getStreet() . '<br /> ' . $addr->getZipCode() . ' ' . $addr->getCity() . ' ' . $addr->getProvince() . ' ' . $addr->getCountry();
      $checkBoxInvoiceAddressid = new Amhsoft_RadioBox_Control('invoice_address_id', $address_string, $addr->getId());
      $checkBoxInvoiceAddressid->setId('invoice_address_id' . $addr->getId());
      $checkBoxInvoiceAddressid->DataBinding = new Amhsoft_Data_Binding('id');
      if ($cart->getInvoiceAddress() != null && $cart->getInvoiceAddress()->getId() == $addr->getId()) {
	$checkBoxInvoiceAddressid->Checked = true;
      }
      $this->invoiceAddressPanel->addComponent($checkBoxInvoiceAddressid);
    }
    $this->invoiceAddressPanel->addComponent(new Amhsoft_Link_Control(_t('Add new Address'), 'index.php?module=crm&page=intern-shop-address-add&ret=checkout'));
    $submit = new Amhsoft_Button_Submit_Control('continue', _t('Save and continue'));
    $this->invoiceAddressPanel->addComponent($submit);
  }

  /**
   * Get Addresses
   * @return type
   */
  protected function getAvailabeleAddresses() {
    $addressModelAdapter = new Crm_Address_Model_Adapter();
    $auth = Amhsoft_Authentication::getInstance();
    if ($auth->isAuthenticated()) {
      $addressModelAdapter->where('account_id = ?', $auth->getObject()->id);
      return $addressModelAdapter->fetch()->fetchAll();
    }
    return array();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->getRequest()->isPost('continue')) {
      $invoiceAddressId = $this->getRequest()->postInt('invoice_address_id');
      if ($invoiceAddressId > 0) {
	$addressAdapter = new Crm_Address_Model_Adapter();
	$cart = Cart_Shoppingcart_Model::getInstance();
	$invoiceAddress = $addressAdapter->fetchById($invoiceAddressId);
	if ($invoiceAddress instanceof Crm_Address_Model) {
	  $cart->setInvoiceAddress($invoiceAddress);
	}
	$cart->shipping_address_id = null;
	$cart->shippingAddress = null;
	$cart->Persist();
	$this->getRedirector()->go('index.php?module=cart&page=checkout-service-payment');
      } else {
	$this->getView()->assign('error_message', _t('Please Select Invoice Address'));
      }
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $panel = new Amhsoft_Widget_Panel();
    $invoicePanel = new Amhsoft_Widget_Panel(_t('Invoice Address'));
    $invoicePanel->addComponent($this->invoiceAddressPanel);
    $panel->addComponent($invoicePanel);
    $this->getView()->assign('widget', $panel);
    $this->show();
  }

}

?>
