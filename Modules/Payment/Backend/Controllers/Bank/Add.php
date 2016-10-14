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

class Payment_Backend_Bank_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Bank_Form paymentBankForm */
  protected $paymentBankForm;

  /** @var Payment_Bank_Model paymentBankModel */
  protected $paymentBankModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->paymentBankForm = new Payment_Bank_Form('paymentBankForm_form', 'POST');
    $this->paymentBankModel = new Payment_Bank_Model();
    $this->getView()->setMessage(_t('Add new Bank'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->paymentBankForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->paymentBankForm->isSend()) {
      if ($this->paymentBankForm->isValid()) {
	$this->paymentBankForm->DataBinding = $this->paymentBankModel;
	$paymentBankModelAdapter = new Payment_Bank_Model_Adapter();
	$this->paymentBankModel = $this->paymentBankForm->getDataBindItem();
	$paymentBankModelAdapter->save($this->paymentBankModel);
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
    $this->getRedirector()->go('?module=payment&page=bank-list&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->paymentBankForm);
    $this->show();
  }

}

?>