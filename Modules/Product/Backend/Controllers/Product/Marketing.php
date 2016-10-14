<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Marketing.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Marketing_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Panel $mainPanel */
  protected $mainPanel;

  /** @var Product_Product_Model $productModel */
  protected $productModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $productModelAdapter = new Product_Product_Model_Adapter();
      $this->productModel = $productModelAdapter->fetchById($id);
    }
    if (!$this->productModel instanceof Product_Product_Model) {
      die('Requested product not found');
    }
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('submit_next')) {
      if ($this->productModel->isGrouped()) {
	$this->getRedirector()->go('admin.php?module=product&page=product-list');
      } else {
	if ($this->productModel->entity_set_id) {
	  $this->getRedirector()->go('admin.php?module=product&page=product-configuration&product_id=' . $this->productModel->getId());
	} else {
	  $this->getRedirector()->go('admin.php?module=product&page=product-list&ret=true');
	}
      }
    }
    if ($this->getRequest()->isPost('submit_back')) {
      if ($this->productModel->isService()) {
	$this->getRedirector()->go('admin.php?module=product&page=product-media&id=' . $this->productModel->getId());
      } else {
	$this->getRedirector()->go('admin.php?module=product&page=product-shipping&id=' . $this->productModel->getId());
      }
    }
    $this->getView()->setMessage(_t('Manage Media'), View_Message_Type::INFO);
    try {
      $relatedId = Amhsoft_Registry::get('related'); //get key from registry
      if ($relatedId) {
	$this->productModel->addRelatedProduct($relatedId);
	Amhsoft_Registry::destroy('related'); //destroy after insert
      }
      $crossId = Amhsoft_Registry::get('cross'); //get key from registry
      if ($crossId) {
	$this->productModel->addCrossProduct($crossId);
	Amhsoft_Registry::destroy('cross'); //destroy after insert
      }
      $upId = Amhsoft_Registry::get('up'); //get key from registry
      if ($upId) {
	$this->productModel->addUpSellingProduct($upId);
	Amhsoft_Registry::destroy('up'); //destroy after insert
      }
    } catch (Exception $e) {
      
    }
    $this->setUpPanel();
  }

  /**
   * Set Panel
   */
  protected function setUpPanel() {
    $panelRelatedProducts = new Amhsoft_Widget_Panel(_t('Related Products'));
    $productDataGridViewRelated = new Product_Product_DataGridView();
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=product-marketing&event=unassignrelated&id=' . $this->productModel->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'rid';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth('60');
    $productDataGridViewRelated->AddColumn($delCol);
    $productDataGridViewRelated->DataSource = new Amhsoft_Data_Set($this->productModel->getRelatedProducts(false));
    $panelRelatedProducts->addComponent($productDataGridViewRelated);
    $addLink = new Amhsoft_Link_Control(_t('Add new Product'), '?module=product&page=product-quicklist&key=related');
    $addLink->onClickOpenInPopUp(680, 460);
    $addLink->setClass('add');
    $panelRelatedProducts->addComponent($addLink);
    $this->mainPanel->addComponent($panelRelatedProducts);
    $panelCrossSelling = new Amhsoft_Widget_Panel(_t('Cross Selling'));
    $productDataGridViewCross = new Product_Product_DataGridView();
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=product-marketing&event=unassigncross&id=' . $this->productModel->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'cid';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth('60');
    $productDataGridViewCross->AddColumn($delCol);
    $productDataGridViewCross->DataSource = new Amhsoft_Data_Set($this->productModel->getCrossProducts(false));
    $panelCrossSelling->addComponent($productDataGridViewCross);
    $addLink = new Amhsoft_Link_Control(_t('Add new Product'), '?module=product&page=product-quicklist&key=cross');
    $addLink->onClickOpenInPopUp(680, 460);
    $addLink->setClass('add');
    $panelCrossSelling->addComponent($addLink);
    $this->mainPanel->addComponent($panelCrossSelling);
    $panelUpSelling = new Amhsoft_Widget_Panel(_t('Up Selling'));
    $productDataGridViewUp = new Product_Product_DataGridView();
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=product-marketing&event=unassignup&id=' . $this->productModel->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'uid';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth('60');
    $productDataGridViewUp->AddColumn($delCol);
    $productDataGridViewUp->DataSource = new Amhsoft_Data_Set($this->productModel->getUpProducts(false));
    $panelUpSelling->addComponent($productDataGridViewUp);
    $addLink = new Amhsoft_Link_Control(_t('Add new Product'), 'admin.php?module=product&page=product-quicklist&key=up');
    $addLink->onClickOpenInPopUp(680, 460);
    $addLink->setClass('add');
    $panelUpSelling->addComponent($addLink);
    $this->mainPanel->addComponent($panelUpSelling);
  }

  /**
   * Unassign related product event
   */
  public function __unassignrelated() {
    $rid = $this->getRequest()->getInt('rid');
    if ($rid > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM product_has_related_product WHERE related_product_id = $rid AND product_id = " . $this->productModel->getId());
      $this->getRedirector()->go('admin.php?module=product&page=product-marketing&ret=true&id=' . $this->productModel->getId());
    }
  }

  /**
   * Unassign up selling product
   */
  public function __unassignup() {
    $uid = $this->getRequest()->getInt('uid');
    if ($uid > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM product_up_selling WHERE up_id = $uid AND product_id = " . $this->productModel->getId());
      $this->getRedirector()->go('admin.php?module=product&page=product-marketing&ret=true&id=' . $this->productModel->getId());
    }
  }

  /**
   * Unassign cross selling product
   */
  public function __unassigncross() {
    $cid = $this->getRequest()->getInt('cid');
    if ($cid > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM product_cross_selling WHERE cross_id = $cid AND product_id = " . $this->productModel->getId());
      $this->getRedirector()->go('admin.php?module=product&page=product-marketing&ret=true&id=' . $this->productModel->getId());
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->mainPanel);
    $this->getView()->assign('product', $this->productModel);
    $this->show();
  }

}

?>
