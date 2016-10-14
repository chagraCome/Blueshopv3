<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Product_Multi_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /**
     * Grid Construct
     * @param type $linkUrl
     */
    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $imageCol = new Amhsoft_ImageTag_Control(_t('Image'), 'firstthumb', 0, 0);
        $imageCol->DataBinding = new Amhsoft_Data_Binding('firstthumb');
        $imageCol->setWidth(36);
        $imageCol->setHeight(36);
        $titleCol = new Amhsoft_Input_Control('title', _t('Title'));
        $titleCol->DataBinding = new Amhsoft_Data_Binding('title', 'id');
        $titleCol->setWidth(600);
        $numberCol = new Amhsoft_Input_Control('number', _t('Number'));
        $numberCol->DataBinding = new Amhsoft_Data_Binding('number', 'id');
        $numberCol->setWidth(30);
        $priceCol = new Amhsoft_Currency_Input_Control('price', _t('Price'));
        $priceCol->DataBinding = new Amhsoft_Data_Binding('saleprice', 'id');
        $categoryInput = new Amhsoft_ListBox_Control('category_id', _t('Category'));
        $categoryAdapter = new Product_Category_View_Model_Adapter();
        $categoryInput->DataSource = new Amhsoft_Data_Set($categoryAdapter->fetchAllAsTree());
        $categoryInput->DataBinding = new Amhsoft_Data_Binding('category_id', 'id', 'name');
        $quantityCol = new Amhsoft_Input_Control('quantity', _t('Quantity'));
        $quantityCol->DataBinding = new Amhsoft_Data_Binding('quantity', 'id');
        $this->AddColumn($imageCol);
        $this->AddColumn($numberCol);
        $this->AddColumn($titleCol);
        $this->AddColumn($priceCol);
        $this->AddColumn($categoryInput);
        $this->addColum($quantityCol);
    }

    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField(null);
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
    }

}

?>
