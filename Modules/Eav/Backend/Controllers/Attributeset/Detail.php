<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributeset_Detail_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Set_Model $productSetModel */
  protected $productSetModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $productSetModelAdapter = new Eav_Set_Model_Adapter();
    $this->productSetModel = $productSetModelAdapter->fetchById($id);
    if (!$this->productSetModel instanceof Eav_Set_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->getView()->setMessage(_t('Product Set Details'), View_Message_Type::INFO);
    $this->includeJsFile('product-detail-attributeset.js');
  }

  /**
   * Get Unused Attributes
   * @param type $setid
   * @return type
   */
  public function getUnUsedAttribtues($setid) {
    if (intval($setid) == 0) {
      return;
    }
    
    $attributeAdapter = new Eav_Attribute_Model_Adapter();
    $attributeAdapter->where('entity_id = ?', $this->getRequest()->getInt('entity'));
    $attributeAdapter->where('id  not in (select entity_attribute_id FROM entity_set_has_entity_attribute WHERE entity_set_id = ' . $setid . ')');
    return $attributeAdapter->fetch();
  }

  /**
   * Event/action Order Boxes
   */
  public function __order() {
    $attributes = Amhsoft_Web_Request::postInts('attribute');
    $type = Amhsoft_Web_Request::get('type');
    $setid = $this->getRequest()->getId();
    if ($setid <= 0) {
      exit;
    }
    if ($type == 'unsed') {
      exit;
    }
    $_type = explode('_', $type);
    if (count($_type) != 2) {
      exit;
    }
    $viewid = intval($_type[1]);
    if ($viewid > 0) {
      $sql_delete = "DELETE FROM entity_set_has_entity_attribute WHERE entity_set_id = $setid AND entity_set_view_id = $viewid";
    } else {
      $sql_delete = "DELETE FROM entity_set_has_entity_attribute WHERE entity_set_id = $setid AND entity_set_view_id IS NULL";
    }
    try {
      $delstmt = Amhsoft_Database::getInstance()->prepare($sql_delete);
      $delstmt->execute();
    } catch (Exception $e) {
      echo 'delete msg: ' + $e->getMessage();
    }
    try {
      if ($viewid == 0)
	$viewid = 'NULL';
      foreach ($attributes as $i => $attribute) {
	$sql_insert = "INSERT INTO entity_set_has_entity_attribute (entity_set_id, entity_attribute_id, sortid, entity_set_view_id) VALUES('$setid', '$attribute',  '$i', $viewid)";
	$stmt = Amhsoft_Database::newInstance()->prepare($sql_insert);
	$stmt->execute();
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    exit;
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {

    $this->getView()->assign('views', $this->productSetModel->getViews());
    $this->getView()->assign('setname', $this->productSetModel->getName());
    $this->getView()->assign('generalattributes', $this->productSetModel->getGeneralAttributes());
    $this->getView()->assign('unusedattributes', $this->getUnUsedAttribtues($this->productSetModel->getId()));
    $this->show();
  }

}

?>
