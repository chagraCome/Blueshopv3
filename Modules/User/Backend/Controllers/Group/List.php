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

class User_Backend_Group_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var UserGroupDataGridView $userGroupDataGridView */
    protected $User_Group_DataGridView;

    /** @var User_Group_Model_Adapter $userGroupModelAdapter */
    protected $userGroupModelAdapter;

    /**
     * Initialize controller
     */
    public function __initialize() {
        if ($this->getRequest()->get('ret') == true) {
            $this->getView()->setMessage(_t('Action successfuly executed'), View_Message_Type::SUCCESS);
        } else {
            $this->getView()->setMessage(_t('Cannot Execute Action'), View_Message_Type::ERROR);
        }
        $this->userGroupModelAdapter = new User_Group_Model_Adapter();
        $this->userGroupDataGridView = new User_Group_DataGridView();
        $this->userGroupDataGridView->Sortable = true;
        $this->userGroupDataGridView->Searchable = true;
        $this->userGroupDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Users Groups'), View_Message_Type::INFO);
    }
    /**
     * Default event
     */
    public function __default() {
        $this->userGroupDataGridView->performSort($this->getRequest(), $this->userGroupModelAdapter);
        $this->userGroupDataGridView->performSearch($this->getRequest(), $this->userGroupModelAdapter);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $projects = $this->userGroupModelAdapter->fetch();
        $this->userGroupDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->userGroupDataGridView);
        $this->show();
    }

}

?>
