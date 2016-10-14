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

class Product_Image_DataGridView extends Amhsoft_Widget_DataGridView {

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->linkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $nameCol = new Amhsoft_Label_Control(_t('Image Name'), new Amhsoft_Data_Binding('name'));
    $imageCol = new Amhsoft_ImageTag_Control(_t('Image'), 'thumb_image', 0, 0);
    $imageCol->DataBinding = new Amhsoft_Data_Binding('thumb_image');
    $imageCol->setWidth(80);
    $imageCol->setHeight(80);
    $typeCol = new Amhsoft_Label_Control(_t('Type'), new Amhsoft_Data_Binding('type'));
    $extentionCol = new Amhsoft_Label_Control(_t('Extension'), new Amhsoft_Data_Binding('extention'));
    $publicCol = new Amhsoft_YesNo_Image_Control(_t('Public'), new Amhsoft_Data_Binding('public'));
    $remoteUrlCol = new Amhsoft_Label_Control(_t('RemoteURL'), new Amhsoft_Data_Binding('remote_url'));
    $insertAtCol = new Amhsoft_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insertat'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=product&page=image-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=product&page=image-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->AddColumn($imageCol);
    $this->AddColumn($nameCol);
    $this->AddColumn($publicCol);
    $this->AddColumn($remoteUrlCol);
    $this->AddColumn($insertAtCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->addSearcField('text');
    $this->addSearcField(null);
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
  }

}

?>
