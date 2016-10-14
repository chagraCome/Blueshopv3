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
class User_Backend_Department_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Department_DataGridView $userDepartmentDataGridView */
  protected $userDepartmentDataGridView;

  /** @var User_Department_Model_Adapter $userDepartmentModelAdapter */
  protected $userDepartmentModelAdapter;

  /**
   * Initialize controller
   */
  public function __initialize() {
    if ($this->getRequest()->get('ret') == true) {
      $this->getView()->setMessage(_t('Action successfuly executed'), View_Message_Type::SUCCESS);
    } else {
      $this->getView()->setMessage(_t('Cannot execute Action'), View_Message_Type::ERROR);
    }
    $this->userDepartmentModelAdapter = new User_Department_Model_Adapter();
    $this->userDepartmentDataGridView = new User_Department_DataGridView();
    $this->userDepartmentDataGridView->Sortable = true;
    $this->userDepartmentDataGridView->Searchable = true;
    $this->userDepartmentDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Departments'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userDepartmentDataGridView->performSort($this->getRequest(), $this->userDepartmentModelAdapter);
    $this->userDepartmentDataGridView->performSearch($this->getRequest(), $this->userDepartmentModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $projects = $this->userDepartmentModelAdapter->fetch();
    $this->userDepartmentDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->userDepartmentDataGridView);
    $this->show();
  }

}

?>
