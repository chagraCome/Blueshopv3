<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_User_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var UserDataGridView $userDataGridView */
  protected $userDataGridView;

  /** @var User_User_Model_Adapter $userModelAdapter */
  protected $userModelAdapter;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userModelAdapter = new User_User_Model_Adapter();
    $this->userDataGridView = new User_User_DataGridView();
    $this->userDataGridView->Sortable = true;
    $this->userDataGridView->Searchable = true;
    $this->userDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Users'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userDataGridView->performSort($this->getRequest(), $this->userModelAdapter);
    $this->userDataGridView->performSearch($this->getRequest(), $this->userModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $projects = $this->userModelAdapter->fetch();
    $this->userDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->userDataGridView);
    $this->show();
  }

}

?>
