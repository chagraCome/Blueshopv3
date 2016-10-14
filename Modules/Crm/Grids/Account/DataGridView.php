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
class Crm_Account_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  public function initializeComponents() {
    $nameCol = new Amhsoft_Link_Control(_t('Name'), '?module=crm&page=account-detail');
    $nameCol->DisplayValue = "name";
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $numberCol = new Amhsoft_Label_Control(_t('Number'));
    $numberCol->DataBinding = new Amhsoft_Data_Binding('number');
    $numberCol->setWidth(50);
    $mobileCol = new Amhsoft_Label_Control(_t('Mobile'));
    $mobileCol->DataBinding = new Amhsoft_Data_Binding('mobile');
    $sourceCol = new Amhsoft_Label_Control(_t('Source'));
    $sourceCol->DataBinding = new Amhsoft_Data_Binding('account_source');
    $emailCol = new Amhsoft_Label_Control(_t('Email'));
    $emailCol->DataBinding = new Amhsoft_Data_Binding('email1');
    $countryCol = new Amhsoft_Label_Control(_t('Country'));
    $countryCol->DataBinding = new Amhsoft_Data_Binding('country');
    $registrationCol = new Amhsoft_Date_Time_Label_Control(_t('Register Date'));
    $registrationCol->DataBinding = new Amhsoft_Data_Binding('register_date_time');
    $groupCol = new Amhsoft_Label_Control(_t('Group'));
    $groupCol->DataBinding = new Amhsoft_Data_Binding('group', 'group_id');
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=account-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=account-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $onOffLink = new Amhsoft_Link_OnOffline_Control(_t('Status'), 'admin.php?module=crm&page=account-online');
    $onOffLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $this->AddColumn($numberCol);
    $this->AddColumn($nameCol);
    $this->AddColumn($mobileCol);
    $this->AddColumn($emailCol);
    $this->AddColumn($groupCol);
    $this->AddColumn($sourceCol);
    $this->AddColumn($registrationCol);
    $this->AddColumn($onOffLink);
    $this->AddColumn($editCol, 'edit');
    $this->AddColumn($delCol, 'delete');
  }

  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $groupListBox = new Amhsoft_ListBox_Control('group_id', _t('Group'));
    $groupListBox->DataBinding = new Amhsoft_Data_Binding('group_id', 'id', 'name');
    $adapter = new Crm_Account_Group_Model_Adapter();
    $data = $adapter->fetch()->fetchAll();
    $groupListBox->DataSource = new Amhsoft_Data_Set($data);
    $groupListBox->WithNullOption = true;
    $this->addSearcField($groupListBox);
    $sourceListBox = new Amhsoft_ListBox_Control('account_source_id', _t('Source'));
    $sourceListBox->DataBinding = new Amhsoft_Data_Binding('account_source_id', 'id', 'name');
    $sourceAdapter = new Crm_Account_Source_Model_Adapter();
    $data2 = $sourceAdapter->fetch()->fetchAll();
    $sourceListBox->DataSource = new Amhsoft_Data_Set($data2);
    $sourceListBox->WithNullOption = true;
    $this->addSearcField($sourceListBox);
    $this->addSearcField('date');
  }

}

?>
