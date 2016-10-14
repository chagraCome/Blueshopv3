<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Image_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Image_Form $imageForm */
  protected $imageForm;

  /** @var ImageModel $imageModel */
  protected $imageModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->imageForm = new Product_Image_Form('imageForm_form', 'POST');
    $this->imageModel = new Product_Image_Model();
    $this->getView()->setMessage(_t('Add new Product Image'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->imageForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->imageForm->isSend()) {
      if ($this->imageForm->isValid()) {
	$this->imageForm->DataBinding = $this->imageModel;
	$this->imageForm->Bind();
	$imageModelAdapter = new Product_Image_Model_Adapter();
	$this->imageModel->setFolder('/media/product/image');
	$this->imageModel->setExtention($this->imageForm->imagefileInput->getExtention());
	if (!$this->imageForm->nameInput->Value) {
	  $this->imageModel->setName($this->imageForm->imagefileInput->getTempFileName());
	}
	$this->imageModel = $this->imageForm->getDataBindItem();
	$this->imageModel->insertat = Amhsoft_Locale::UCTDateTime();
	$imageModelAdapter->save($this->imageModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    if ($this->imageModel->getId()) {
      try {
	if ($this->imageForm->imagefileInput->Value['tmp_name']) {
	  $this->imageModel->uploadFromTemp($this->imageForm->imagefileInput->Value);
	  $resizer = $this->imageModel->getResizer();
	  $resizer->resizeTo(intval($this->imageForm->maxwidthInput->Value), intval($this->imageForm->maxHeightInput->Value));
	  $resizer->save($this->imageModel->getAbsolutePath());
	}
	$stmt = Amhsoft_Database::getInstance()->prepare("INSERT INTO product_has_image(product_id, image_id) VALUES(:pid, :iid)");
	$stmt->bindValue(':pid', $this->getRequest()->get('product_id'), PDO::PARAM_INT);
	$stmt->bindValue(':iid', $this->imageModel->getId(), PDO::PARAM_INT);
	$stmt->execute();
	$this->getRedirector()->go('admin.php?module=product&page=product-media&id=' . $this->getRequest()->get('product_id'));
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage());
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->imageForm);
    $this->show();
  }

}

?>
