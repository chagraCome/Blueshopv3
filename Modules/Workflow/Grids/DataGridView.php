<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_DataGridView extends Amhsoft_Widget_DataGridView {

  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
     $this->initializeSearch();
  }

  public function initializeComponents() {
    $nameCol = new Amhsoft_Link_Control(_t('Name'), '?module=workflow&page=workflow-details');
    $nameCol->DisplayValue = "name";
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
    $nameCol->Width = 500;
    $eventNameCol = new Amhsoft_Label_Control(_t('Event Name'), new Amhsoft_Data_Binding('eventname'));
    $eventNameCol->Width = 500;
    
    $modelNameCol = new Amhsoft_Label_Control(_t('Model Name'), new Amhsoft_Data_Binding('modelname'));
    $modelNameCol->Width = 500;
    
    $stateLink = new Amhsoft_Link_OnOffline_Control(_t('State'), '?module=workflow&page=workflow-online');
    $stateLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $stateLink->Width = '60';
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=workflow&page=workflow-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->Width = '60';

    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=workflow&page=workflow-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->Width = '60';
    
    $this->AddColumn($nameCol);
    $this->AddColumn($eventNameCol);
    $this->AddColumn($modelNameCol);
    $this->AddColumn($stateLink);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }
   public function initializeSearch() {
     $this->allowSearch();
    $this->addSearcField("text");
    $this->addSearcField("text");
    $this->addSearcField("text");
    
  }
  

}

?>
