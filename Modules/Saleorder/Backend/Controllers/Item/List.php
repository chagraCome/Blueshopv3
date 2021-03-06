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

class Saleorder_Backend_Item_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderItemDataGridView $saleOrderItemDataGridView */
    protected $saleOrderItemDataGridView;

    /** @var SaleOrderItemModelAdapter $saleOrderItemModelAdapter */
    protected $saleOrderItemModelAdapter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
        $this->saleOrderItemDataGridView = new Saleorder_Item_DataGridView();
        $this->saleOrderItemDataGridView->Sortable = true;
        $this->saleOrderItemDataGridView->Searchable = true;
        $this->saleOrderItemDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Sales Orders Items'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->saleOrderItemDataGridView->performSort($this->getRequest(), $this->saleOrderItemModelAdapter);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $projects = $this->saleOrderItemModelAdapter->fetch();
        $this->saleOrderItemDataGridView->DataSource = new Amhsot_Data_Set($projects);
        $this->getView()->assign('grid', $this->saleOrderItemDataGridView);
        $this->show();
    }

}

?>
