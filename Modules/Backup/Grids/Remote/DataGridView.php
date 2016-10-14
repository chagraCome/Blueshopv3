<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Backup
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Backup_Remote_DataGridView extends Amhsoft_Widget_DataGridView {

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
    $nameCol = new Amhsoft_Label_Control(_t('Backup Name'), new Amhsoft_Data_Binding('name'));
    $sizeCol = new Amhsoft_Label_Control(_t('Filesize'), new Amhsoft_Data_Binding('filesize'));
    $insertAtCol = new Amhsoft_Date_Time_Label_Control(_t('Date'), new Amhsoft_Data_Binding('insertat'));
    $insertAtCol->setWidth(160);
    $editCol = new Amhsoft_Link_Control(_t('Restore'), '?module=backup&page=remotelist&event=restore');
    $editCol->DataBinding = new Amhsoft_Data_Binding('name');
    $editCol->Class = 'edit';
    $editCol->setWidth(80);
    $downloadCol = new Amhsoft_Link_Control(_t('Download'), '?module=backup&page=remotelist&event=download');
    $downloadCol->DataBinding = new Amhsoft_Data_Binding('name');
    $downloadCol->Class = 'download';
    $downloadCol->setWidth(80);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=backup&page=remotelist&event=delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('name');
    $delCol->Class = 'delete';
    $delCol->setWidth(80);
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->AddColumn($nameCol);
    $this->AddColumn($sizeCol);
    $this->AddColumn($insertAtCol);
    $this->AddColumn($downloadCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('date');
  }

}

?>
