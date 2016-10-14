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
class User_User_DataGridView extends Amhsoft_Widget_DataGridView {

  protected $adapter;

  /**
   * Construct
   * @param type $link
   */
  public function __construct($link = 'admin.php') {
    parent::__construct();
    $this->adapter = $link;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $numberCol = new Amhsoft_Label_Control(_t('Number'));
    $numberCol->DataBinding = new Amhsoft_Data_Binding('number');
    $firstnameCol = new Amhsoft_Link_Control(_t('First Name'), '?module=user&page=user-details');
    $firstnameCol->DisplayValue = "firstname";
    $firstnameCol->DataBinding = new Amhsoft_Data_Binding('id', 'firstname');
    $lastnameCol = new Amhsoft_Label_Control(_t('Last Name'));
    $lastnameCol->DataBinding = new Amhsoft_Data_Binding('lastname');
    $phoneCol = new Amhsoft_Label_Control(_t('Mobile'));
    $phoneCol->DataBinding = new Amhsoft_Data_Binding('mobile');
    $emailCol = new Amhsoft_Label_Control(_t('Email'));
    $emailCol->DataBinding = new Amhsoft_Data_Binding('email');
    $faxCol = new Amhsoft_Label_Control(_t('Fax'));
    $faxCol->DataBinding = new Amhsoft_Data_Binding('fax');
    $countryCol = new Amhsoft_Label_Control(_t('Country'));
    $countryCol->DataBinding = new Amhsoft_Data_Binding('country');
    $editLink = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=user&page=user-modify');
    $editLink->DataBinding = new Amhsoft_Data_Binding('id');
    $editLink->Class = 'edit';
    $editLink->setWidth("60");
    $deleteLink = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=user&page=user-delete');
    $deleteLink->DataBinding = new Amhsoft_Data_Binding('id');
    $deleteLink->JavaScript = 'onClick="return confirmDelete();"';
    $deleteLink->Class = 'delete';
    $deleteLink->setWidth("60");
    $onOffLink = new Amhsoft_Link_OnOffline_Control(_t('Online'), 'admin.php?module=user&page=user-online');
    $onOffLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
    $this->AddColumn($numberCol);
    $this->AddColumn($firstnameCol);
    $this->AddColumn($lastnameCol);
    $this->AddColumn($phoneCol);
    $this->AddColumn($emailCol);
    $this->AddColumn($faxCol, 'faxname');
    $this->AddColumn($countryCol);
    $this->AddColumn($onOffLink, 'offline');
    $this->AddColumn($editLink, 'edit');
    $this->AddColumn($deleteLink, 'delete');
  }

  /**
   * Initialize Search Fields
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
    $this->addSearcField('text');
  }

}

?>
