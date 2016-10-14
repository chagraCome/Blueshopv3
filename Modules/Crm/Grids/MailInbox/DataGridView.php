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
class Crm_MailInbox_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  public function __construct($linkUrl = 'admin.php') {
    $this->LinkUrl = $linkUrl;
    parent::__construct();
    $this->initializeComponents();
    $this->initializeSearch();
  }

  public function initializeComponents() {
    $subjectCol = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('subject'));
    $sendAtCol = new Amhsoft_Label_Control(_t('Send Date'), new Amhsoft_Data_Binding('sendat'));
    $ceateAtCol = new Amhsoft_Label_Control(_t('Create Date'), new Amhsoft_Data_Binding('createat'));
    $userCol = new Amhsoft_Label_Control(_t('User'), new Amhsoft_Data_Binding('user'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=inbox-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth(60);
    $editCol->onClickOpenInPopUp(800, 650);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=inbox-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(60);
    $this->AddColumn($subjectCol);
    $this->AddColumn($ceateAtCol);
    $this->AddColumn($sendAtCol);
    $this->AddColumn($userCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  public function initializeSearch() {
    $this->addSearcField('text');
    $this->addSearcField('text');
    $personCol = new Amhsoft_ListBox_Control('person_id', _t('Lead'));
    $personCol->DataSource = Amhsoft_Data_Source::Table('lead');
    $personCol->DataBinding = new Amhsoft_Data_Binding('person_id', 'id', 'firstname');
    $personCol->WithNullOption = true;
    $this->addSearcField($personCol);
    $userCol = new Amhsoft_ListBox_Control('user_id', _t('User'));
    $userCol->DataSource = Amhsoft_Data_Source::Table('user');
    $userCol->DataBinding = new Amhsoft_Data_Binding('user_id', 'id', 'username');
    $userCol->WithNullOption = false;
    $this->addSearcField($userCol);
  }

}

?>
