<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Document_DataGridView extends Amhsoft_Widget_DataGridView {

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->linkUrl = $linkUrl;
    $this->initializeComponents();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $nameCol = new Amhsoft_Label_Control(_t('Document Name'));
    $nameCol->DataBinding = new Amhsoft_Data_Binding('name');
    $typeCol = new Amhsoft_Label_Control(_t('Document Type'), new Amhsoft_Data_Binding('type'));
    $delLinkCol = new Amhsoft_Link_Control(_t('Download'), '?module=product&page=document-detail');
    $delLinkCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delLinkCol->Class = 'details';
    $delLinkCol->setWidth(80);
    $editLink = new Amhsoft_Link_Control(_t('Delete'), '?module=product&page=document-delete');
    $editLink->DataBinding = new Amhsoft_Data_Binding('id');
    $editLink->Class = 'delete';
    $editLink->setWidth(80);
    $this->AddColumn($nameCol);
    $this->AddColumn($typeCol);
    $this->AddColumn($editLink);
    $this->AddColumn($delLinkCol);
  }

}

?>
