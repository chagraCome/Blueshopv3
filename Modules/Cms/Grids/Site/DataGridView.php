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

class Cms_Site_DataGridView extends Amhsoft_Widget_DataGridView {

  public $nameLabel;
  public $stateLabel;

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = '') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $this->nameLabel = new Amhsoft_Label_Control(_t('Site Name'), new Amhsoft_Data_Binding('name'));
    $this->stateLabel = new Amhsoft_Link_OnOffline_Control(_t('Status'), '?module=cms&page=site-online');
    $this->stateLabel->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $this->stateLabel->setWidth(60);
    $defaultCol = new Amhsoft_Link_OnOffline_Control(_t('Set as default'), '?module=cms&page=site-list&event=asdefault');
    $defaultCol->OnlineLabel = _t('Default');
    $defaultCol->OfflineLabel = '-';
    $defaultCol->DataBinding = new Amhsoft_Data_Binding('id', 'defaultsite');
    $defaultCol->setWidth("100");
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=cms&page=site-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->setWidth(60);
    $delCol->setClass('delete');
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=cms&page=site-modify');
    $editCol->setWidth(60);
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->setClass('edit');
    $layoutCol = new Amhsoft_Link_Control(_t('Modify Design'), '?module=cms&page=site-design');
    $layoutCol->DataBinding = new Amhsoft_Data_Binding('id');
    $layoutCol->Alias = 'siteid';
    $layoutCol->setWidth(99);
    $layoutCol->setClass('edit');
    $this->AddColumn($this->nameLabel);
    $this->AddColumn($this->stateLabel);
    $this->AddColumn($defaultCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
    $this->AddColumn($layoutCol);
  }

  /**
   * Initialize Search Fiels
   */
  public function initializeSearch() {
    $this->addSearcField('text');
  }

}

?>
