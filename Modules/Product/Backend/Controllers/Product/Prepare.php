<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Prepare.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Prepare_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Add new Product'), View_Message_Type::INFO);
    if ($this->getRequest()->isPost('next')) {
      $this->getRedirector()->go('admin.php?module=product&page=product-add&setid=' . $this->getRequest()->postInt('set_id') . '&typeid=' . $this->getRequest()->postInt('type_id'));
    }
  }

  /**
   * Get Form
   * @return \Amhsoft_Widget_Form
   */
  protected function getPrepareForm() {
    $form = new Amhsoft_Widget_Form('preparefrom', 'post');
    $productTypeSelect = new Amhsoft_ListBox_Control('type_id', _t('Product Type'));
    $data = array(
	array('id' => Product_Product_Model::SIMPLE, 'name' => _t('Simple Product')),
	array('id' => Product_Product_Model::SERVICE, 'name' => _t('Service Product')),
	array('id' => Product_Product_Model::GROUPED, 'name' => _t('Grouped Product')),
    );
    $productTypeSelect->DataSource = new Amhsoft_Data_Set($data);
    $productTypeSelect->DataBinding = new Amhsoft_Data_Binding('type_id', 'id', 'name');
    $productTypeSelect->setRequired(true);
    $form->addComponent($productTypeSelect);
    $productSetModelAdapter = new Eav_Set_Model_Adapter();
    $productSetModelAdapter->where('entity_id = 1');
    $productSetSelect = new Amhsoft_ListBox_Control('set_id', _t('Attribute Set'));
    $data = $productSetModelAdapter->fetch()->fetchAll();
    array_unshift($data, array('id' => '0', 'name' => _t('Default Attribute Set')));
    $productSetSelect->DataSource = new Amhsoft_Data_Set($data);
    $productSetSelect->DataBinding = new Amhsoft_Data_Binding('set_id', 'id', 'name');
    $productSetSelect->setRequired(true);
    $form->addComponent($productSetSelect);
    $submit = new Amhsoft_Button_Submit_Control('next', _t('Next Step'));
    $submit->Class = 'Button For';
    $form->addComponent($submit);
    return $form;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->getPrepareForm());
    $this->show();
  }

}

?>
