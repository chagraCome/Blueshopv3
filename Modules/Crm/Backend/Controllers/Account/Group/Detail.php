<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Crm_Backend_Account_Group_Detail_Controller extends Amhsoft_System_Web_Controller {

  protected $accountGroupPanel;
  public $accountListBox;

  /** @var accountGroupModel $accountGroupModel */
  protected $accountGroupModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->accountGroupPanel = new Crm_Account_Group_Panel();
    $accountGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
    $this->accountGroupModel = $accountGroupModelAdapter->fetchById($id);
    if (!$this->accountGroupModel instanceof Crm_Account_Group_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->getView()->setMessage(_t('Group Details'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->handleSelectedAccount();
    $this->addAccountGrid();
  }

  public function handleSelectedAccount() {
    $account_id = Amhsoft_Registry::get('person');
    if ($account_id > 0) {
      $accountModelAdapter = new Crm_Account_Model_Adapter();
    }
  }

  public function addAccountGrid() {
    $panel = new Amhsoft_Widget_Panel(_t('Accounts'));
    $dataGridView = new Crm_Account_DataGridView();
    $adapter = new Crm_Account_Model_Adapter();
    $adapter->where('group_id = ?', $this->accountGroupModel->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter->fetch());
    $panel->addComponent($dataGridView);
    $addLink = new Amhsoft_Link_Control(_t('Add new Account'), 'admin.php?module=crm&page=account-quicklist');
    $addLink->DataBinding = new Amhsoft_Data_Binding('id', 'account_id');
    $addLink->onClickOpenInPopUp('640', '320');
    $addLink->Class = 'add';
    $panel->addComponent($addLink);
    $this->accountGroupPanel->addComponent($panel);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->accountGroupPanel->setDataSource(new Amhsoft_Data_Set($this->accountGroupModel));
    $this->accountGroupPanel->Bind();
    $this->getView()->assign('panel', $this->accountGroupPanel);
    $this->show();
  }

}

?>
