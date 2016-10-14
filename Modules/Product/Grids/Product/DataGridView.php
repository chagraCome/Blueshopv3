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
class Product_Product_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /**
     * Grid Construct
     * @param type $linkUrl
     */
    public function __construct($linkUrl = 'admin.php') {
        parent::__construct(array('id' => 'c'));
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initilaize Grid Components
     */
    public function initializeComponents() {

        $imageCol = new Amhsoft_ImageTag_Control(_t('Image'), 'firstthumb', 0, 0);
        $imageCol->DataBinding = new Amhsoft_Data_Binding('firstthumb');
        $imageCol->setWidth(36);
        $imageCol->setHeight(36);
        $titleCol = new Amhsoft_Link_Control(_t('Title'), '?module=product&page=product-detail');
        $titleCol->DisplayValue = "title";
        $titleCol->DataBinding = new Amhsoft_Data_Binding('id', 'title');
        $numberCol = new Amhsoft_Label_Control(_t('Number'), new Amhsoft_Data_Binding('number'));
        $numberCol->setWidth(60);
        $categoryCol = new Amhsoft_Label_Control(_t('Product Category'), new Amhsoft_Data_Binding('category', 'category_id'));
        $priceCol = new Amhsoft_Currency_Label_Control(_t('Price'), new Amhsoft_Data_Binding('price'));
        $priceCol->setWidth(100);
        $purchasingCol = new Amhsoft_Currency_Label_Control(_t('Purchasing Price'), new Amhsoft_Data_Binding('purchasing_price'));
        $purchasingCol->setWidth(100);
        $discountCol = new Amhsoft_Currency_Label_Control(_t('Discount'), new Amhsoft_Data_Binding('discount'));
        $discountCol->setWidth(100);

        $userCol = new Amhsoft_Label_Control(_t('User'), new Amhsoft_Data_Binding('user', 'user_id'));

        $onlineCol = new Amhsoft_Link_OnOffline_Control(_t('Online'), "?module=product&page=product-online");
        $onlineCol->DataBinding = new Amhsoft_Data_Binding('id', 'online');
        $onlineCol->setWidth(80);
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=product&page=product-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth('60');
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=product&page=product-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth('60');

        $this->addColum($imageCol);
        $this->AddColumn($numberCol);
        $this->AddColumn($titleCol);
        $this->AddColumn($categoryCol);
        $this->AddColumn($priceCol);
        $this->AddColumn($purchasingCol);
        $this->addColum($userCol);
        $this->AddColumn($onlineCol, 'online');
        $this->AddColumn($editCol, 'edit');
    }

    /**
     * Initialize Search Fields
     */
    public function initializeSearch() {
        $this->addSearcField(null);
        $this->addSearcField('text');
        $this->addSearcField('text');
        $categoryListBox = new Amhsoft_ListBox_Control('category_id', _t('Category'));
        $categoryListBox->DataBinding = new Amhsoft_Data_Binding('category_id', 'id', 'name');
        $categoryListBox->WithNullOption = true;
        $r = new Product_Category_Model_Adapter();
        $categoryListBox->DataSource = new Amhsoft_Data_Set($r->fetch()->fetchAll());
        $this->addSearcField($categoryListBox);
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField(null);
        $listBox = new Amhsoft_YesNo_ListBox_Control('online', _t('State'), 'online');
        $listBox->WithNullOption = true;
        $this->addSearcField($listBox);
    }

}

?>
