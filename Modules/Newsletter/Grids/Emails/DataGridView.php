<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Newsletter_Emails_DataGridView extends Amhsoft_Widget_DataGridView {

  public $email;
  public $group;
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
    $this->email = new Amhsoft_Label_Control(_t('E-Mail address'));
    $this->email->DataBinding = new Amhsoft_Data_Binding('email');
    $this->AddColumn($this->email);
    
    $this->group = new Amhsoft_Label_Control(_t('Group'));
    $this->group->DataBinding = new Amhsoft_Data_Binding('group', 'newsletter_email_groups_id', 'name');
    $this->AddColumn($this->group);
    
    $this->stateCol = new Amhsoft_Link_OnOffline_Control(_t('Online'), 'admin.php?module=newsletter&page=emails-online');
    $this->stateCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $this->stateCol->setWidth(80);
    $this->AddColumn($this->stateCol, 'state');
    
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=newsletter&amp;page=emails-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth(80);
    $this->AddColumn($this->editCol, 'edit');
    
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=newsletter&amp;page=emails-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->deleteCol->setWidth(80);
    $this->AddColumn($this->deleteCol, 'delete');
    
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $group = new Amhsoft_ListBox_Control('newsletter_email_groups_id', _t('Group'));
    $group->DataBinding = new Amhsoft_Data_Binding('newsletter_email_groups_id', 'id', 'name');
    $groupAda = new Newsletter_Email_Group_Model_Adapter();
    $group->DataSource = new Amhsoft_Data_Set($groupAda->fetch()->fetchAll());
    $group->WithNullOption = true;
    $this->addSearcField($group);
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
  }

}

?>