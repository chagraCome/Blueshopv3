<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

class Saleorder_State_DataGridView extends Amhsoft_Widget_DataGridView {



  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
   $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=saleorder&page=state-modify');
    $editCol->DataBinding =new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=saleorder&page=state-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(60);
    $editCol->setWidth(60);
    $this->AddColumn($nameLabel);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol,'delete');
  }

}

?>
