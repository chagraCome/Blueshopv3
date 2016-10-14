<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Backend_Page_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Page_DataGridView $cmsPageDataGridView */
  protected $cmsPageDataGridView;

  /** @var Cms_Page_Model_Adapter $cmsPageModelAdapter */
  protected $cmsPageModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Manage Pages'), View_Message_Type::INFO);
    if ($this->getRequest()->get('ret') == 'fixed') {
      $this->getView()->setMessage(_t('Failed to delete this page because this page is fixed'), View_Message_Type::ERROR);
    }
    $this->cmsPageModelAdapter = new Cms_Page_Model_Adapter();
    $this->cmsPageDataGridView = new Cms_Page_DataGridView('admin.php');
    $this->cmsPageDataGridView->LinkUrl = 'admin.php';
    $this->cmsPageDataGridView->Sortable = true;
    $this->cmsPageDataGridView->Searchable = true;
    $this->cmsPageDataGridView->setWithPagination(true);
    $this->cmsPageDataGridView->performSort($this->getRequest(), $this->cmsPageModelAdapter);
    $this->cmsPageDataGridView->performSearch($this->getRequest(), $this->cmsPageModelAdapter);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->cmsPageDataGridView->performSort($this->getRequest(), $this->cmsPageModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->cmsPageModelAdapter->where('fixed = 0');
    $projects = $this->cmsPageModelAdapter->fetch();
    $this->cmsPageDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->cmsPageDataGridView);
    $this->show();
  }

}

?>
