<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Payment_Backend_Bank_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Bank_Form paymentBankForm */
  protected $paymentBankForm;

  /** @var Payment_Bank_Model paymentBankModel */
  protected $paymentBankModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->paymentBankForm = new Payment_Bank_Form('paymentBankForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Bank'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $paymentBankModelAdapter = new Payment_Bank_Model_Adapter();
      $this->paymentBankModel = $paymentBankModelAdapter->fetchById($id);
    }
    if (!$this->paymentBankModel instanceof Payment_Bank_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->paymentBankForm->DataSource = new Amhsoft_Data_Set($this->paymentBankModel);
    $this->paymentBankForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->paymentBankForm->isSend()) {
      $this->paymentBankForm->DataSource = Amhsoft_Data_Source::Post();
      $this->paymentBankForm->Bind();
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
    Amhsoft_Navigator::go(Amhsoft_History::back() . '&ret=true');
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

