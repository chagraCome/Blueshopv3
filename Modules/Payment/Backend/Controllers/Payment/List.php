<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Payment_Backend_Payment_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var PaymentDataGridView $paymentDataGridView */
    protected $paymentDataGridView;

    /** @var Payment_Payment_Model_Adapter $paymentModelAdapter */
    protected $paymentModelAdapter;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $this->paymentDataGridView = new Payment_Payment_DataGridView();
        $this->paymentDataGridView->Sortable = true;
        $this->paymentDataGridView->Searchable = true;
        $this->paymentDataGridView->setWithPagination(true);
        $this->paymentDataGridView->performSort($this->getRequest(), $this->paymentModelAdapter);
        $this->paymentDataGridView->performSearch($this->getRequest(), $this->paymentModelAdapter);
        $this->paymentDataGridView->Draggable = true;
        $this->paymentDataGridView->DragUrl = '?module=payment&page=payment-list&event=sort';

        $this->paymentModelAdapter->orderBy('sortid, id DESC');
        $this->getView()->setMessage(_t('List Payment Method'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        
    }

    /**
     * Sort Payment event
     */
    public function __sort() {
        $changes = false;
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE payment SET sortid = $sortid WHERE id = $itemid");
                $changes = true;
            }
        }

        exit;
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $projects = $this->paymentModelAdapter->fetch();
        $this->paymentDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->paymentDataGridView);
        $this->show();
    }

}

?>
