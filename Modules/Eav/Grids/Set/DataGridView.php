<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */

/**
 * Description of Product_Set_DataGridView
 *
 * @author Montasser
 */
class Eav_Set_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

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
    $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=eav&page=attributeset-modify&entity=' . $_GET['entity']);
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth(60);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=eav&page=attributeset-delete&entity=' . $_GET['entity']);
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(60);
    $manageCol = new Amhsoft_Link_Control(_t('Manage Attributes'), '?module=eav&page=attributeset-detail&entity=' . $_GET['entity']);
    $manageCol->DataBinding = new Amhsoft_Data_Binding('id');
    $manageCol->Class = 'edit';
    $manageCol->setWidth(150);
    $this->AddColumn($nameCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
    $this->AddColumn($manageCol);
    
  }

  /**
   * Initialize Search Grid
   */
  public function initializeSearch() {
    $this->addSearcField('text');
  }

}

?>
