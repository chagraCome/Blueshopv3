<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Default_Portlet_DataGridView extends Amhsoft_Widget_DataGridView {

  public $module;
  public $name;
  public $stateCol;

  /**
   * construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Components
   */
  public function initializeComponents() {
    $this->name = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name_t'));
    $this->addColumn($this->name);
    $this->stateCol = new Amhsoft_Link_OnOffline_Control(_t('Online'), 'admin.php?module=default&amp;page=portlet-online');
    $this->stateCol->DataBinding = new Amhsoft_Data_Binding('id', 'status');
    $this->AddColumn($this->stateCol);
  }

  /**
   * InitialiZe Search
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
    $this->addSearcField(null);
  }

}

?>