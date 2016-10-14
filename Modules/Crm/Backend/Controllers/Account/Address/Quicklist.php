<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of list
 *
 * @author cherif
 */
class Crm_Backend_Account_Address_Quicklist_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var Crm_Address_Model_Adapter $addressModelAdapter */
  protected $addressModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $targetId = $this->getRequest()->getInt('target_id');
    $accId = $this->getRequest()->getInt('acc_id');
    if ($targetId <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->dataGridView = new Amhsoft_Widget_DataGridView();
    $this->setUpDataGridView();
    $this->addressModelAdapter = new Crm_Address_Model_Adapter();
    $this->addressModelAdapter->where('account_id = ?', $accId);
    $this->getView()->setMessage(_t('List Accounts'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  protected function setUpDataGridView() {
    $nameCol = new Amhsoft_Link_Control(_t('Name'), 'admin.php?module=crm&page=account-address-quicklist&event=select&target=' . Amhsoft_Web_Request::get('target') . '&target_id=' . Amhsoft_Web_Request::getInt('target_id'));
    $nameCol->DisplayValue = "name";
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $streetCol = new Amhsoft_Label_Control(_t('Street'));
    $streetCol->DataBinding = new Amhsoft_Data_Binding('street');
    $cityCol = new Amhsoft_Label_Control(_t('City'));
    $cityCol->DataBinding = new Amhsoft_Data_Binding('city');
    $countryCol = new Amhsoft_Label_Control(_t('Country'));
    $countryCol->DataBinding = new Amhsoft_Data_Binding('country');
    $this->dataGridView->AddColumn($nameCol);
    $this->dataGridView->AddColumn($streetCol);
    $this->dataGridView->AddColumn($cityCol);
    $this->dataGridView->AddColumn($countryCol);
  }

  /**
   * Select event
   */
  public function __select() {
    $id = $this->getRequest()->getId();
    if (intval($id <= 0)) {
      return;
    }
    $addressModelAdapter = new Crm_Address_Model_Adapter();
    $selectedAddress = $addressModelAdapter->fetchById($id);
    if (!$selectedAddress instanceof Crm_Address_Model) {
      return;
    }
    $target = $this->getRequest()->get('target');
    $target_id = $this->getRequest()->getInt('target_id');
    if ($id > 0 && $target_id > 0) {
      if ($target == 'so_shipping' || $target == 'so_invoice') {
	$saleOrderAddressModel = new Saleorder_Address_Model();
	$saleOrderAddressModel->setCity($selectedAddress->getCity());
	$saleOrderAddressModel->setName($selectedAddress->getName());
	$saleOrderAddressModel->setCountry($selectedAddress->getCountry());
	$saleOrderAddressModel->setStreet($selectedAddress->getStreet());
	$saleOrderAddressModel->setProvince($selectedAddress->getProvince());
	$saleOrderAddressModel->setZipCode($selectedAddress->getZipCode());
	$saleOrderAddressModelAdapter = new Saleorder_Address_Model_Adapter();
	$saleOrderAddressModelAdapter->save($saleOrderAddressModel);
	if ($target == 'so_shipping') {
	  Amhsoft_Database::getInstance()->exec("UPDATE sale_order SET shipping_address_id = " . $saleOrderAddressModel->getId() . " WHERE id = " . $target_id);
	  $this->cleanSaleOrderAddresses();
	  Saleorder_Model::reCalculateAnsSavePricesId($target_id);
	  $this->close();
	}
	if ($target == 'so_invoice') {
	  Amhsoft_Database::getInstance()->exec("UPDATE sale_order SET invoice_address_id = " . $saleOrderAddressModel->getId() . " WHERE id = " . $target_id);
	  $this->cleanSaleOrderAddresses();
	  $this->close();
	}
      }
      if ($target == 'inv_shipping' || $target == 'inv_invoice') {
	$invoiceAddressModel = new Invoice_Address_Model();
	$invoiceAddressModel->setCity($selectedAddress->getCity());
	$invoiceAddressModel->setName($selectedAddress->getName());
	$invoiceAddressModel->setCountry($selectedAddress->getCountry());
	$invoiceAddressModel->setStreet($selectedAddress->getStreet());
	$invoiceAddressModel->setProvince($selectedAddress->getProvince());
	$invoiceAddressModel->setZipCode($selectedAddress->getZipCode());
	$invoiceAddressModelAdapter = new Invoice_Address_Model_Adapter();
	$invoiceAddressModelAdapter->save($invoiceAddressModel);
	if ($target == 'inv_shipping') {
	  Amhsoft_Database::getInstance()->exec("UPDATE invoice SET shipping_address_id = " . $invoiceAddressModel->getId() . " WHERE id = " . $target_id);
	  $this->cleanInvoiceAddresses();
	  Invoice_Model::reCalculateAnsSavePricesId($target_id);
	  $this->close();
	}
	if ($target == 'inv_invoice') {
	  Amhsoft_Database::getInstance()->exec("UPDATE invoice SET invoice_address_id = " . $invoiceAddressModel->getId() . " WHERE id = " . $target_id);
	  $this->cleanInvoiceAddresses();
	  $this->close();
	}
      }
    }
  }

  protected function cleanSaleOrderAddresses() {
    $sql = "DELETE FROM sale_order_address WHERE id NOT IN (SELECT shipping_address_id FROM sale_order) AND id NOT IN (SELECT invoice_address_id FROM sale_order)";
    Amhsoft_Database::getInstance()->exec($sql);
  }

  protected function cleanInvoiceAddresses() {
    $sql = "DELETE FROM invoice_address WHERE id NOT IN (SELECT shipping_address_id FROM invoice) AND id NOT IN (SELECT invoice_address_id FROM invoice)";
    Amhsoft_Database::getInstance()->exec($sql);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->addressModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->popup();
  }

}

?>
