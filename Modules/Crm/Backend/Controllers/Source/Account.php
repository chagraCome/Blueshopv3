<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Account.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

/**
 * Description of setting
 *
 * @author Montasser
 */
class Crm_Backend_Source_Account_Controller extends Amhsoft_System_Web_Controller {

  protected $mainPanel;
  protected $crmSourceModelAdapter;
  protected $crmSourceDataGridView;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Manage Account Sources'), View_Message_Type::INFO);
    $this->crmSourceModelAdapter = new Crm_Account_Source_Model_Adapter();
    $this->crmSourceDataGridView = new Crm_Account_Source_DataGridView();
    $this->crmSourceDataGridView->Sortable = true;
    $this->crmSourceDataGridView->setWithPagination(true);
    $panel = new Amhsoft_Widget_Panel(_t('Account Sources'));
    $panel->addComponent($this->crmSourceDataGridView);
    $addNewSourceLink = new Amhsoft_Link_Control(_t('Add New Source'), 'admin.php?module=crm&page=account-source-add');
    $addNewSourceLink->setClass('add');
    $panel->addComponent($addNewSourceLink);
    $this->mainPanel->addComponent($panel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->crmSourceDataGridView->performSort($this->getRequest(), $this->crmSourceModelAdapter);
    $this->crmSourceDataGridView->performSearch($this->getRequest(), $this->crmSourceModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $groups = $this->crmSourceModelAdapter->fetch();
    $this->crmSourceDataGridView->DataSource = new Amhsoft_Data_Set($groups);
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show('');
  }

}

?>
