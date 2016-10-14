<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Category_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var ProductCategoryDataGridView $productCategoryDataGridView * */
    protected $producCategorytDataGridView;

    /** @var Product_Category_Model_Adapter $productCategoryModelAdapter * */
    protected $productCategoryModelAdapter;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->getView()->setMessage(_t('List categories'), View_Message_Type::INFO);
        $this->productCategoryDataGridView = new Product_Category_DataGridView();
        $this->productCategoryModelAdapter = new Product_Category_View_Model_Adapter();
        $this->productCategoryDataGridView->Sortable = true;
        $this->productCategoryDataGridView->Searchable = true;
        $this->productCategoryDataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
        $this->productCategoryDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
        $this->productCategoryDataGridView->setWithPagination(true);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->productCategoryDataGridView->performSort($this->getRequest(), $this->productCategoryModelAdapter);
        $this->productCategoryDataGridView->performSearch($this->getRequest(), $this->productCategoryModelAdapter);
    }

    public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
        if ($colName == 'name') {
            $name = $req->get('name');
            $adapter->where("name LIKE '%$name%' AND lang= '" . strtolower(Amhsoft_System::getCurrentLang()) . "'");
            return true;
        }
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'name') {
            $adapter->orderBy("name $sortOrder");
            return true;
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $productCategories = $this->productCategoryModelAdapter->fetchAllAsTree();
        $this->productCategoryDataGridView->DataSource = new Amhsoft_Data_Set($productCategories);
        $this->getView()->assign('grid', $this->productCategoryDataGridView);
        $this->show();
    }

}

?>
