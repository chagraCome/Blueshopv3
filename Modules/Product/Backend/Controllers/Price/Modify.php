<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Price_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Form $priceForm */
  protected $priceForm;

  /** @var Tyre_Model tyreModel */
  protected $entityModel;
  protected $id;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $adapter = new Product_Product_Model_Adapter();
    $this->entityModel = $adapter->fetchById($this->id);
    if (!$this->entityModel instanceof Product_Product_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->priceForm = new Product_Price_Form('price_form', 'POST');
    $this->getView()->setMessage(_t('Product Prices'), View_Message_Type::INFO);
    $tablePriceData = array();
    $tablePriceModels = $this->entityModel->getPriceTable();
    foreach ($tablePriceModels as $tablePriceModel) {
      $tablePriceData[] = array('table_quantity' => $tablePriceModel->table_quantity, 'table_price' => $tablePriceModel->table_price, 'table_action' => '<a href="#" class="delete">del</a>');
    }
    $tablePriceData[] = array('table_quantity' => '', 'table_price' => '', 'table_action' => '<a href="#" class="delete">' . _t('Delete') . '</a>');
    $this->priceForm->DataSource = new Amhsoft_Data_Set($this->entityModel);
    $this->priceForm->Bind();
    $this->priceForm->tablePriceDataGridView->DataSource = new Amhsoft_Data_Set($tablePriceData);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->priceForm->isNextSend()) {
      $this->priceForm->DataSource = Amhsoft_Data_Source::Post();
      $this->priceForm->Bind();
      if ($this->priceForm->isValid()) {
	$this->priceForm->DataBinding = $this->entityModel;
	$productModelAdapter = new Product_Product_Model_Adapter();
	$this->entityModel = $this->priceForm->getDataBindItem();
	$id = $productModelAdapter->save($this->entityModel);
	$this->saveTablePrice();
	$this->getRedirector()->go('admin.php?module=product&page=product-media&id=' . $this->id);
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
    if ($this->priceForm->isBackSend()) {
      if ($this->entityModel->isGrouped()) {
	$this->getRedirector()->go('admin.php?module=product&page=product-grouped&id=' . $this->entityModel->getId());
      } else {
	$this->getRedirector()->go('admin.php?module=product&page=product-modify&id=' . $this->entityModel->getId());
      }
    }
  }

  /**
   * Save Table of Price
   */
  protected function saveTablePrice() {
    $quantities = $this->getRequest()->posts('table_quantity');
    $prices = $this->getRequest()->posts('table_price');
    Amhsoft_Database::getInstance()->exec("DELETE FROM product_table_price WHERE product_id = " . $this->id);
    foreach ($quantities as $index => $q) {
      if (intval($q) > 0) {
	if ($prices[$index]) {
	  $sql = "INSERT INTO product_table_price VALUES (NULL, '$this->id', '$q', '" . $prices[$index] . "')";
	  Amhsoft_Database::getInstance()->exec($sql);
	}
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->priceForm);
    $this->getView()->assign('product', $this->entityModel);
    $this->show();
  }

}

?>
