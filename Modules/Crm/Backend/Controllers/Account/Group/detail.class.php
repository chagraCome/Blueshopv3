<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: detail.class.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */
Application::import('modules.users.panels.UserGroupPanel');
Application::import('modules.users.models.UserGroupModel');
Application::import('modules.users.grids.UserDataGridView');

/**
 * Description of detail
 *
 * @author cherif
 */
class detailController extends Amhsoft_Admin_Controller implements IController {

  /** @var UserGroupPanel $userGroupPanel */
  protected $userGroupPanel;
  public $userListBox;

  /** @var UserGroupModel $userGroupModel */
  protected $userGroupModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      die('Access denied');
    }
    $userGroupModelAdapter = new UserGroupModelAdapter();
    $this->userGroupModel = $userGroupModelAdapter->fetchById($id);

    if (!$this->userGroupModel instanceof UserGroupModel) {
      die('Requested User Group not found');
    }
    $this->template->setMessage(_t('user Group Details'), View_Message_Type::INFO);
  }

  protected function addUserGrid() {
    $panel = new Panel(_t('Users'));
    $userDataGridView = new UserDataGridView();
    $userDataGridView->DataSource = new DataSet($this->userGroupModel->getUsers());
    $panel->addComponent($userDataGridView);
    $this->adduserLink = new Link(_t('Add new User'), 'admin.php?module=users&page=user-quicklist');
    $this->adduserLink->DataBinding = new DataBinding('user', 'id', 'user_id');
    $this->adduserLink->onClickOpenInPopUp('450', '500');
    $this->userGroupPanel->addComponent($panel);
  }

  protected function handleSelectedUser() {
    //check if a user is selected!
    $selecteduser = Registry::get('user_quick_list_selected_id');
    if ($selecteduser) {
      $this->addUserToGroup($selecteduser);
    }
    //destroy session after adding user to group
    Registry::destroy('user_quick_list_selected_id');
  }

  public function addUserToGroup($selecteduser) {
    if (intval($selecteduser) <= 0) {
      return;
    }
    $userAdapter = new UserModelAdapter();
    $userModel = $userAdapter->fetchById($selecteduser);
    if (!$userModel instanceof UserModel) {
      return;
    }
    $userGroupModelAdapter = new UserGroupModelAdapter();
    $this->userGroupModel->addUser($userModel);
    $userGroupModelAdapter->save($this->userGroupModel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->handleSelectedUser();
    $this->addUserGrid();
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->userGroupPanel->setDataSource(new DataSet($this->userGroupModel));
    $this->userGroupPanel->Bind();
    $this->template->assign('panel', $this->userGroupPanel);
    $this->show();
  }

}

?>
