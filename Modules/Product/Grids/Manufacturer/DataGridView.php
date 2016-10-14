<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Manufacturer_DataGridView extends Amhsoft_Widget_DataGridView {

    public $name;
    public $home_page;
    public $editCol;
    public $deleteCol;

    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    public function initializeComponents() {

        $this->name = new Amhsoft_Label_Control(_t('Name'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('name');
        $this->AddColumn($this->name);


        $this->home_page = new Amhsoft_Label_Control(_t('Home Page'));
        $this->home_page->DataBinding = new Amhsoft_Data_Binding('home_page');
        $this->AddColumn($this->home_page);


        $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=product&page=manufacturer-modify');
        $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->editCol->Class = "edit";
        $this->editCol->setWidth(80);
        $this->AddColumn($this->editCol);


        $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=manufacturer-delete');
        $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->deleteCol->Class = "delete";
        $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
        $this->deleteCol->setWidth(80);
        $this->AddColumn($this->deleteCol);
    }

    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField("text");
        $this->addSearcField("text");
    }

}

?>