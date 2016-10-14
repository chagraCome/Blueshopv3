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
class Product_Backend_Product_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_Form $productForm */
  protected $productForm;

  /** @var ProductModel $productModel */
  protected $productModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Modify product'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $productModelAdapter = new Product_Product_Model_Adapter();
      $this->productModel = $productModelAdapter->fetchById($id);
    }
    if (!$this->productModel instanceof Product_Product_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->productForm = new Product_Product_Form('product', $this->productModel->getEntitySet(), 'POST');
    $this->productForm->DataSource = new Amhsoft_Data_Set($this->productModel);
    $this->productForm->Bind();
    $this->productForm->numberInput->Disabled = true;
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->productForm->isSend()) {
      $this->productForm->DataSource = Amhsoft_Data_Source::Post();
      $this->productForm->Bind();
      if ($this->productForm->isValid()) {
	$this->productForm->DataBinding = $this->productModel;
	$productModelAdapter = new Product_Product_Model_Adapter();
	$productModel = $this->productForm->getDataBinditem();
       
	$productModelAdapter->save($productModel);
	if ($productModel->isGrouped()) {
	  $this->getRedirector()->go('admin.php?module=product&page=product-grouped&id=' . $productModel->getId());
	} else {
	  $this->getRedirector()->go('admin.php?module=product&page=price-modify&id=' . $productModel->getId());
	}
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('product', $this->productModel);
    $this->getView()->assign('form', $this->productForm);
    $this->show();
  }

}

?>
