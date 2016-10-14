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

/**
 * Description of delete
 *
 * @author cherif
 */
class Saleorder_Backend_Comment_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Comment_DataGridView $commentDataGridView */
    protected $commentDataGridView;

    /** @var Comment_Model_Adapter $commentModelAdapter */
    protected $commentModelAdapter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->commentModelAdapter = new Comment_Model_Adapter();
        $this->commentModelAdapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
        $this->commentDataGridView = new Comment_DataGridView();
        $this->commentDataGridView->Sortable = true;
        $this->commentDataGridView->Searchable = true;
        $relatedToCol = new Amhsoft_Link_Control(_t('Go To Sales Order'), 'admin.php?module=saleorder&page=saleorder-details');
        $relatedToCol->DataBinding = new Amhsoft_Data_Binding('entity_id', 'id');
        $relatedToCol->Alias = 'id';
        $this->commentDataGridView->AddColumn($relatedToCol);




        $this->commentDataGridView->setWithPagination(true);
        $this->commentModelAdapter->orderBy("id DESC");
        $this->getView()->setMessage(_t('List all comments'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->commentDataGridView->performSort($this->getRequest(), $this->commentModelAdapter);
        $this->commentDataGridView->performSearch($this->getRequest(), $this->commentModelAdapter);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $items = $this->commentModelAdapter->fetch();
        $this->commentDataGridView->DataSource = new Amhsoft_Data_Set($items);
        $this->getView()->assign('widget', $this->commentDataGridView);
        $this->show();
    }

}
?>

