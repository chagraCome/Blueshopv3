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
class Newsletter_Emails_Groups_DataGridView extends Amhsoft_Widget_DataGridView {

  public $name;
  public $desc;
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
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $this->name = new Amhsoft_Label_Control(_t('Name'));
    $this->name->DataBinding = new Amhsoft_Data_Binding('name');
    $this->AddColumn($this->name);
    $this->desc = new Amhsoft_Label_Control(_t('Desciption'));
    $this->desc->DataBinding = new Amhsoft_Data_Binding('desc');
    $this->AddColumn($this->desc);
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=newsletter&amp;page=emails-groups-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->AddColumn($this->editCol);
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=newsletter&amp;page=emails-groups-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->AddColumn($this->deleteCol);
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
  }

}

?>