<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Template_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Template_DataGridView  $newsletterTemplateDataGridView  */
  protected $newsletterTemplateDataGridView;

  /** @var Newsletter_Template_Model_Adapter $newsletterTemplateModelAdapter */
  protected $newsletterTemplateModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->newsletterTemplateModelAdapter = new Newsletter_Template_Model_Adapter();
    $this->newsletterTemplateDataGridView = new Newsletter_Template_DataGridView ();
    $this->newsletterTemplateDataGridView->Sortable = true;
    $this->newsletterTemplateDataGridView->Searchable = true;
    $this->newsletterTemplateDataGridView->setWithPagination(true);
    $this->newsletterTemplateModelAdapter->orderBy("id DESC");
    $this->getView()->setMessage(_t('List Newsletter Template'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->newsletterTemplateDataGridView->performSort($this->getRequest(), $this->newsletterTemplateModelAdapter);
    $this->newsletterTemplateDataGridView->performSearch($this->getRequest(), $this->newsletterTemplateModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $items = $this->newsletterTemplateModelAdapter->fetch();
    $this->newsletterTemplateDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $this->getView()->assign('widget', $this->newsletterTemplateDataGridView);
    $this->show();
  }

}
?>

