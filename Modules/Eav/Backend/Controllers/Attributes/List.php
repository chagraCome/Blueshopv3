<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributes_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Attribute_DataGridView $productAttributeDataGridView */
    protected $productAttributeDataGridView;

    /** @var Product_Attribute_Model_Adapter $productAttributeModelAdapter */
    protected $productAttributeModelAdapter;
    protected $entity_id;

    /**
     * Initialize Controller
     */
    public function __initialize() {

        $this->entity_id = $this->getRequest()->getInt('entity');
        if ($this->entity_id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }


        $this->productAttributeModelAdapter = new Eav_Attribute_Model_Adapter();
        $this->productAttributeModelAdapter->where('entity_id = ?', $this->entity_id);
        $this->productAttributeDataGridView = new Eav_Attribute_DataGridView();
        $this->productAttributeDataGridView->Sortable = true;
        $this->productAttributeDataGridView->Searchable = true;
        $this->productAttributeDataGridView->setWithPagination(true);
       
        $this->getView()->setMessage(_t('List products attributes'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->productAttributeDataGridView->performSort($this->getRequest(), $this->productAttributeModelAdapter);
        $this->productAttributeDataGridView->performSearch($this->getRequest(), $this->productAttributeModelAdapter);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $projects = $this->productAttributeModelAdapter->fetch();
        $this->productAttributeDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->productAttributeDataGridView);
        $this->show();
    }

}

?>
