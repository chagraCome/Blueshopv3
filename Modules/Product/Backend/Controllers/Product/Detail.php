<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Detail_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Product_Panel $productPanel */
    protected $productPanel;
    protected $configurationId;
    protected $configurationAttributes = array();

    /** @var Product_Product_Model $productModel */
    protected $productModel;

    /**
     * Initialize Controller
     * @throws Amhsoft_Item_Not_Found_Exception
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->productPanel = new Product_Product_Panel();
        $productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModel = $productModelAdapter->fetchById($id);
        if (!$this->productModel instanceof Product_Product_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->getView()->setMessage(_t('Product Details'), View_Message_Type::INFO);

        $this->productModelAdapter = new Product_Product_Model_Adapter();
        $this->setId = $this->productModel->entity_set_id;
        $this->configurationId = $this->getRequest()->getInt('confid');
        $attributeSetAdapter = new Eav_Set_Model_Adapter();
        $this->setModel = $attributeSetAdapter->fetchById($this->setId);
        if (!$this->setModel instanceof Eav_Set_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->productModelAdapter->where('entity_set_id = ?', $this->setId);
        $confidsql = "SELECT product_configuration_id FROM product_configuration_has_product WHERE product_id = " . $this->getRequest()->getInt('product_id');
        $stmt = Amhsoft_Database::getInstance()->query($confidsql);
        $stmt->execute();
        $this->configurationId = $stmt->fetchColumn();
        
        $this->productModel->getTaxRate();
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getMarketingPanel();
        $this->getGroupedDataGridView();
        $this->getGlobalShippingOptionsPanel();
        $this->getImagesDataGridView();
        $this->getDocumentsDataGridView();
    }

    public function __ajax() {
        echo json_encode($this->productModel);
        exit;
    }

    /**
     * Get Grouped Product
     */
    public function getGroupedDataGridView() {
        $productDataGridView = new Product_Product_DataGridView();
        $productDataGridView->setRowCountProPage(500);
        if (intval($this->configurationId) > 0) {
            $sql = "SELECT product_id FROM product_configuration_has_product WHERE product_configuration_id = " . $this->configurationId;
            $stmt = Amhsoft_Database::getInstance()->query($sql);
            while ($row = $stmt->fetch()) {
                $productDataGridView->addCheckedLine($row['product_id']);
            }
        }
        $this->productModelAdapter->where('id <> ' . $this->productModel->getId());
        $this->productModelAdapter->where('category_id = ' . $this->productModel->category_id);
        $this->productModelAdapter->where('entity_set_id = ' . $this->productModel->entity_set_id);
        $where_configuration = $this->configurationId ? "WHERE product_configuration_id <> " . $this->configurationId : '';
        $this->productModelAdapter->where("id NOT IN (SELECT product_id FROM product_configuration_has_product $where_configuration)");

        for ($i = 0; $i < count($this->configurationAttributes); $i++) {
            if ($this->configurationAttributes[$i]->entity_attribute_type_backend_id == 21) {
                $label = new Amhsoft_ColorLabel_Control($this->configurationAttributes[$i]->label, new Amhsoft_Data_Binding($this->configurationAttributes[$i]->name . '_value'));
                $label->setLabel($this->configurationAttributes[$i]->label);
            } else {
                $label = new Amhsoft_Label_Control($this->configurationAttributes[$i]->label, new Amhsoft_Data_Binding($this->configurationAttributes[$i]->name . '_value'));
            }
            $productDataGridView->AddColumn($label);
        }
        $productDataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter);
        $this->getView()->assign("panel_related", $productDataGridView);
    }

    protected function getGlobalShippingOptionsPanel() {
        $headers = array('shipping_id' => 'c', 'title' => _t('Shipping Method'));
        $dataGridView = new Amhsoft_Widget_DataGridView($headers);
        $ds = new Shipping_Shipping_Model_Adapter();
        $ds->select('id as shipping_id');
        $ds->select('title');
        $dataGridView->DataSource = new Amhsoft_Data_Set($ds);
        $dataGridView->setCheckedLines($this->productModel->getEnabledShippingMethods());
        $this->getView()->assign("panel_shipping", $dataGridView);
    }

    protected function getMarketingPanel() {
        $productDataGridViewRelated = new Product_Product_DataGridView();
        $productDataGridViewRelated->DataSource = new Amhsoft_Data_Set($this->productModel->getRelatedProducts());
        $this->getView()->assign("panel_related", $productDataGridViewRelated);

        $productDataGridViewCross = new Product_Product_DataGridView();
        $productDataGridViewCross->DataSource = new Amhsoft_Data_Set($this->productModel->getCrossProducts());
        $this->getView()->assign("panel_cross", $productDataGridViewCross);

        $productDataGridViewUp = new Product_Product_DataGridView();
        $productDataGridViewUp->DataSource = new Amhsoft_Data_Set($this->productModel->getUpProducts());
        $this->getView()->assign("panel_up", $productDataGridViewUp);
    }

    /**
     * Get Images
     */
    public function getImagesDataGridView() {
        $dataGridView = new Product_Image_DataGridView();
        $dataGridView->DataSource = new Amhsoft_Data_set($this->productModel->getImages());
        $this->getView()->assign("images_grid", $dataGridView);
    }

    /**
     * Get Documents
     */
    public function getDocumentsDataGridView() {
        $dataGridView = new Product_Document_DataGridView();
        $dataGridView->DataSource = new Amhsoft_Data_set($this->productModel->getDocuments());
        $this->getView()->assign("documents_grid", $dataGridView);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->productPanel->setDataSource(new Amhsoft_Data_Set($this->productModel));
        $this->productPanel->Bind();
        $this->getView()->assign("product", $this->productModel);
        $this->getView()->assign('panel', $this->productPanel);

        $this->show();
    }

}

?>
