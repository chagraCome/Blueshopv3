<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Backend_Workflow_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Workflow_DataGridView $workFlowDataGridView */
    protected $workFlowDataGridView;

    /** @var Workflow_Model_Adapter $workFlowModelAdapter */
    protected $workFlowModelAdapter;

    public function __initialize() {
        if ($this->getRequest()->get('ret') == true) {
            $this->getView()->setMessage(_t('Action successfuly executed'), View_Message_Type::SUCCESS);
        } else {
            $this->getView()->setMessage(_t('Cannot Execute Action'), View_Message_Type::ERROR);
        }
        $this->workFlowModelAdapter = new Workflow_Model_Adapter();
        $this->workFlowDataGridView = new Workflow_DataGridView();
        $this->workFlowDataGridView->Sortable = true;
        $this->workFlowDataGridView->Searchable = true;
        $this->workFlowDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Workflows'), View_Message_Type::INFO);
    }

    public function __default() {
        $this->workFlowDataGridView->performSort($this->getRequest(), $this->workFlowModelAdapter);
        $this->workFlowDataGridView->performSearch($this->getRequest(), $this->workFlowModelAdapter);
    }

    public function __finalize() {
        $projects = $this->workFlowModelAdapter->fetch();
        $this->workFlowDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->workFlowDataGridView);
        $this->show();
    }

}

?>
