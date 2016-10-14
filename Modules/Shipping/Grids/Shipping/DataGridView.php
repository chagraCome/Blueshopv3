<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Shipping_Shipping_DataGridView extends Amhsoft_Widget_DataGridView {

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
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $titleCol = new Amhsoft_Link_Control(_t('Name'), '?module=shipping&page=shipping-modify');
        $titleCol->DisplayValue = "title";
        $titleCol->DataBinding = new Amhsoft_Data_Binding('id', 'title');
        $minCol = new Amhsoft_Currency_Label_Control(_t('Min Order Amount'), new Amhsoft_Data_Binding('min_order_amount'));
        $sortCol = new Amhsoft_Label_Control(_t('Sort ID'), new Amhsoft_Data_Binding('sortid'));
        $costCol = new Amhsoft_Currency_Label_Control(_t('Cost'), new Amhsoft_Data_Binding('cost'));
        $onlineCol = new Amhsoft_Link_OnOffline_Control(_t('Status'), '?module=shipping&page=shipping-online');
        $onlineCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
        $onlineCol->setWidth(80);
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=shipping&page=shipping-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth(60);
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=shipping&page=shipping-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth(60);
        $this->AddColumn($titleCol);
        $this->AddColumn($costCol);
        $this->AddColumn($minCol);
        $this->AddColumn($sortCol);
        $this->AddColumn($onlineCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    /**
     * Initialize Search Fields
     */
    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');
    }

}

?>
