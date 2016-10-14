<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Payment_Backend_Payment_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Payment_Form $paymentForm */
  protected $paymentForm;

  /** @var Payment_Payment_Model $paymentModel */
  protected $paymentModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->paymentForm = new Payment_Payment_Form('paymentForm_form', 'POST');
    $this->paymentModel = new Payment_Payment_Model();
    $this->getView()->setMessage(_t('Create new Payment Method'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->paymentForm->isSend()) {
      if ($this->paymentForm->isFormValid()) {
	$this->paymentForm->DataBinding = $this->paymentModel;
	$paymentModelAdapter = new Payment_Payment_Model_Adapter();
	$this->paymentModel = $this->paymentForm->getDataBindItem();
	$this->paymentModel->user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
	$paymentModelAdapter->save($this->paymentModel);
	if ($this->paymentModel->getId() > 0) {
	  if ($this->paymentModel->getId() > 0 && $this->paymentForm->imagefileInput->Value) {
	    $this->paymentForm->imagefileInput->uploadTo('media/payment/' . $this->paymentModel->getId() . '.jpg');
	  }
	  $this->handleSuccess();
	}
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=payment&page=payment&page=payment-list&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->paymentForm);
    $this->show();
  }

}

?>
