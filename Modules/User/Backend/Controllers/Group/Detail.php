<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_Group_Detail_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Group_Panel $userGroupPanel */
  protected $userGroupPanel;
  public $userListBox;

  /** @var UserGroupModel $userGroupModel */
  protected $userGroupModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->userGroupPanel = new Amhsoft_Widget_Panel();
    $userGroupModelAdapter = new User_Group_Model_Adapter();
    $this->userGroupModel = $userGroupModelAdapter->fetchById($id);
    if (!$this->userGroupModel instanceof User_Group_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->getView()->setMessage(_t('User Group Details'), View_Message_Type::INFO);
  }

  /**
   * Unassign: unassign user from group
   */
  public function __unassign() {
    $userid = $this->getRequest()->getInt('user_id');
    $db = Amhsoft_Database::getInstance();
    $db->exec('DELETE FROM user_group_has_user WHERE user_id = ' . $userid . ' AND user_group_id = ' . $this->userGroupModel->getId());
    $this->getRedirector()->go('?module=user&page=group-detail&id=' . $this->userGroupModel->getId() . '&ret=true');
  }

  /**
   * addUserGrid: add the user grid to the panel
   */
  protected function addUserGrid() {
    $panel = new Amhsoft_Widget_Panel(_t('Users'));
    $userDataGridView = new User_User_DataGridView();
    $userDataGridView->DataSource = new Amhsoft_Data_Set($this->userGroupModel->getUsers());
    $userDataGridView->removeByIdentName('delete');
    $unassignLink = new Amhsoft_Link_Control(_t('Unassing'), '?module=user&page=group-detail&id=' . $this->userGroupModel->getId() . '&event=unassign');
    $unassignLink->DataBinding = new Amhsoft_Data_Binding('id');
    $unassignLink->Alias = "user_id";
    $unassignLink->Class = 'delete';
    $unassignLink->setWidth(60);
    $userDataGridView->AddColumn($unassignLink);
    $panel->addComponent($userDataGridView);
    $this->userListBox = new Amhsoft_Link_Control(_t('Add new User'), 'admin.php?module=user&page=user-quicklist');
    $this->userListBox->DataBinding = new Amhsoft_Data_Binding('user', 'id', 'user_id');
    $this->userListBox->onClickOpenInPopUp('640', '320');
    $this->userListBox->Class = 'add';
    $panel->addComponent($this->userListBox);
    $this->userGroupPanel->addComponent($panel);
  }

  /**
   * handleSelectedUser: get the selected user id
   */
  protected function handleSelectedUser() {
    //check if a user is selected!
    $selecteduser = Amhsoft_Registry::get('user_quick_list_selected_id');
    if ($selecteduser) {
      $this->addUserToGroup($selecteduser);
    }
    //destroy session after adding user to group
    Amhsoft_Registry::destroy('user_quick_list_selected_id');
  }

  /**
   * addUserToGroup
   * @param type $selecteduser
   * add selected user to group
   */
  public function addUserToGroup($selecteduser) {
    if (intval($selecteduser) <= 0) {
      return;
    }
    $userAdapter = new User_User_Model_Adapter();
    $userModel = $userAdapter->fetchById($selecteduser);
    if (!$userModel instanceof User_User_Model) {
      return;
    }
    $userGroupModelAdapter = new User_Group_Model_Adapter();
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
    $this->userGroupPanel->setDataSource(new Amhsoft_Data_Set($this->userGroupModel));
    $this->userGroupPanel->Bind();
    $this->getView()->assign('panel', $this->userGroupPanel);
    $this->show();
  }

}

?>
