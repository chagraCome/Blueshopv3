<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Grouped.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Grouped_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Panel $mainPanel */
  protected $mainPanel;

  /** @var Product_Product_Model $productModel */
  protected $productModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $productModelAdapter = new Product_Product_Model_Adapter();
      $this->productModel = $productModelAdapter->fetchById($id);
    }
    if (!$this->productModel instanceof Product_Product_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Manage Grouped Products'), View_Message_Type::INFO);
    if ($this->getRequest()->isPost('submit_next')) {
      $this->getRedirector()->go('admin.php?module=product&page=price-modify&id=' . $this->productModel->getId());
    }
    if ($this->getRequest()->isPost('submit_back')) {
      $this->getRedirector()->go('admin.php?module=product&page=product-modify&id=' . $this->productModel->getId());
    }
    //check if a product is selected!
    $selectedproduct = Amhsoft_Registry::get('product_quick_list_selected_id');
    if ($selectedproduct) {
      try {
	$this->productModel->addGroupedProduct($selectedproduct);
      } catch (Exception $e) {
	$this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
      }
    }
    //destroy session after adding product to quotation
    Amhsoft_Registry::destroy('product_quick_list_selected_id');
    $this->setUpPanel();
  }

  /**
   * Setup Panel
   */
  protected function setUpPanel() {
    $panelRelatedProducts = new Amhsoft_Widget_Panel(_t('Grouped Products'));
    $productDataGridView = new Product_Product_DataGridView();
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=product-grouped&event=deleteproduct&id=' . $this->productModel->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'product_id';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $productDataGridView->AddColumn($delCol);
    $productDataGridView->DataSource = new Amhsoft_Data_Set((array) $this->productModel->getGroupedProducts());
    $panelRelatedProducts->addComponent($productDataGridView);
    $addLink = new Amhsoft_Link_Control(_t('Select Product'), 'admin.php?module=product&page=product-quicklist');
    $addLink->onClickOpenInPopUp(680, 460);
    $addLink->setClass('add');
    $panelRelatedProducts->addComponent($addLink);
    $this->mainPanel->addComponent($panelRelatedProducts);
  }

  /**
   * Delete Product event
   */
  public function __deleteproduct() {
    $productId = $this->getRequest()->getInt('product_id');
    if ($productId > 0) {
      $sql = "DELETE FROM product_hast_grouped_product WHERE grouped_id = :gid AND product_id = :pid LIMIT 1";
      $stmt = Amhsoft_Database::getInstance()->prepare($sql);
      $stmt->bindParam(':gid', $this->productModel->getId());
      $stmt->bindParam(':pid', $productId);
      $stmt->execute();
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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
