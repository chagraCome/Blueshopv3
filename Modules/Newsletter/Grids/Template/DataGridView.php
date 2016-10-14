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
class Newsletter_Template_DataGridView extends Amhsoft_Widget_DataGridView {

  public $title;
  public $editCol;
  public $stateCol;
  public $deleteCol;

  /*
   * Grid Construct
   */

  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Iµnitialize Grid Components
   */
  public function initializeComponents() {
    $this->title = new Amhsoft_Label_Control(_t('Title'));
    $this->title->DataBinding = new Amhsoft_Data_Binding('title');
    $this->AddColumn($this->title);
    
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=newsletter&page=template-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth(80);
    $this->AddColumn($this->editCol);
    
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=newsletter&page=template-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->deleteCol->setWidth(80);
    $this->AddColumn($this->deleteCol);
  }

  /**
   * initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
  }

}

?>