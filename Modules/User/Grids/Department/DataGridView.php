<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Department_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  /**
   * Construct
   * @param type $link
   */
  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $link;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $nameCol = new Amhsoft_Label_Control(_t('Name'));
    $nameCol->DataBinding = new Amhsoft_Data_Binding('name');
    $countryCol = new Amhsoft_Label_Control(_t('Country'), new Amhsoft_Data_Binding('country'));
    $telefonCol = new Amhsoft_Label_Control(_t('Telephone'), new Amhsoft_Data_Binding('telefon'));
    $adressCol = new Amhsoft_Label_Control(_t('Address'), new Amhsoft_Data_Binding('address'));
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=user&page=department-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth(60);
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=user&page=department-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $delCol->setWidth(60);
    $this->AddColumn($nameCol);
    $this->AddColumn($countryCol);
    $this->AddColumn($telefonCol);
    $this->AddColumn($adressCol);
    $this->AddColumn($editCol);
    $this->AddColumn($delCol);
  }

  /**
   * Initialize search fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
  }

}

?>
