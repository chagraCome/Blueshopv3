<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Setting_DataGridView extends Amhsoft_Widget_DataGridView {

  public $name;
  public $email;
  public $type;
  public $global;
  public $editCol;
  public $stateCol;
  public $deleteCol;

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $this->name = new Amhsoft_Label_Control(_t('Name'));
    $this->name->DataBinding = new Amhsoft_Data_Binding('name');
    $this->AddColumn($this->name);
    $this->email = new Amhsoft_Label_Control(_t('Email'));
    $this->email->DataBinding = new Amhsoft_Data_Binding('email');
    $this->AddColumn($this->email);
    $this->type = new Amhsoft_Label_Control(_t('Type'));
    $this->type->DataBinding = new Amhsoft_Data_Binding('type');
    $this->AddColumn($this->type);
    $this->global = new Amhsoft_YesNo_Image_Control(_t('Global'), new Amhsoft_Data_Binding('global'));
    $this->global->setWidth('60');
    $this->global->WithNullOption = true;
    $this->AddColumn($this->global);
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=webmail&amp;page=setting-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth('60');
    $this->AddColumn($this->editCol);
    $this->stateCol = new Amhsoft_Link_OnOffline_Control(_t('Online'), 'admin.php?module=webmail&amp;page=setting-online');
    $this->stateCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=webmail&amp;page=setting-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->deleteCol->setWidth('60');
    $this->AddColumn($this->deleteCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('text');
    $TypeListBox = new Amhsoft_ListBox_Control('type', _t('Type'));
    $TypeListBox->DataSource = new Amhsoft_Data_Set(array(_t('Incoming'), _t('Outgoing')));
    $TypeListBox->DataBinding = new Amhsoft_Data_Binding('type');
    $TypeListBox->WithNullOption = true;
    $this->addSearcField($TypeListBox);
    $yesNoListBox = new Amhsoft_YesNo_ListBox_Control('global', _t('Global'), 'global');
    $yesNoListBox->WithNullOption = true;
    $this->addSearcField($yesNoListBox);
  }

}

?>