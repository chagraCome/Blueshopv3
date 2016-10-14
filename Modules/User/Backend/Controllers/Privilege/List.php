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
class User_Backend_Privilege_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Privilege_DataGridView $privilegeDataGridView */
  protected $privilegeDataGridView;

  /** @var User_Privilege_Model_Adapter $ */
  protected $privilegeModelAdapter;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->privilegeModelAdapter = new User_Privilege_Model_Adapter();
    $this->privilegeDataGridView = new User_Privilege_DataGridView();
    $this->privilegeDataGridView->Sortable = true;
    $this->privilegeDataGridView->Searchable = true;
    $this->privilegeDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List projects'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->privilegeDataGridView->performSort($this->getRequest(), $this->privilegeModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $projects = $this->privilegeModelAdapter->fetch();
    $this->privilegeDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->privilegeDataGridView);
    $this->show();
  }

}

?>
