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
class Crm_Backend_Group_Account_Controller extends Amhsoft_System_Web_Controller {

  protected $mainPanel;
  public $crmGroupModelAdapter;
  public $crmGroupDataGridView;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Manage Account Groups'), View_Message_Type::INFO);
    $this->crmGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
    $this->crmGroupDataGridView = new Crm_Account_Group_DataGridView();
    $this->crmGroupDataGridView->Sortable = true;
    $this->crmGroupDataGridView->Searchable = true;
    $this->crmGroupDataGridView->setWithPagination(true);
    $panel = new Amhsoft_Widget_Panel(_t('Account Groups'));
    $panel->addComponent($this->crmGroupDataGridView);
    $addNewGroupLink = new Amhsoft_Link_Control(_t('Add New Group'), 'admin.php?module=crm&page=account-group-add');
    $addNewGroupLink->setClass('add');
    $panel->addComponent($addNewGroupLink);
    $this->mainPanel->addComponent($panel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->crmGroupDataGridView->performSort($this->getRequest(), $this->crmGroupModelAdapter);
    $this->crmGroupDataGridView->performSearch($this->getRequest(), $this->crmGroupModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $groups = $this->crmGroupModelAdapter->fetch();
    $this->crmGroupDataGridView->DataSource = new Amhsoft_Data_Set($groups);
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show('');
  }

}

?>
