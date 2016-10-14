<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_DataGridView extends Amhsoft_Widget_DataGridView {

  public $subject;
  public $insertat;
  public $author_name;
  public $public_seen;
  public $public;
  public $user_seen;
  public $editCol;
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
   * Grid Initialize Components
   */
  public function initializeComponents() {
    $this->subject = new Amhsoft_Link_Control(_t('Subject'), '?module=comment&page=detail');
    $this->subject->DataBinding = new Amhsoft_Data_Binding('id', 'subject');
    $this->subject->DisplayValue = true;
    $this->AddColumn($this->subject);
    $this->insertat = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'));
    $this->insertat->DataBinding = new Amhsoft_Data_Binding('insertat');
    $this->AddColumn($this->insertat);
    $this->author_name = new Amhsoft_Label_Control(_t('Author Name'));
    $this->author_name->DataBinding = new Amhsoft_Data_Binding('author_name');
    $this->AddColumn($this->author_name);
    $this->public_seen = new Amhsoft_YesNo_Text_Control(_t('Public viewed'), new Amhsoft_Data_Binding('public_seen'));
    $this->AddColumn($this->public_seen);
    $this->user_seen = new Amhsoft_YesNo_Text_Control(_t('User viewed'), new Amhsoft_Data_Binding('user_seen'));
    $this->AddColumn($this->user_seen);
    $this->public = new Amhsoft_YesNo_Text_Control(_t('Public'), new Amhsoft_Data_Binding('public'));
    $this->AddColumn($this->public);
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=comment&amp;page=modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth(60);
    $this->AddColumn($this->editCol);
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=comment&amp;page=delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->deleteCol->setWidth(60);
    $this->AddColumn($this->deleteCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->addSearcField('text');
    $this->addSearcField('date');
    $this->addSearcField('text');
    
    $publicSeenList = new Amhsoft_YesNo_ListBox_Control('public_seen', _t('Public Viewed'), 'public_seen', 'no');
    $publicSeenList->WithNullOption = true;
    $this->addSearcField($publicSeenList);
    
    $userSeenList = new Amhsoft_YesNo_ListBox_Control('user_seen', _t('User viewed'), 'user_seen', 'no');
    $userSeenList->WithNullOption = true;
    $this->addSearcField($userSeenList);
    
    $publicList = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 'no');
    $publicList->WithNullOption = true;
    $this->addSearcField($publicList);
    
    $this->addSearcField(null);
    $this->addSearcField(null);
     $this->addSearcField(null);
  }

}

?>