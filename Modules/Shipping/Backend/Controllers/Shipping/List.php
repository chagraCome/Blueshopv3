<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Shipping_Backend_Shipping_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var ShippingDataGridView $shippingDataGridView */
    protected $shippingDataGridView;

    /** @var ShippingModelAdapter $shippingModelAdapter */
    protected $shippingModelAdapter;

    /**
     * Initialize  Controller
     * 
     */
    public function __initialize() {
        $this->shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
        $this->shippingDataGridView = new Shipping_Shipping_DataGridView();
        $this->shippingDataGridView->Sortable = true;
        $this->shippingDataGridView->Searchable = true;
        $this->shippingDataGridView->Draggable = true;
        $this->shippingDataGridView->DragUrl = '?module=shipping&page=shipping-list&event=sort';
        $this->shippingDataGridView->setWithPagination(true);

        $this->shippingModelAdapter->orderBy('sortid, id DESC');
        $this->getView()->setMessage(_t('List Shippings Methods'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->shippingDataGridView->performSort($this->getRequest(), $this->shippingModelAdapter);
        $this->shippingDataGridView->performSearch($this->getRequest(), $this->shippingModelAdapter);
    }

    /**
     * Sort Shipping event
     */
    public function __sort() {
        $changes = false;
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE shipping SET sortid = $sortid WHERE id = $itemid");
                $changes = true;
            }
        }

        exit;
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $shippingmethods = $this->shippingModelAdapter->fetch();
        $this->shippingDataGridView->DataSource = new Amhsoft_Data_Set($shippingmethods);
        $this->getView()->assign('grid', $this->shippingDataGridView);
        $this->show();
    }

}

?>
