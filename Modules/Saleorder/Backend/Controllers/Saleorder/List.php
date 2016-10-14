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

class Saleorder_Backend_Saleorder_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderDataGridView $saleOrderDataGridView */
    protected $saleOrderDataGridView;

    /** @var SaleOrderModelAdapter $saleOrderModelAdapter */
    protected $saleOrderModelAdapter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $this->saleOrderModelAdapter->orderBy('id DESC');
        $this->saleOrderDataGridView = new Saleorder_DataGridView();
        $this->saleOrderDataGridView->Sortable = true;
        $this->saleOrderDataGridView->Searchable = true;
        $this->saleOrderDataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
        $this->saleOrderDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
        $this->saleOrderDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Sales Orders'), View_Message_Type::INFO);
    }

    public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
        if ($colName == 'accountlink') {
            $email = $req->get('accountlink');
            $adapter->leftJoin('account', 'account_id', 'id');
            $adapter->where("account.name LIKE '%$email%'");
            return true;
        }
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'accountlink') {
            $adapter->leftJoin('account', 'account_id', 'id');
            $adapter->orderBy("account.name $sortOrder");
            return true;
        }

        if ($columName == 'user') {
            $adapter->leftJoin('user', 'user_id', 'id');
            $adapter->orderBy("user.username $sortOrder");
            return true;
        }
    }

    /**
     * Default event
     */
    public function __default() {
        $this->saleOrderDataGridView->performSort($this->getRequest(), $this->saleOrderModelAdapter);
        $this->saleOrderDataGridView->performSearch($this->getRequest(), $this->saleOrderModelAdapter);
    }

    /**
     * Today event
     */
    public function __today() {
        $this->saleOrderModelAdapter->where('(TO_DAYS(Now()) - TO_DAYS(insertat))=0');
    }

    /**
     * Accepted event
     */
    public function __accepted() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $this->saleOrderModelAdapter->where('sale_order_state_id = ?', Saleorder_State_Model::ACCEPTED);
    }

    /**
     * Open event
     */
    public function __open() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $this->saleOrderModelAdapter->where('sale_order_state_id = ? ', Saleorder_State_Model::SEND);
    }

    /**
     * Created event
     */
    public function __created() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $this->saleOrderModelAdapter->where('sale_order_state_id = ? ', Saleorder_State_Model::CREATED);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $salesOrders = $this->saleOrderModelAdapter->fetch();
        $this->saleOrderDataGridView->DataSource = new Amhsoft_Data_Set($salesOrders);
        $this->getView()->assign('grid', $this->saleOrderDataGridView);
        $this->show();
    }

}

?>