<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Page_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $nameCol;
  protected $siteCol;

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $this->nameCol = new Amhsoft_Link_Control(_t('Page Title'), '?module=cms&page=page-modify');
    $this->nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'title');
    $this->nameCol->DisplayValue = 'title';
    $this->AddColumn($this->nameCol);
    $this->siteCol = new Amhsoft_Label_Control(_t('Website'), new Amhsoft_Data_Binding('site', 'cms_site_id'));
    $this->AddColumn($this->siteCol);
    $editCol = new Amhsoft_Link_Control(_t('Edit'), $this->LinkUrl . '?module=cms&page=page-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->setClass('edit');
    $editCol->setWidth(60);
    $onOffLinkCol = new Amhsoft_Link_OnOffline_Control(_t('State'), $this->LinkUrl . '?module=cms&page=page-offline');
    $onOffLinkCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $onOffLinkCol->setClass('edit');
    $onOffLinkCol->setWidth(60);
    $deleteCol = new Amhsoft_Link_Control(_t('Delete'), $this->LinkUrl . '?module=cms&page=page-delete');
    $deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $deleteCol->setClass('delete');
    $deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $deleteCol->setWidth(60);
    $layoutCol = new Amhsoft_Link_Control(_t('Modify Design'), $this->LinkUrl . '?module=cms&page=page-design');
    $layoutCol->DataBinding = new Amhsoft_Data_Binding('id');
    $layoutCol->Alias = 'pageid';
    $layoutCol->setClass('edit');
    $layoutCol->setWidth(99);
    $this->AddColumn($onOffLinkCol);
    $this->AddColumn($editCol);
    $this->AddColumn($deleteCol);
    $this->AddColumn($layoutCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->addSearcField('text');
    $siteListBox = new Amhsoft_ListBox_Control('cms_site_id', _t('Site'));
    $siteListBox->WithNullOption = true;
    $siteListBox->DataBinding = new Amhsoft_Data_Binding('cms_site_id', 'id', 'name');
    $siteListBox->DataSource = Amhsoft_Data_Source::Table('cms_site');
    $this->addSearcField($siteListBox);
  }

}

?>
