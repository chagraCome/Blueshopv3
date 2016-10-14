<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Product_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_Form $ProductForm */
  protected $productForm;

  /** @var ProductModel $productModel */
  protected $productModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Add new product'), View_Message_Type::INFO);
    
            
    $this->productModel = new Product_Product_Model();
    
 
    $this->productForm = new Product_Product_Form('product_form', $this->getProductSet(), 'POST');
    $this->productForm->numberInput->Value = $this->productModel->getNextProductNumber();
    if ($this->getRequest()->getInt('typeid')) {
      $this->productModel->type_id = $this->getRequest()->getInt('typeid');
    }
    
  }

  /**
   * Gets Product set model.
   * @return ProductSetModel
   */
  protected function getProductSet() {
    $setid = $this->getRequest()->getInt('setid');
    if ($setid == 0) {
      return null;
    }
    $productSetModelAdapter = new Eav_Set_Model_Adapter();
    $productSetModel = $productSetModelAdapter->fetchById($setid);
    if ($productSetModel instanceof Eav_Set_Model) {
      $this->productModel->entity_set_id = $setid;
    }
    return $productSetModel;
  }

  /**
   * Default event
   */
  public function __default() {
    $this->productForm->DataSource = Amhsoft_Data_Source::Post();
    $this->productForm->Bind();
    if ($this->productForm->isSend()) {
      if ($this->productForm->isFormValid()) {
	$this->productForm->DataBinding = $this->productModel;
	$productModelAdapter = new Product_Product_Model_Adapter();
	$this->productModel = $this->productForm->getDataBindItem();
	$this->productModel->setOnline(0);
	$this->productModel->user_id = Amhsoft_Authentication::getInstance()->getObject()->getId();
	$id = $productModelAdapter->save($this->productModel);
	if ($this->productModel->isGrouped()) {
	  $this->getRedirector()->go('admin.php?module=product&page=product-grouped&id=' . $id);
	} else {
	  $this->getRedirector()->go('admin.php?module=product&page=price-modify&id=' . $id);
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
