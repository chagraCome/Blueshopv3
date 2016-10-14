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
class Product_Backend_Category_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Category_Form $productCategoryForm */
  protected $productCategoryForm;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->productCategoryForm = new Product_Category_Form('product_category_form', 'POST');
    $this->getView()->setMessage(_t('Add new product category'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->productCategoryForm->isSend()) {
      if ($this->productCategoryForm->isValid()) {
	$this->productCategoryForm->DataBinding = new Product_Category_Model();
	$productCategoryModelAdapter = new Product_Category_Model_Adapter();
	$productCategoryModel = $this->productCategoryForm->getDataBindItem();
	$productCategoryModelAdapter->save($productCategoryModel);
	if ($productCategoryModel->id > 0) {
	  @unlink('media/category/logos/' . $productCategoryModel->id . '.jpg'); //remove it if exists
	  @unlink('media/category/banners/' . $productCategoryModel->id . '.jpg');
	  $this->productCategoryForm->categoryLogo->getUploadControl()->uploadTo('media/category/logos/' . $productCategoryModel->id . '.jpg');
	  $this->productCategoryForm->categoryBanner->getUploadControl()->uploadTo('media/category/banners/' . $productCategoryModel->id . '.jpg');
	}
	$this->getRedirector()->go('?module=product&page=category-list' . '&ret=true');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /*
   * Finalize event
   */

  public function __finalize() {
    $this->getView()->assign('form', $this->productCategoryForm);
    $this->show();
  }

}

?>
