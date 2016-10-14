<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Item_DataGridView extends Amhsoft_Widget_DataGridView {

    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    public function initializeComponents() {

        $numberCol = new Amhsoft_Label_Control(_t('Item No'), new Amhsoft_Data_Binding('item_number'));
        $nameCol = new Amhsoft_Label_Control(_t('Item Name'), new Amhsoft_Data_Binding('item_name'));
        $quantityCol = new Amhsoft_Label_Control(_t('Quantity'), new Amhsoft_Data_Binding('quantity'));
        $descriptionCol = new Amhsoft_Label_Control(_t('Description'), new Amhsoft_Data_Binding('item_description'));
        $priceCol = new Amhsoft_Currency_Label_Control(_t('Unit Price'), new Amhsoft_Data_Binding('unit_price'));
        $discountCol = new Amhsoft_Currency_Label_Control(_t('Discount'), new Amhsoft_Data_Binding('discount'));
        $totalPriceCol = new Amhsoft_Currency_Label_Control(_t('Sub Total'), new Amhsoft_Data_Binding('sub_total'));
        $editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=saleorder&page=item-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->onClickOpenInPopUp(640, 450);


        $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=saleorder&page=item-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $this->AddColumn($numberCol);
        $this->AddColumn($nameCol);
        $this->AddColumn($descriptionCol);
        $this->AddColumn($quantityCol);
        $this->AddColumn($priceCol);
        $this->AddColumn($discountCol);
        $this->AddColumn($totalPriceCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    public function initializeSearch() {
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
    }

}

?>
