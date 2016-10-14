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
class Product_Backend_Category_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Category_Form $productCategoryForm */
  protected $productCategoryForm;

  /** @var ProductCategoryModel $productCategoryModel */
  protected $productCategoryModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->productCategoryForm = new Product_Category_Form('product_category', 'POST');
    $this->getView()->setMessage(_t('Modify product category'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $productCategoryModelAdapter = new Product_Category_Model_Adapter();
      $this->productCategoryModel = $productCategoryModelAdapter->fetchById($id);
    }
    if (!$this->productCategoryModel instanceof Product_Category_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->productCategoryForm->categoryBanner->setDeleteUrl('admin.php?module=product&page=category-modify&id=' . $this->productCategoryModel->getId() . '&event=deletebanner');
    $this->productCategoryForm->categoryLogo->setDeleteUrl('admin.php?module=product&page=category-modify&id=' . $this->productCategoryModel->getId() . '&event=deletelogo');
    $this->productCategoryForm->categoryBanner->setSrc($this->productCategoryModel->getBannerSrc());
    $this->productCategoryForm->categoryLogo->setSrc($this->productCategoryModel->getLogoSrc());
    $this->productCategoryForm->DataSource = new Amhsoft_Data_Set($this->productCategoryModel);
    $this->productCategoryForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    $this->productCategoryForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->productCategoryForm->isSend()) {
      $this->productCategoryForm->DataSource = Amhsoft_Data_Source::Post();
      $this->productCategoryForm->Bind();
      if ($this->productCategoryForm->isValid()) {
	$this->productCategoryForm->DataBinding = $this->productCategoryModel;
	$productCategoryModelAdapter = new Product_Category_Model_Adapter();
	$productCategoryModel = $this->productCategoryForm->getDataBinditem();
	$productCategoryModelAdapter->save($productCategoryModel);
	$logoUploadControl = $this->productCategoryForm->categoryLogo->getUploadControl();
	$bannerUploadControl = $this->productCategoryForm->categoryBanner->getUploadControl();
	if ($logoUploadControl->Value) {
	  $logoUploadControl->uploadTo('media/category/logos/' . $productCategoryModel->id . '.jpg');
	}
	if ($bannerUploadControl->Value) {
	  $bannerUploadControl->uploadTo('media/category/banners/' . $productCategoryModel->id . '.jpg');
	}
	$this->getRedirector()->go(Amhsoft_History::back(1) . '&ret=true');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Delete Logo event
   */
  public function __deletelogo() {
    @unlink('media/category/logos/' . $this->productCategoryModel->getId() . '.jpg');
  }

  /**
   * Delete Banner event
   */
  public function __deletebanner() {
    @unlink('media/category/banners/' . $this->productCategoryModel->getId() . '.jpg');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->productCategoryForm);
    $this->show();
  }

}

?>
