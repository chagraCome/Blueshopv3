<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Payment_Backend_Payment_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Payment_Form $paymentForm */
  protected $paymentForm;

  /** @var Payment_Payment_Model $paymentModel */
  protected $paymentModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->paymentForm = new Payment_Payment_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Payment Method'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $paymentModelAdapter = new Payment_Payment_Model_Adapter();
      $this->paymentModel = $paymentModelAdapter->fetchById($id);
    }
    if (!$this->paymentModel instanceof Payment_Payment_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->paymentForm->imgCol->setDeleteUrl('admin.php?module=payment&page=payment-modify&id=' . $this->paymentModel->getId() . '&event=deletelogo');
    $this->paymentForm->DataSource = new Amhsoft_Data_Set($this->paymentModel);
    $this->paymentForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->paymentForm->isSend()) {
      $this->paymentForm->DataSource = Amhsoft_Data_Source::Post();
      $this->paymentForm->Bind();
      if ($this->paymentForm->isValid()) {
	$this->paymentForm->DataBinding = $this->paymentModel;
	$paymentModelAdapter = new Payment_Payment_Model_Adapter();
	$this->paymentModel = $this->paymentForm->getDataBindItem();
	$paymentModelAdapter->save($this->paymentModel);
	if ($this->paymentModel->getId() > 0 && $this->paymentForm->imagefileInput->Value) {
	  $this->paymentForm->imagefileInput->uploadTo('media/payment/' . $this->paymentModel->getId() . '.jpg');
	}
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Delete Logo Event
   */
  public function __deletelogo() {
    @unlink('media/payment/' . $this->paymentModel->getId() . '.jpg');
    $this->getRedirector()->go('admin.php?module=payment&page=payment-modify&ret=true&id=' . $this->paymentModel->getId());
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=payment&page=payment-list&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->paymentForm);
    $this->show();
  }

}

?>
