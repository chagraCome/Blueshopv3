<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Rating_DataGridView extends Amhsoft_Widget_DataGridView {

  public $rate;
  public $name;
  public $rate_date_time;
  public $ip;
  public $deleteCol;

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->onRowDraw->registerEvent($this, 'rowDraw_CallBack');
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /*
   * Initialize Grid Components
   */

  public function initializeComponents() {
    $this->name = new Amhsoft_Link_Control(_t('Visitor Name'), '?module=rating&page=details');
    $this->name->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $this->name->DisplayValue = 'name';
    $this->AddColumn($this->name);
    $this->rate_date_time = new Amhsoft_Label_Control(_t('Rate Date Time'));
    $this->rate_date_time->DataBinding = new Amhsoft_Data_Binding('rate_date_time');
    $this->AddColumn($this->rate_date_time);
    $this->ip = new Amhsoft_Label_Control(_t('Ip Address'));
    $this->ip->DataBinding = new Amhsoft_Data_Binding('ip');
    $this->AddColumn($this->ip);
    $this->rate = new Amhsoft_Label_Control(_t('Rate'));
    $this->rate->DataBinding = new Amhsoft_Data_Binding('rate');
    $this->AddColumn($this->rate);
    $commentedCol = new Amhsoft_Label_Control(_t('Commented Product'));
    $commentedCol->DataBinding = new Amhsoft_Data_Binding('link');
    $commentedCol->setWidth(130);
    $this->AddColumn($commentedCol);
    $onOffLink = new Amhsoft_Link_OnOffline_Control(_t('Status'), 'admin.php?module=rating&page=online');
    $onOffLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $onOffLink->setWidth(60);
    $this->AddColumn($onOffLink);
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=rating&page=delete');
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
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('date');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField(null);
  }

  /**
   * Row Draw Callback
   * @param type $colIndex
   * @param Amhsoft_Abstract_Control $control
   * @param type $dataSource
   */
  public static function rowDraw_CallBack($colIndex, Amhsoft_Abstract_Control $control, $dataSource) {
    if ($control->DataBinding->Value == 'entity_id') {
      if ($dataSource->entity_class == 'Product_Product_Model') {
	$control->Href = 'admin.php?module=rating&page=list&event=gotoproduct';
	$control->Class = 'details';
      } else {
	$control->Label = '';
      }
    }
  }

}

?>