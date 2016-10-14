<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_State_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderStateDataGridView $saleOrderStateDataGridView */
    protected $saleOrderStateDataGridView;

    /** @var SaleOrderStateModelAdapter $saleOrderStateModelAdapter */
    protected $saleOrderStateModelAdapter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderStateModelAdapter = new Saleorder_State_Model_Adapter();
        $this->saleOrderStateDataGridView = new Saleorder_State_DataGridView();
        $this->saleOrderStateDataGridView->Sortable = true;
        $this->saleOrderStateDataGridView->Searchable = true;
        $this->saleOrderStateDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Sales Orders States'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->saleOrderStateDataGridView->performSort($this->getRequest(), $this->saleOrderStateModelAdapter);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $projects = $this->saleOrderStateModelAdapter->fetch();
        $this->saleOrderStateDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->saleOrderStateDataGridView);
        $this->show();
    }

}

?>
