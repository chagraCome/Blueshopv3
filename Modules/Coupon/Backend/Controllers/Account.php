<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Account.php 363 2016-02-09 14:56:46Z imen.amhsoft $
 * $Rev: 363 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:56:46 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:56:46 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Coupon_Backend_Account_Controller extends Amhsoft_System_Web_Controller {

  public $Model;
  public $mainpanel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainpanel = new Amhsoft_Widget_Panel();
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $ModelAdapter = new Coupon_Model_Adapter();
      $this->Model = $ModelAdapter->fetchById($id);
      if (!$this->Model instanceof Coupon_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->getView()->setMessage(_t('Coupon Accounts'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    if (Amhsoft_Registry::get('selected_account_id')) {
      $this->addAccountById(Amhsoft_Registry::get('selected_account_id'));
    }
    if ($this->getRequest()->isPost('account_submit')) {
      $selectedGroupId = $this->getRequest()->postInt('account_group_id');
      $this->addAccountsByGroup($selectedGroupId);
    }
    $this->loadAccounts();
  }

  /**
   * Delete event
   */
  public function __delete() {
    Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_account WHERE account_id = " . $this->getRequest()->getInt('acc_id'));
    $this->getRedirector()->go('?module=coupon&page=account&id=' . $this->Model->getId() . '&ret=true');
  }

  /**
   * Delete All event
   */
  public function __deleteall() {
    Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_account WHERE coupon_id = " . $this->getRequest()->getInt('id'));
    $this->getRedirector()->go('?module=coupon&page=account&id=' . $this->Model->getId() . '&ret=true');
  }

  protected function loadAccounts() {
    $panel = new Amhsoft_Widget_Panel(_t('Accounts'));
    $dataGridView = new Crm_Account_DataGridView('admin.php&id=' . $this->Model->getId());
    $dataGridView->Searchable = true;
    $dataGridView->Sortable = true;
    $adapter = new Crm_Account_Model_Adapter();
    $dataGridView->setWithPagination(true);
    $dataGridView->performSearch($this->getRequest(), $adapter);
    $dataGridView->performSort($this->getRequest(), $adapter);
    $delCol = new Amhsoft_Link_Control(_t('Unassign'), '?module=coupon&page=account&event=delete&id=' . $this->Model->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'acc_id';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $dataGridView->removeByIdentName('delete');
    $dataGridView->AddColumn($delCol);
    $adapter->leftJoinWithoutCardinality('coupon_account', 'id', 'coupon_account.account_id');
    $adapter->where('coupon_account.coupon_id = ?', $this->Model->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter->fetch());
    $selectLink = new Amhsoft_Link_Control(_t('Select Account'), 'admin.php?module=crm&page=account-quicklist&refresh=true');
    $selectLink->onClickOpenInPopUp(640, 480);
    $selectLink->setClass('add');
    $form = new Amhsoft_Widget_Form('account_by_group', 'POST');
    $accountGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
    $accountGroups = $accountGroupModelAdapter->fetch()->fetchAll();
    $accountGroupList = new Amhsoft_ListBox_Control('account_group_id', _t('Select Accounts By Group'));
    $accountGroupList->WithNullOption = TRUE;
    $accountGroupList->NullOptionLabel = _t('All Groups');
    $accountGroupList->DataBinding = new Amhsoft_Data_Binding('account_group_id', 'id', 'name');
    $accountGroupList->DataSource = new Amhsoft_Data_Set($accountGroups);
    $submitButton = new Amhsoft_Button_Submit_Control('account_submit', _t('Select Account'));
    $submitButton->setClass('ButtonAdd');
    $panelSelect = new Amhsoft_Widget_Panel();
    $panelSelect->addComponent($accountGroupList);
    $panelSelect->addComponent($submitButton);
    $panelSelect->setLayout(new Amhsoft_Grid_Layout(2));
    $form->addComponent($panelSelect);
    $panelLinks = new Amhsoft_Widget_Panel();
    $panelLinks->addComponent($selectLink);
    $panelLinks->addComponent($form);
    $panel->addComponent($panelLinks);
    $panel->addComponent(new Amhsoft_Html_Control('<div class="clear:both">&nbsp;</div><br />'));
    $panel->addComponent($dataGridView);
    $deletetLink = new Amhsoft_Link_Control(_t('Delete All'), '?module=coupon&page=account&event=deleteall&id=' . $this->Model->getId());
    $deletetLink->setClass('delete');
    $panel->addComponent($deletetLink);
    $dataGridView->Searchable = true;
    $dataGridView->Sortable = true;
    $dataGridView->performSearch($this->getRequest(), $adapter);
    $dataGridView->performSort($this->getRequest(), $adapter);
    $this->mainpanel->addComponent($panel);
  }

  protected function addAccountsByGroup($groupId) {
    $compainid = $this->Model->getId();
    if (intval($groupId) > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_account WHERE coupon_id = " . $this->Model->getId());
    }
    if (intval($groupId) > 0) {
      $sql = "INSERT INTO coupon_account SELECT $compainid as cid, id, 'prepared'  FROM account WHERE group_id = $groupId";
    } else {
      $sql = "INSERT INTO coupon_account SELECT $compainid as cid, id , 'prepared' FROM account";
    }
    Amhsoft_Database::getInstance()->exec($sql);
  }

  protected function addAccountById($id) {
    $sql = '';

    if (intval($id) > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_account WHERE account_id = " . $id);
    }

    if (intval($id) > 0) {
      $sql = "INSERT INTO coupon_account VALUES(" . $this->Model->getId() . "," . $id . " , 0)";
      Amhsoft_Database::getInstance()->exec($sql);
    }
    Amhsoft_Registry::destroy('selected_account_id');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
      $this->getView()->assign('coupon', TRUE);
    }

    $this->getView()->assign('widget', $this->mainpanel);
    $this->show();
  }

}

?>
