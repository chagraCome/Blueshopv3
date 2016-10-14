<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Backend_Page_Quicklist_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Page_Model_Adapter  $cmsPageModelAdapter */
  protected $cmsPageModelAdapter;

  /** @var DataGridView $dataGridView */
  protected $dataGridView;
  protected $registerkey = 'page_quick_list_selected_id';

  /**
   * Initialize Controller
   */
  public function __initialize() {
    if ($this->getRequest()->get('key')) {
      $this->registerkey = $this->getRequest()->get('key');
    }
    $this->cmsPageModelAdapter = new Cms_Page_Model_Adapter();
    $this->dataGridView = new Amhsoft_Widget_DataGridView();
    $this->initializeDataGridView();
  }

  /**
   * Initialize Page DataGridView
   */
  protected function initializeDataGridView() {
    $this->dataGridView->performSort($this->getRequest(), $this->cmsPageModelAdapter);
    $this->dataGridView->performSearch($this->getRequest(), $this->cmsPageModelAdapter);
    $nameCol = new Amhsoft_Link_Control(_t('Page Name'), 'admin.php?module=cms&page=page-quicklist&event=select&key=' . $this->registerkey);
    $nameCol->DisplayValue = 'title';
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'title');
    $this->dataGridView->AddColumn($nameCol);
    $this->dataGridView->addSearcField('text');
    $siteCol = new Amhsoft_Label_Control(_t('Website'), new Amhsoft_Data_Binding('site', 'cms_site_id'));
    $this->dataGridView->AddColumn($siteCol);
    $siteListBox = new Amhsoft_ListBox_Control('cms_site_id', _t('Site'));
    $siteListBox->WithNullOption = true;
    $siteListBox->DataBinding = new Amhsoft_Data_Binding('cms_site_id', 'id', 'name');
    $siteListBox->DataSource = Amhsoft_Data_Source::Table('cms_site');
    $this->dataGridView->addSearcField($siteListBox);
    $onOffLinkCol = new Amhsoft_Link_OnOffline_Control(_t('Status'), '#');
    $onOffLinkCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $onOffLinkCol->setClass('edit');
    $this->dataGridView->AddColumn($onOffLinkCol);

    $this->dataGridView->Sortable = true;
    $this->dataGridView->Searchable = true;
    $this->dataGridView->setWithPagination(true);
    $this->dataGridView->setRowCountProPage(50);
  }

  /**
   * Selected Page event
   */
  public function __select() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
      $cmsPage = $cmsPageModelAdapter->fetchById($id);
      if ($cmsPage instanceof Cms_Page_Model) {
	$this->close(array('page' => $cmsPage->getTitle(), 'cms_page_id' => $id));
      }
    }
  }

  /**
   * Default event
   */
  public function __default() {
    $this->dataGridView->performSearch($this->getRequest(), $this->cmsPageModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->cmsPageModelAdapter->fetch());
    $panel = new Amhsoft_Widget_Panel(_t('Select a Page'));
    $panel->addComponent($this->dataGridView);
    $this->getView()->assign('grid', $panel);
    $this->popup();
  }

}

?>
