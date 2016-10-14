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
class Crm_Contact_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  public function __construct($linkUrl = 'admin.php', $headers = array()) {
    parent::__construct($headers);
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  public function initializeComponents() {
    $numberCol = new Amhsoft_Label_Control(_t('Number'));
    $numberCol->DataBinding = new Amhsoft_Data_Binding('number');
    $numberCol->setWidth(50);
    $firstNameCol = new Amhsoft_Link_Control(_t('Full Name'), '?module=crm&page=contact-detail');
    $firstNameCol->DisplayValue = "name";
    $firstNameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $emailCol = new Amhsoft_Label_Control(_t('Email'));
    $emailCol->DataBinding = new Amhsoft_Data_Binding('email');
    $mobileCol = new Amhsoft_Label_Control(_t('Mobile'));
    $mobileCol->DataBinding = new Amhsoft_Data_Binding('mobile');
    $registerDate = new Amhsoft_Label_Control(_t('Register Date'));
    $registerDate->DataBinding = new Amhsoft_Data_Binding('create_date_time');
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=contact-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth(80);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=contact-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(80);
    $contactGroup = new Amhsoft_Label_Control(_t('Group'));
    $contactGroup->DataBinding = new Amhsoft_Data_Binding('contact_group', 'contact_group_id');
    $contactGroup->setWidth(80);
    $this->AddColumn($numberCol);
    $this->AddColumn($firstNameCol);
    $this->AddColumn($emailCol);
    $this->AddColumn($mobileCol);
    $this->AddColumn($registerDate);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol, 'del');
  }

  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('date');
  }

}

?>