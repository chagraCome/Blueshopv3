<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Comment_Backend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Comment_DataGridView $commentDataGridView */
  protected $commentDataGridView;

  /** @var Comment_Model_Adapter $commentModelAdapter */
  protected $commentModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->commentModelAdapter = new Comment_Model_Adapter();
    $this->commentDataGridView = new Comment_DataGridView();
    $this->commentDataGridView->Sortable = true;
    $this->commentDataGridView->Searchable = true;
    $this->commentDataGridView->setWithPagination(true);
    $this->commentModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List comments'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->commentDataGridView->performSearch($this->getRequest(), $this->commentModelAdapter);
    $this->commentDataGridView->performSort($this->getRequest(), $this->commentModelAdapter);
  }

  /**
   * Finalize Controller
   */
  public function __finalize() {
    $items = $this->commentModelAdapter->fetch();
    $this->commentDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->commentDataGridView);
    $this->show();
  }

}
?>

