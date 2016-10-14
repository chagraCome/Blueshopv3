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
class Workflow_Condition_DataGridView extends Amhsoft_Widget_DataGridView {

  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
  }

  public function initializeComponents() {


    $conditionLeft = new Amhsoft_Label_Control(_t('Condition left'), new Amhsoft_Data_Binding('condition_left'));

    $conditionRight = new Amhsoft_Label_Control(_t('Condition Right'), new Amhsoft_Data_Binding('condition_right'));

    $conditionOp = new Amhsoft_Label_Control(_t('Condition Operator'), new Amhsoft_Data_Binding('condition_op'));

    $stateLink = new Amhsoft_Link_OnOffline_Control(_t('State'), '?module=workflow&page=condition-online');
    $stateLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');

    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=workflow&page=condition-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';

    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=workflow&page=condition-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';

    $this->AddColumn($conditionLeft);
    $this->AddColumn($conditionRight);
    $this->AddColumn($conditionOp);
    $this->AddColumn($stateLink);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

}

?>
