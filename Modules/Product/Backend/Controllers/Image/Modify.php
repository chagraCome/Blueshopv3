<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Image_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var ImageForm $imageForm */
  protected $imageForm;

  /** @var ImageModel $imageModel */
  protected $imageModel;

  /*
   * Initialize Controller
   */

  public function __initialize() {
    $this->imageForm = new Product_Image_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Product Image'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $imageModelAdapter = new Product_Image_Model_Adapter();
      $this->imageModel = $imageModelAdapter->fetchById($id);
    }
    if (!$this->imageModel instanceof Product_Image_Model) {
      die('Requested Image not found');
    }
    $this->imageForm->DataSource = new Amhsoft_Data_Set($this->imageModel);
    $this->imageForm->Bind();
    $this->imageForm->removeByName('image_file');
    $this->imageForm->removeByName('maxheight');
    $this->imageForm->removeByName('maxwidth');
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->imageForm->isSend()) {
      $this->imageForm->DataSource = Amhsoft_Data_Source::Post();
      $this->imageForm->Bind();
      if ($this->imageForm->isValid()) {
	$this->imageForm->DataBinding = $this->imageModel;
	$imageModelAdapter = new Product_Image_Model_Adapter();
	$this->imageModel = $this->imageForm->getDataBindItem();
	$imageModelAdapter->save($this->imageModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back());
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
