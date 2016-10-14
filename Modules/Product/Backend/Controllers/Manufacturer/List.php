<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Product_Backend_Manufacturer_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Manufacturer_DataGridView $productManufacturerDataGridView */
    protected $productManufacturerDataGridView;

    /** @var Product_Manufacturer_Model_Adapter $productManufacturerModelAdapter */
    protected $productManufacturerModelAdapter;

    public function __initialize() {
        $this->productManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
        $this->productManufacturerDataGridView = new Product_Manufacturer_DataGridView();
        $this->productManufacturerDataGridView->Sortable = true;
        $this->productManufacturerDataGridView->Searchable = true;
        $this->productManufacturerDataGridView->setWithPagination(true);
        $this->productManufacturerModelAdapter->orderBy("id DESC");
        $this->getView()->setMessage(_t('List all manufacturers'), View_Message_Type::INFO);
    }

     public function __default() {
        $this->productManufacturerDataGridView->performSort($this->getRequest(), $this->productManufacturerModelAdapter);
        $this->productManufacturerDataGridView->performSearch($this->getRequest(), $this->productManufacturerModelAdapter);
    }

    public function __finalize() {
        $items = $this->productManufacturerModelAdapter->fetch();
        $this->productManufacturerDataGridView->DataSource = new Amhsoft_Data_Set($items);
        $this->getView()->assign('widget', $this->productManufacturerDataGridView);
        $this->show();
    }

}
?>

