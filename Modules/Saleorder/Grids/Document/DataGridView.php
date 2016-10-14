<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of BannerImageDataGridView
 *
 * @author cherif
 */
class Saleorder_Document_DataGridView extends Amhsoft_Widget_DataGridView {

  public $mailLinkCol;

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->linkUrl = $linkUrl;
    $this->initializeComponents();
  }

  public function initializeComponents() {


    $nameCol = new Amhsoft_Link_Control(_t('Document Name'), '');
    $nameCol->DataBinding = new Amhsoft_Data_Binding('absolutepath', 'name');
    $nameCol->DisplayValue = 'name';
    $nameCol->Alias = 'name';

    $this->mailLinkCol = new Amhsoft_Link_Control(_t('Mail'), '#');
    $this->mailLinkCol->DataBinding = new Amhsoft_Data_Binding('absolutepath');
    $this->mailLinkCol->Alias = 'docid';
    $this->mailLinkCol->Class = 'sendto';
    $this->mailLinkCol->setWidth(80);


    $typeCol = new Amhsoft_Label_Control(_t('Document Type'), new Amhsoft_Data_Binding('type'));

    $public = new Amhsoft_YesNo_Text_Control(_t('Public'), new Amhsoft_Data_Binding('public'));


    $delLinkCol = new Amhsoft_Link_Control(_t('Edit'), '?module=saleorder&page=document-modify');
    $delLinkCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delLinkCol->Class = 'edit';
    $delLinkCol->setWidth(80);


    $editLink = new Amhsoft_Link_Control(_t('Delete'), '?module=saleorder&page=document-delete');
    $editLink->DataBinding = new Amhsoft_Data_Binding('id');
    $editLink->Class = 'delete';
    $editLink->setWidth(80);

    $this->AddColumn($nameCol);
    $this->AddColumn($typeCol);
    $this->AddColum($this->mailLinkCol);
    $this->AddColumn($public);
    $this->AddColumn($editLink);
    $this->AddColumn($delLinkCol,'modify');
  }

}

?>