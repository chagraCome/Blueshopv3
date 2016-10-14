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
class Product_Backend_Product_Modify_Multi_List_Controller extends Amhsoft_System_Web_Controller {

    protected $productDataGridView;

    /** @var ProductModelAdapter $productModelAdapter * */
    protected $productModelAdapter;
    protected $mainPanel;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->productDataGridView = new Product_Product_Multi_DataGridView();
        $this->productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModelAdapter->orderBy('sort_id, id DESC');
        $this->productModelAdapter->where('online = 1');
        $this->productDataGridView->Sortable = false;
        $this->productDataGridView->Searchable = false;

        $this->productDataGridView->performSort($this->getRequest(), $this->productModelAdapter);
        $this->productDataGridView->performSearch($this->getRequest(), $this->productModelAdapter);
        $this->productDataGridView->setRowCountProPage(10);
        $this->getView()->setMessage(_t('Modify all products'), View_Message_Type::INFO);
        $this->mainPanel = new Amhsoft_Widget_Panel();
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->getRequest()->isPost('submit')) {
            $numbers = $this->getRequest()->posts("number");
            $this->ids = array_keys($numbers);
            $this->singleSave($this->getRequest()->posts("title"), "title");
            $this->singleSave($this->getRequest()->posts("number"), "number");
            $this->singleSave($this->getRequest()->postInts("quantity"), "quantity");
            $this->singleSave($this->getRequest()->postFloats("price"), "price");
            $this->singleSave($this->getRequest()->postInts("category_id"), "category_id");
            $this->getView()->setMessage(_t('Action was successfully saved'), View_Message_Type::SUCCESS);

            //$this->getRedirector()->go('admin.php?module=product&page=product-modify-multi-&ret=true');
        }
    }

    /**
     * 
     * @param type $component
     * @param type $column
     * @return type
     */
    protected function singleSave($component, $column) {
        $db = Amhsoft_Database::newInstance();
        $db->beginTransaction();
        try {
            if ($column == "")
                return;
            if (!$component)
                return;
            if (!is_array($component))
                return;
            foreach ($component AS $key => $val) {
                if ($column == 'title') {
                    if ($key && $val) {
                        $db->exec("UPDATE product_lang SET " . $column . " = '" . addslashes($val) . "' WHERE product_id = '$key' AND lang ='".Amhsoft_System::getCurrentLang()."'");
                    }
                } else {
                    if ($key && $val) {
                        $db->exec("UPDATE product SET " . $column . " = '" . addslashes($val) . "' WHERE id = '$key'");
                    }
                }
            }
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            $this->getView()->setMessage(_t('Failed to update product'), View_Message_Type::ERROR);
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->productDataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter);
        $form = new Amhsoft_Widget_Form('multi_product', 'POST');
        $form->addComponent($this->productDataGridView);
        $form->addComponent(new Amhsoft_Html_Control('<div style="clear:both"></div></br>'));
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $submitButton->setClass('Save Button');
        $form->addComponent($submitButton);
        $this->mainPanel->addComponent($form);
        $this->getView()->assign('grid', $this->mainPanel);
        $this->show();
    }

}

?>
