<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Crm_Backend_Contact_Document_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var DocumentForm $documentForm */
  protected $documentForm;

  /** @var DocumentModel $documentModel */
  protected $documentModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->documentForm = new Crm_Document_Form('contact_document_form', 'POST');
    $this->getView()->setMessage(_t('Add a new Contact Document'), View_Message_Type::INFO);
    $this->documentModel = new Crm_Contact_Document_Model();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->documentForm->isSend()) {
      if ($this->documentForm->isValid()) {
	$this->documentForm->DataBinding = $this->documentModel;
	$this->documentForm->Bind();
	$this->documentModel->setFolder('media/contact/docs/');
	$this->documentModel->setExtention($this->documentForm->documentfileInput->getExtention());
	$this->documentModel = $this->documentForm->getDataBindItem();
	$contactModelAdapter = new Crm_Contact_Model_Adapter();
	$contactModel = $contactModelAdapter->fetchById($this->getRequest()->getInt('contact_id'));
	$contactModel->addDocument($this->documentModel);
	$e = $contactModelAdapter->save($contactModel, true);
	if ($this->documentModel->getId()) {
	  try {
	    $this->documentModel->uploadFromTemp($this->documentForm->documentfileInput->Value);
	    $this->getRedirector()->go(Amhsoft_History::back());
	  } catch (Exception $e) {
	    $this->getView()->setMessage($e->getMessage());
	  }
	}
	$this->getView()->setMessage(_t('Contact was successully added'), 'success');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

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
