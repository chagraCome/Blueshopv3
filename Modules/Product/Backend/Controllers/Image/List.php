<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Image_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var ImageDataGridView $imageDataGridView */
  protected $imageDataGridView;

  /** @var ImageModelAdapter $imageModelAdapter */
  protected $imageModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->imageModelAdapter = new Product_Image_Model_Adapter();
    $this->imageDataGridView = new Product_Image_DataGridView();
    $this->imageDataGridView->Sortable = true;
    $this->imageDataGridView->Searchable = true;
    $this->imageDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Images'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->imageDataGridView->performSort($this->getRequest(), $this->imageModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $projects = $this->imageModelAdapter->fetch();
    $this->imageDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->imageDataGridView);
    $this->show();
  }

}

?>
