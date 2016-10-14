<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Configuration.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Configuration_Controller extends Amhsoft_System_Web_Controller {

  protected $setId;

  /** @var ProductSetModel $setModel */
  protected $setModel;
  protected $configurationId;

  /** @var Amhsoft_Widget_Panel $mainPanel */
  protected $mainPanel;

  /** @var ProductModel $productModel */
  protected $productModel;
  protected $productModelAdapter;
  protected $configurationAttributes = array();

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Product Configurations'), View_Message_Type::INFO);
    $id = $this->getRequest()->getInt('product_id');
    if ($id > 0) {
      $productModelAdapter = new Product_Product_Model_Adapter();
      $this->productModel = $productModelAdapter->fetchById($id);
    }
    if (!$this->productModel instanceof Product_Product_Model) {
      die('Requested product not found');
    }
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->productModelAdapter = new Product_Product_Model_Adapter();
    $this->setId = $this->productModel->entity_set_id;
    $this->configurationId = $this->getRequest()->getInt('confid');
    $attributeSetAdapter = new Eav_Set_Model_Adapter();
    $this->setModel = $attributeSetAdapter->fetchById($this->setId);
    if (!$this->setModel instanceof Eav_Set_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->productModelAdapter->where('entity_set_id = ?', $this->setId);
    $confidsql = "SELECT product_configuration_id FROM product_configuration_has_product WHERE product_id = " . $this->getRequest()->getInt('product_id');
    $stmt = Amhsoft_Database::getInstance()->query($confidsql);
    $stmt->execute();
    $this->configurationId = $stmt->fetchColumn();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('submit')) {
      $this->saveConfiguration();
      if ($this->getRequest()->isPost('ajaxreq')) {
	exit;
      }
    }
    foreach ($this->setModel->getAttributes() as $attribute) {
      if (($attribute->entity_attribute_type_backend_id == 2 || $attribute->entity_attribute_type_backend_id = 21) && (isset($attribute->datasources))) {
	$this->configurationAttributes[] = $attribute;
      }
    }
    $this->setUpPanel();
  }

  /**
   * Set the Attributes Panel 
   */
  protected function setUpPanel() {
    $attributeForm = new Amhsoft_Widget_Form('attribute_form', 'post');
    $attributeForm->addComponent(new Amhsoft_Hidden_Control('product_id', null, $this->getRequest()->getInt('product_id')));
    $selected_product_attributes = array();
    if (intval($this->configurationId) > 0) {
      $sql = "SELECT product_attribute_id FROM product_configuration_has_product_attribute WHERE product_configuration_id = " . $this->configurationId;
      $stmt = Amhsoft_Database::getInstance()->query($sql);
      while ($row = $stmt->fetch()) {
	$selected_product_attributes[] = $row['product_attribute_id'];
      }
    }
    $panelConfigurationAttributes = new Amhsoft_Widget_Panel(_t('Configuration Attributes'));
    $panelConfigurationAttributes->setStyle('&nbsp;');
    for ($i = 0; $i < count($this->configurationAttributes); $i++) {
      $checkBox = new Amhsoft_CheckBox_Control('product_attribute[]', $this->configurationAttributes[$i]->label);
      $checkBox->Value = $this->configurationAttributes[$i]->id;
      if (in_array($this->configurationAttributes[$i]->id, $selected_product_attributes)) {
	$checkBox->Checked = true;
      }
      $checkBox->Id = 'product_attribute_' . $i;
      $panelConfigurationAttributes->addComponent($checkBox);
    }
    $attributeForm->addComponent($panelConfigurationAttributes);
    $panelRelatedProducts = new Amhsoft_Widget_Panel(_t('Configurable Products'));
    $productDataGridView = new Product_Product_DataGridView(array('product_id' => 'c'));
    $productDataGridView->setRowCountProPage(500);
    if (intval($this->configurationId) > 0) {
      $sql = "SELECT product_id FROM product_configuration_has_product WHERE product_configuration_id = " . $this->configurationId;
      $stmt = Amhsoft_Database::getInstance()->query($sql);
      while ($row = $stmt->fetch()) {
	$productDataGridView->addCheckedLine($row['product_id']);
      }
    }
    $this->productModelAdapter->where('id <> ' . $this->productModel->getId());
    $this->productModelAdapter->where('category_id = ' . $this->productModel->category_id);
    $this->productModelAdapter->where('entity_set_id = ' . $this->productModel->entity_set_id);
    $where_configuration = $this->configurationId ? "WHERE product_configuration_id <> ".$this->configurationId : '';
    $this->productModelAdapter->where("id NOT IN (SELECT product_id FROM product_configuration_has_product $where_configuration)");
    
    for ($i = 0; $i < count($this->configurationAttributes); $i++) {
      if ($this->configurationAttributes[$i]->entity_attribute_type_backend_id == 21) {
	$label = new Amhsoft_ColorLabel_Control($this->configurationAttributes[$i]->label, new Amhsoft_Data_Binding($this->configurationAttributes[$i]->name . '_value'));
	$label->setLabel($this->configurationAttributes[$i]->label);
      } else {
	$label = new Amhsoft_Label_Control($this->configurationAttributes[$i]->label, new Amhsoft_Data_Binding($this->configurationAttributes[$i]->name . '_value'));
      }
      $productDataGridView->AddColumn($label);
    }
    $productDataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter);
    $panelRelatedProducts->addComponent($productDataGridView);
    $attributeForm->addComponent($panelRelatedProducts);
    $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save Configuration'));
    $submitButton->setClass('ButtonSave');
    $panelNavigation->addComponent($submitButton);
    $attributeForm->addComponent($panelNavigation);
    $this->mainPanel->addComponent($attributeForm);
  }

  /**
   * Save Configuration
   */
  protected function saveConfiguration() {
    $product_attributes = $this->getRequest()->postInts('product_attribute');
    $product_ids = $this->getRequest()->postInts('id');
    $db = Amhsoft_Database::newInstance();
    $db->beginTransaction();
    try {
      if ($this->configurationId == 0) {
	$sql = "INSERT INTO product_configuration VALUES (NULL, '', $this->setId)";
	$db->exec($sql);
	$this->configurationId = $db->lastInsertId();
      } else {
	$sql = "UPDATE product_configuration SET `name` = '' WHERE id = $this->configurationId LIMIT 1";
	$db->exec($sql);
      }
      $db->exec("DELETE FROM product_configuration_has_product_attribute WHERE product_configuration_id = $this->configurationId");
      foreach ($product_attributes as $attribute) {
	$db->exec("INSERT INTO product_configuration_has_product_attribute VALUES ($this->configurationId, $attribute)");
      }
      $db->exec("DELETE FROM product_configuration_has_product WHERE product_configuration_id = $this->configurationId");
      foreach ($product_ids as $productid) {
	$db->exec("INSERT INTO product_configuration_has_product VALUES ($this->configurationId, $productid)");
      }
      $db->exec("INSERT INTO product_configuration_has_product VALUES ($this->configurationId, " . $this->getRequest()->getInt('product_id') . ")");
      $db->commit();
      $this->getRedirector()->go('?module=product&page=product-list' . '&ret=true');
    } catch (Exception $e) {
      $db->rollBack();
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('product', $this->productModel);
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show();
  }

}

?>
