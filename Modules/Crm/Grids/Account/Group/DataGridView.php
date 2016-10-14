<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Account_Group_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  public function initializeComponents() {
    $nameCol = new Amhsoft_Link_Control(_t('Name'), '?module=crm&page=account-group-detail');
    $nameCol->DisplayValue = "name";
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $nameCol->setWidth("800");
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=account-group-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth("80");
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=account-group-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth("80");
    $defaultCol = new Amhsoft_Link_OnOffline_Control(_t('Set as default'), '?module=crm&page=account-group-list&event=asdefault');
    $defaultCol->DataBinding = new Amhsoft_Data_Binding('id', 'as_default');
    $defaultCol->OnlineLabel = _t('Default');
    $defaultCol->OfflineLabel = '-';
    $defaultCol->setWidth("100");
    $this->AddColumn($nameCol);
    $this->AddColumn($defaultCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
  }

}

?>
