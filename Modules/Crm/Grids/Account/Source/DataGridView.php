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
class Crm_Account_Source_DataGridView extends Amhsoft_Widget_DataGridView {

  public $name;
  public $editCol;
  public $deleteCol;

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  public function initializeComponents() {
    $this->name = new Amhsoft_Label_Control(_t('Name'));
    $this->name->DataBinding = new Amhsoft_Data_Binding('name');
    $this->AddColumn($this->name);
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=account-source-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth(80);
    $this->AddColumn($this->editCol);
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=account-source-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->setWidth(80);
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->AddColumn($this->deleteCol);
  }

  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField(null);
    $this->addSearcField(null);
  }

}

?>