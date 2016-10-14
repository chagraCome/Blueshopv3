<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of list
 *
 * @author cherif
 */
class Saleorder_Backend_Saleorder_Quicklist_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_DataGridView $dataGridView */
    protected $dataGridView;
    protected $saleorderModelAdapter;
    protected $related;
    protected $related2;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->dataGridView = new Amhsoft_Widget_DataGridView();
        $this->dataGridView->Searchable = true;
        $this->dataGridView->Sortable = true;
        $this->dataGridView->setWithPagination(TRUE);
        $this->saleorderModelAdapter = new Saleorder_Model_Adapter();
        $this->setUpSaleorderDataGridView();
        $this->getView()->setMessage(_t('List saleorder'), View_Message_Type::INFO);
        if ($this->getRequest()->getInt('related') > 0) {
            Amhsoft_Registry::register('related_id', $this->getRequest()->getInt('related'));
        }
    }

    /**
     * Default event
     */
    public function __default() {
        $this->dataGridView->performSearch($this->getRequest(), $this->saleorderModelAdapter);
        $this->dataGridView->performSort($this->getRequest(), $this->saleorderModelAdapter);
    }

    protected function setUpSaleorderDataGridView() {
        $nameCol = new Amhsoft_Link_Control(_t('Name'), 'admin.php?module=saleorder&page=saleorder-quicklist&event=select');
        $nameCol->DisplayValue = "name";
        $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
        $numberCol = new Amhsoft_Label_Control(_t('Number'), new Amhsoft_Data_Binding('number'));
        $priceCol = new Amhsoft_Currency_Label_Control(_t('Total Price'), new Amhsoft_Data_Binding('total_price'));

        $saleOrderState = new Amhsoft_Label_Control(_t('State'));
        $saleOrderState->DataBinding = new Amhsoft_Data_Binding('saleOrderState', 'sale_order_state_id');

        $insertAtCol = new Amhsoft_Date_Time_Label_Control(_t('Created Time'), new Amhsoft_Data_Binding('insertat'));

        $this->dataGridView->AddColumn($numberCol);
        $this->dataGridView->AddColumn($nameCol);
        $this->dataGridView->AddColumn($priceCol);
        $this->dataGridView->AddColumn($saleOrderState);

        $this->dataGridView->AddColumn($insertAtCol);

        $this->dataGridView->addSearcField('text');
        $this->dataGridView->addSearcField('text');
        $this->dataGridView->addSearcField('text');


        $saleOrderStateModelAdapter = new Saleorder_State_Model_Adapter();

        $saleOrderStates = $saleOrderStateModelAdapter->fetch()->fetchAll();

        $saleCol = new Amhsoft_ListBox_Control('sale_order_state_id', _t('State'));
        $saleCol->DataSource = new Amhsoft_Data_Set($saleOrderStates);
        $saleCol->DataBinding = new Amhsoft_Data_Binding('sale_order_state_id', 'id', 'name');
        $saleCol->WithNullOption = true;
        $this->dataGridView->addSearcField($saleCol);
        $this->dataGridView->addSearcField('date');
    }

    /**
     * Select event
     */
    public function __select() {
        $id = $this->getRequest()->getId();

        if ($id > 0) {
            $saleorderAdapter = new Saleorder_Model_Adapter();
            $saleorder = $saleorderAdapter->fetchById($id);
            if ($saleorder instanceof Saleorder_Model) {
                Amhsoft_Registry::register('selected_quicklist_saleorder_id', $id);
                $this->close();
                Amhsoft_Registery::delete('related_id');
            }
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $relatedId = Amhsoft_Registry::get('related_id', 0);
        if ($relatedId > 0) {
            $saleorders = $this->saleorderModelAdapter->where('account_id=' . $relatedId);
            $this->dataGridView->DataSource = new Amhsoft_Data_Set($saleorders->fetch());
            $this->getView()->assign('grid', $this->dataGridView);
            $this->popup();
        }
    }

}

?>