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
class Workflow_Action_DataGridView extends Amhsoft_Widget_DataGridView {

  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
  }

  public function initializeComponents() {
    
    $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $typeCol = new Amhsoft_Label_Control(_t('Type'), new Amhsoft_Data_Binding('type'));
    
    $stateLink = new Amhsoft_Link_OnOffline_Control(_t('State'), '?module=workflow&page=action-mail-online');
    $stateLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $stateLink->Width = '60';

    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=workflow&page=action-mail-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->Width = 60;

    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=workflow&page=action-mail-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->Width = 60;
    $delCol->JavaScript = 'onClick="return confirmDelete();"';

    $this->AddColumn($nameCol);
    $this->AddColumn($typeCol);
    $this->AddColumn($editCol);
    $this->AddColumn($stateLink);
    $this->AddColumn($delCol);
  }

}

?>
