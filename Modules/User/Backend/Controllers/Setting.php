<?php

/**
 * NOTICE OF LICENSE
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

  protected $mainPanel;

  /**
   * Initialize controller.
   */
  public function __initialize() {
    $this->mainPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Users Settings'), View_Message_Type::INFO);
  }

  /**
   * Load User groups
   */
  public function loadUserGroupGrid() {
    $panel = new Amhsoft_Widget_Panel();
    $userGroupDataGridView = new User_Group_DataGridView();
    $userGroupDataGridView->Draggable = true;
    $userGroupDataGridView->DataSource = Amhsoft_Data_Source::Table('user_group');
    $addLink = new Amhsoft_Link_Control(_t('Add new user group'), '?module=user&page=group-add');
    $addLink->DataBinding = new Amhsoft_Data_Binding('id', 'id', 'name');
    $addLink->setClass('add');
    $panel->addComponent($userGroupDataGridView);
    $panel->addComponent($addLink);
    $this->mainPanel->addComponent($panel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->loadUserGroupGrid();
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->mainPanel);
    $this->show();
  }

}

?>
