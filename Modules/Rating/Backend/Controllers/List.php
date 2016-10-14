<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Rating_Backend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Rating_DataGridView $ratingDataGridView */
  protected $ratingDataGridView;

  /** @var Rating_Model_Adapter $ratingModelAdapter */
  protected $ratingModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->ratingModelAdapter = new Rating_Model_Adapter();
    $this->ratingDataGridView = new Rating_DataGridView();
    $this->ratingDataGridView->Sortable = true;
    $this->ratingDataGridView->Searchable = true;
    $this->ratingDataGridView->setWithPagination(true);
    $this->ratingModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List Ratings'), View_Message_Type::INFO);
  }

  /**
   * Go to product details Event
   */
  public function __gotoproduct() {
    $idp = $this->getRequest()->getInt('entity_id');
    $this->getRedirector()->go('admin.php?module=product&page=product-detail&id=' . $idp);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->ratingDataGridView->performSort($this->getRequest(), $this->ratingModelAdapter);
    $this->ratingDataGridView->performSearch($this->getRequest(), $this->ratingModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $items = $this->ratingModelAdapter->fetch();
    $this->ratingDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->ratingDataGridView);
    $this->show();
  }

}

?>