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
class Saleorder_Comment_DataGridView extends Amhsoft_Widget_DataGridView {

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $author_name = new Amhsoft_Link_Control(_t('Author Name'), "?module=saleorder&page=comment-details");
    $author_name->DisplayValue = "author_name";
    $author_name->Alias = 'id';
    $author_name->DataBinding = new Amhsoft_Data_Binding('id','author_name');


    $insertAt = new Amhsoft_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insertat'));
    $accountSeen = new Amhsoft_YesNo_Image_Control(_t('Account Seen'), new Amhsoft_Data_Binding('account_seen'));
    $adminSeen = new Amhsoft_YesNo_Image_Control(_t('Admin Seen'), new Amhsoft_Data_Binding('admin_seen'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=saleorder&page=comment-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->onClickOpenInPopUp(600, 320);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=saleorder&page=comment-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(80);
    $editCol->setWidth(80);

    $this->AddColumn($author_name);
    $this->AddColumn($insertAt);
    $this->AddColumn($accountSeen);
    $this->AddColumn($adminSeen);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

}

?>
