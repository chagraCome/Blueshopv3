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

class Eav_Backend_Attributesource_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Attribute_DataSource_Model_Adapter $productAttributeDataSourceModelAdapter */
  protected $productAttributeDataSourceModelAdapter;
  protected $attribute_id;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->attribute_id = $this->getRequest()->getInt('attribute_id');
    if ($this->attribute_id <= 0) {
      die('please select attribute');
    }
    $this->getView()->setMessage(_t('Manage Attribute Values'), View_Message_Type::INFO);
    $this->productAttributeDataSourceModelAdapter = new Eav_Attribute_DataSource_Model_Adapter();
    $this->productAttributeDataSourceModelAdapter->where('entity_attribute_id = ?', $this->attribute_id);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('save')) {
      $this->saveClickEvent();
    }
  }

  /**
   * Save event
   */
  protected function saveClickEvent() {
    $attributesources = $this->getRequest()->posts('value');
    foreach ($attributesources as $id => $value) {
      $this->saveAttributeSource($id, $value);
    }
  }

  /**
   * Save attribute
   * @param type $id
   * @param type $value
   * @return boolean
   */
  protected function saveAttributeSource($id, $value) {
    if (trim($value) == '') {
      return false;
    }
    $productAttributeSourceAdapter = new Eav_Attribute_DataSource_Model_Adapter();
    $productAttributeSource = new Eav_Attribute_DataSource_Model();
    $productAttributeSource->setId($id);
    $productAttributeSource->setValue($value);
    $productAttributeSource->setEntity_attribute_id($this->attribute_id);
    $productAttributeSourceAdapter->save($productAttributeSource);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('attributeValues', $this->productAttributeDataSourceModelAdapter->fetch());
    $this->show();
  }

}

?>
