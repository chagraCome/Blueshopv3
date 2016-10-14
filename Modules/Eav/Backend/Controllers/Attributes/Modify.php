<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributes_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var ProductAttributeForm $productAttributeForm */
  protected $productAttributeForm;

  /** @var Product_Attribute_Model $productAttributeModel */
  protected $productAttributeModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->productAttributeForm = new Eav_Attribute_Form('project_form', 'POST');
    $this->productAttributeForm->nameInput->Disabled = true;
    $this->productAttributeForm->typeListBox->Disabled = true;
    $this->getView()->setMessage(_t('Edit Product Attribute'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $productAttributeModelAdapter = new Eav_Attribute_Model_Adapter();
      $this->productAttributeModel = $productAttributeModelAdapter->fetchById($id);
    }
    if (!$this->productAttributeModel instanceof Eav_Attribute_Model) {
      die('Requested Product attributes not found');
    }
    $this->productAttributeForm->DataSource = new Amhsoft_Data_Set($this->productAttributeModel);
    $this->productAttributeForm->Bind();
    $this->productAttributeForm->nameInput->addValidator('Unique|entity_attribute|name|' . $this->productAttributeModel->getName());
  }

  /**
   * Default event
   */
  public function __default() {

    if ($this->productAttributeForm->isSend()) {
      $this->productAttributeForm->DataSource = Amhsoft_Data_Source::Post();
      $this->productAttributeForm->Bind();
      if ($this->productAttributeForm->isValid()) {
	$this->productAttributeForm->DataBinding = $this->productAttributeModel;
	$productAttributeModelAdapter = new Eav_Attribute_Model_Adapter($this->getRequest()->get('entity'));
	$this->productAttributeModel = $this->productAttributeForm->getDataBindItem();
	$productAttributeModelAdapter->save($this->productAttributeModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    Amhsoft_Data_Db_Model_Multilanguage_EAV_Adapter::flushEntityPivotView('product', true);
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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
