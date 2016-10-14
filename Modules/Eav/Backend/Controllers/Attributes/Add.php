<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributes_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var ProductAttributeForm $productAttributeForm */
  protected $productAttributeForm;

  /** @var Product_Attribute_Model $productAttributeModel */
  protected $productAttributeModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->productAttributeForm = new Eav_Attribute_Form('productAttributeForm_form', 'POST');
    $this->productAttributeModel = new Eav_Attribute_Model();
    $this->getView()->setMessage(_t('Create new Entity Attribute'), View_Message_Type::INFO);
    $this->productAttributeForm->nameInput->addValidator('Unique|entity_attribute|name');
  }

  /**
   * Default event
   */
  public function __default() {
    $this->productAttributeForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->productAttributeForm->isSend()) {
      if ($this->productAttributeForm->isValid()) {
	$this->productAttributeForm->DataBinding = $this->productAttributeModel;
	$productAttributeModelAdapter = new Eav_Attribute_Model_Adapter();
	$this->productAttributeModel = $this->productAttributeForm->getDataBindItem();
        $this->productAttributeModel->entity_id = $this->getRequest()->get('entity');
	$productAttributeModelAdapter->save($this->productAttributeModel);
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
    $this->getRedirector()->go('admin.php?module=eav&page=attributes-list&ret=true&entity=' . $this->getRequest()->get('entity'));
    $this->getView()->setMessage(_t('Entity Attribute was successully added'), View_Message_Type::SUCCESS);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->productAttributeForm);
    $this->show();
  }

}

?>
