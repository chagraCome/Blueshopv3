<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Category_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

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
    $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $parentCol = new Amhsoft_Label_Control(_t('Parent'), new Amhsoft_Data_Binding('parent'));
    $sortIdCol = new Amhsoft_Label_Control(_t('Sort Id'), new Amhsoft_Data_Binding('sortId'));
    $stateCol = new Amhsoft_Link_OnOffline_Control(_t('State'), '?module=product&page=category-online');
    $stateCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $stateCol->setWidth("60");
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=product&page=category-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth("60");
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=product&page=category-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth("60");
    $this->AddColumn($nameCol);
    $this->AddColumn($stateCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $state = new Amhsoft_YesNo_ListBox_Control('state', _t('State'), 'state', 'yes');
    $state->WithNullOption = true;
    $this->addSearcField($state);
  }

}

?>
