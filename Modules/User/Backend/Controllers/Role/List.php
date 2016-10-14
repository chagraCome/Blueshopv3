<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_Role_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Role_DataGridView $roleDataGridView */
  protected $roleDataGridView;

  /** @var User_Privilege_Model_Adapter $ */
  protected $roleModelAdapter;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->roleModelAdapter = new User_Role_Model_Adapter();
    $this->roleDataGridView = new User_Role_DataGridView();
    $this->roleDataGridView->Sortable = true;
    $this->roleDataGridView->Searchable = true;
    $this->roleDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Role'), View_Message_Type::INFO);
  }

  /**
   * Default controller
   */
  public function __default() {
    $this->roleDataGridView->performSort($this->getRequest(), $this->roleModelAdapter);
    $this->roleDataGridView->performSearch($this->getRequest(), $this->roleModelAdapter);
  }

  /**
   * Finalize controller
   */
  public function __finalize() {
    $roles = $this->roleModelAdapter->fetch();
    $this->roleDataGridView->DataSource = new Amhsoft_Data_Set($roles);
    $this->getView()->assign('grid', $this->roleDataGridView);
    $this->show();
  }

}

?>
