<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Saleorder_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

    protected $saleOrderModelAdapter;
    protected $saleOrderModel;
    protected $allSalesOrders;
    protected $account_id;
    protected $id;
    protected $saleOrderConfiguration;

    /**
     * Event Initialize.
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=list', 'label' => _t('Orders List')));

        $this->saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);

        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $this->account_id = $auth->getObject()->id;
        } else {
            Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=details&id=' . $this->id);
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }

        $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $this->saleOrderModelAdapter->where('account_id = ?', $this->account_id);
        $this->saleOrderModelAdapter->where('sale_order_state_id <> ' . Saleorder_State_Model::CREATED);
        $this->saleOrderModelAdapter->orderBy("id DESC");
    }

    public function __open() {
        $this->saleOrderModelAdapter->where('sale_order_state_id = ?', Saleorder_State_Model::SEND);
    }

    public function __shipped() {
        $this->saleOrderModelAdapter->where('sale_order_state_id = ?', Saleorder_State_Model::SHIPPED);
    }

    public function __paid() {
        $this->saleOrderModelAdapter->where('sale_order_state_id = ?', Saleorder_State_Model::PAID);
    }

    public function __default() {
        
    }

    public function __finalize() {
        $this->allSalesOrders = $this->saleOrderModelAdapter->fetch()->fetchAll();
        $this->getView()->assign('salesorders', $this->allSalesOrders);
        $this->show();
    }

}

?>