<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Home.php 302 2016-02-03 13:19:21Z imen.amhsoft $
 * $Rev: 302 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-03 14:19:21 +0100 (mer., 03 févr. 2016) $
 * $LastChangedDate: 2016-02-03 14:19:21 +0100 (mer., 03 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Crm_Frontend_Intern_Shop_Home_Controller extends Amhsoft_System_Web_Controller {

    public $user_id;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')));
        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $this->user_id = $auth->getObject()->id;
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getAllSalesOrdersCount();
        $this->getOpenSalesOrdersCount();
        $this->getPaidSalesOrdersCount();
        $this->getShippidSalesOrdersCount();
        $this->getAllSalesOrders();
    }

    /**
     * Gets Count of Open Salesorder.
     */
    public function getOpenSalesOrdersCount() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ?', $this->user_id);
        $saleOrderModelAdapter->where('sale_order_state_id IN (' . Saleorder_State_Model::CREATED . ',' . Saleorder_State_Model::SEND . ')');
        $this->getView()->assign('countOpenSaleOrder', $saleOrderModelAdapter->getCount());
    }

    /**
     * Gets Count of Paid Salesorder.
     */
    public function getPaidSalesOrdersCount() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ? ', $this->user_id);
        $saleOrderModelAdapter->where('sale_order_state_id = ?', Saleorder_State_Model::PAID);
        $this->getView()->assign('countPaidSaleOrder', $saleOrderModelAdapter->getCount());
    }

    /**
     * Gets Count of Pending Salesorder.
     */
    public function getShippidSalesOrdersCount() {
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ?', $this->user_id);
        $saleOrderModelAdapter->where('sale_order_state_id = ? ', Saleorder_State_Model::SHIPPED);
        $this->getView()->assign('countShippedSaleOrder', $saleOrderModelAdapter->getCount());
    }

    /**
     * Gets Count of All Salesorder.
     */
    public function getAllSalesOrdersCount() {
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ? ', $this->user_id);
        $this->getView()->assign('countAllSaleOrder', $saleOrderModelAdapter->getCount());
    }

    /**
     * Gets  All Salesorder.
     */
    public function getAllSalesOrders() {
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ? ', $this->user_id);
        $saleOrderModelAdapter->orderBy('id DESC');
        $saleOrderModelAdapter->limit(3);
        $saleorders = $saleOrderModelAdapter->fetch();
        $this->getView()->assign('salesOrders', $saleorders);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->show();
    }

}

?>
