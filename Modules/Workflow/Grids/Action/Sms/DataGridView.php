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
class Workflow_Action_Sms_DataGridView extends Amhsoft_Widget_DataGridView {

  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $fromCol = new Amhsoft_Label_Control(_t('From'), new Amhsoft_Data_Binding('from'));

    $phoneCol = new Amhsoft_Label_Control(_t("Phone"), new Amhsoft_Data_Binding('phone'));
    
    $stateLink = new Amhsoft_Link_OnOffline_Control(_t('State'), '?module=workflow&page=action-sms-online');
    $stateLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $stateLink->Width = '60';

    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=workflow&page=action-sms-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->onClickOpenInPopUp(860, 700);
    $editCol->Class = 'edit';
    $editCol->Width = 60;

    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=workflow&page=action-sms-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->Width = 60;
    $delCol->JavaScript = 'onClick="return confirmDelete();"';

    $this->AddColumn($fromCol);
    $this->AddColumn($phoneCol);
    $this->AddColumn($editCol);
    $this->AddColumn($stateLink);
    $this->AddColumn($delCol);
  }

}

?>
