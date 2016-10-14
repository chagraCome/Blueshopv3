<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Shipping_Backend_Shipping_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var ShippingForm $shippingForm */
  protected $shippingForm;

  /** @var ShippingModel $shippingModel */
  protected $shippingModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->shippingForm = new Shipping_Shipping_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Shipping Methods'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
      $this->shippingModel = $shippingModelAdapter->fetchById($id);
    }
    if (!$this->shippingModel instanceof Shipping_Shipping_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->shippingForm->imgCol->setDeleteUrl('admin.php?module=shipping&page=shipping-modify&id=' . $this->shippingModel->getId() . '&event=deletelogo');
    $this->shippingForm->DataSource = new Amhsoft_Data_Set($this->shippingModel);
    $this->shippingForm->Bind();
  }

  /**
   * Delete Logo.
   */
  public function __deletelogo() {
    @unlink('media/shipping/' . $this->shippingModel->getId() . '.jpg');
    $this->getRedirector()->go('admin.php?module=shipping&page=shipping-modify&ret=true&id=' . $this->shippingModel->getId());
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->shippingForm->isSend()) {
      if ($this->shippingForm->isFormValid()) {
	$this->shippingForm->DataBinding = $this->shippingModel;
	$shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
	$this->shippingModel = $this->shippingForm->getDataBindItem();
	$e = $shippingModelAdapter->save($this->shippingModel);
	$result = $this->saveCountries();
	if ($this->shippingModel->getId() > 0 && $this->shippingForm->imagefileInput->Value) {
	  $this->shippingForm->imagefileInput->uploadTo('media/shipping/' . $this->shippingModel->getId() . '.jpg');
	}
	if ($result) {
	  $this->handleSuccess();
	} else {
	  $this->getView()->setMessage(_t('Failed to modify Shipping method.'), View_Message_Type::ERROR);
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
    try {
      $countries = $this->getRequest()->posts('countries');
      Amhsoft_Database::getInstance()->exec("DELETE FROM shipping_has_country WHERE shipping_id = " . $this->shippingModel->getId());
      foreach ($countries as $iso3) {
	Amhsoft_Database::getInstance()->exec("INSERT INTO shipping_has_country VALUES (" . $this->shippingModel->getId() . ", '$iso3');");
      }
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Action after success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=shipping&page=shipping-list&ret=true');
  }

  /*
   * Finalize Event
   */

  public function __finalize() {
    $this->getView()->assign('form', $this->shippingForm);
    $this->show();
  }

}

?>
