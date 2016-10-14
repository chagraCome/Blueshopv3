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

class Product_Backend_Document_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var DocumentForm $documentForm */
  protected $documentForm;

  /** @var DocumentModel $documentModel */
  protected $documentModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->documentForm = new Product_Document_Form('project_document_form', 'POST');
    $this->getView()->setMessage(_t('Add a new Product Document'), View_Message_Type::INFO);
    $this->documentModel = new Product_Document_Model();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->documentForm->isSend()) {
      if ($this->documentForm->isValid()) {
	$this->documentForm->DataBinding = $this->documentModel;
	$this->documentForm->Bind();
	$this->documentModel->setFolder('media/product/docs');
	$this->documentModel->setExtention($this->documentForm->documentfileInput->getExtention());
	$this->documentModel->setHash(sha1(Amhsoft_Locale::UCTDateTime() . $this->documentModel->name) . rand(5, 999));
	$this->documentModel = $this->documentForm->getDataBindItem();
	$productModelAdapter = new Product_Product_Model_Adapter();
	$productModel = $productModelAdapter->fetchById($this->getRequest()->getInt('product_id'));
	$productModel->addDocument($this->documentModel);
	$e = $productModelAdapter->save($productModel, true);
	if ($e) {
	  try {
	    $this->documentModel->uploadFromTemp($this->documentForm->documentfileInput->Value);
	    $this->getRedirector()->go(Amhsoft_History::back());
	  } catch (Exception $e) {
	    $this->getView()->setMessage($e->getMessage());
	  }
	}
	$this->getView()->setMessage(_t('Document was successully added'), View_Message_Type::SUCCESS);
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Upload file
   */
  public function uploadfile() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->documentForm);
    $this->show();
  }

}

?>
