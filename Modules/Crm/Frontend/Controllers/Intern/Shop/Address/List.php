<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Crm_Frontend_Intern_Shop_Address_List_Controller extends Amhsoft_System_Web_Controller {
    /** @var Crm_Address_DataGridView $crmAddressDataGridView */
    //protected $crmAddressDataGridView;

    /** @var Crm_Address_Model_Adapter $crmAddressModelAdapter */
    protected $crmAddressModelAdapter;
    protected $alladress;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-address-list', 'label' => _t('Manage Addresses')));
        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $this->crmAddressModelAdapter = new Crm_Address_Model_Adapter();
        $this->crmAddressModelAdapter->where('account_id = ?', $auth->getObject()->id);
        //$this->crmAddressDataGridView = new Crm_Address_DataGridView('index.php');
        //$this->crmAddressDataGridView->Sortable = FALSE;
        //$this->crmAddressDataGridView->Searchable = false;
        //$this->crmAddressDataGridView->setWithPagination(true);
        $this->crmAddressModelAdapter->orderBy("id DESC");
        //$this->getView()->setMessage(_t('Manage Addresses'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        // $this->crmAddressDataGridView->performSort($this->getRequest(), $this->crmAddressModelAdapter);
    }

    /**
     * Finalize event
     */
    /* public function __finalize() {
      $items = $this->crmAddressModelAdapter->fetch();
      $this->crmAddressDataGridView->DataSource = new Amhsoft_Data_Set($items);
      $this->getView()->assign('widget', $this->crmAddressDataGridView);
      $this->show();
      } */

    public function __finalize() {
        $this->alladress = $this->crmAddressModelAdapter->fetch()->fetchAll();
        $this->getView()->assign('adress', $this->alladress);
        $this->show();
    }

}

?>