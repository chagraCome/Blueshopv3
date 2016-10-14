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

/**
 * Description of Crm_Account_Document_DataGridView
 *
 * @author Montasser
 */
class Crm_Account_Document_DataGridView extends Amhsoft_Widget_DataGridView {

  public $mailLinkCol;

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $download = new Amhsoft_Link_Control(_t('Download'), '?module=crm&page=account-document-detail');
    $download->DataBinding = new Amhsoft_Data_Binding('id');
    $name = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $public = new Amhsoft_YesNo_Text_Control(_t('Public'), new Amhsoft_Data_Binding('public'));
    $this->mailLinkCol = new Amhsoft_Link_Control(_t('Mail'), '#');
    $this->mailLinkCol->DataBinding = new Amhsoft_Data_Binding('absolutepath');
    $this->mailLinkCol->Alias = 'docid';
    $this->mailLinkCol->Class = 'sendto';
    $this->mailLinkCol->setWidth(80);
    $delLinkCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=account-document-delete');
    $delLinkCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delLinkCol->Class = 'delete';
    $delLinkCol->setWidth(80);
    $this->AddColumn($download);
    $this->AddColum($name);
    $this->AddColumn($public);
    $this->addColum($this->mailLinkCol, 'maillink');
    $this->AddColumn($delLinkCol);
  }

}

?>
