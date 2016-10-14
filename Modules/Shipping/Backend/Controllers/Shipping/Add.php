<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Shipping_Backend_Shipping_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var ShippingForm $shippingForm */
  protected $shippingForm;

  /** @var ShippingModel $shippingModel */
  protected $shippingModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->shippingForm = new Shipping_Shipping_Form('shippingForm_form', 'POST');
    $this->shippingModel = new Shipping_Shipping_Model();
    $this->getView()->setMessage(_t('Create new Shipping Method'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   * @return type
   */
  public function __default() {
    $this->shippingForm->Bind();
    if ($this->shippingForm->isSend()) {
      if ($this->shippingForm->isFormValid()) {
	$this->shippingForm->DataBinding = $this->shippingModel;
	$shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
	$this->shippingModel = $this->shippingForm->getDataBindItem();
	$this->shippingModel->user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
	if ($this->shippingForm->shippingTypeListBox->getValue() == 1) {
	  if ($this->shippingForm->costInput->getValue() > 0 || $this->shippingForm->packagingCostInput->getValue() > 0 || $this->shippingForm->minOrderAmountInput->getValue() > 0 ) {
	    $this->getView()->setMessage(_t('you have selected free shipping.All prices must be Null'), View_Message_Type::ERROR);
	    return;
	  }
	}
	$e = $shippingModelAdapter->save($this->shippingModel);
	if ($this->shippingModel->getId() > 0) {
	  $this->saveCountries();
	  if (!$this->shippingForm->imagefileInput->hasError()) {
	    if ($this->shippingModel->getId() > 0 && $this->shippingForm->imagefileInput->Value) {
	      $this->shippingForm->imagefileInput->uploadTo('media/shipping/' . $this->shippingModel->getId() . '.jpg');
	    }
	  }
	  $this->handleSuccess();
	}
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Save Countries
   */
  protected function saveCountries() {
    $countries = $this->getRequest()->posts('countries');
    Amhsoft_Database::getInstance()->exec("DELETE FROM shipping_has_country WHERE shipping_id = " . $this->shippingModel->getId());
    foreach ($countries as $iso3) {
      Amhsoft_Database::getInstance()->exec("INSERT INTO shipping_has_country VALUES (" . $this->shippingModel->getId() . ", '$iso3');");
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=shipping&page=shipping-list&ret=true');
  }

  /**
   * Finalize Evnet
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->shippingForm);
    $this->show();
  }

}

?>
