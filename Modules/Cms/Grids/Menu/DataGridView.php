<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cms_Menu_DataGridView extends Amhsoft_Widget_DataGridView {

    /** @var Amhsoft_Label_Control $titleLabel */
    public $titleLabel;

    /** @var Amhsoft_Label_Control $stateLabel */
    public $stateLabel;

    /** @var Amhsoft_Label_Control $urlLabel */
    public $urlLabel;

    /** @var Amhsoft_Label_Control $cmsPageIDLabel */
    public $cmsPageIDLabel;

    /** @var Amhsoft_Label_Control $targetLabel */
    public $targetLabel;

    /** @var Amhsoft_Label_Control $parentIDLabel */
    public $parentIDLabel;

    /** @var Amhsoft_Label_Control $categoryLabel */
    public $categoryLabel;

    /** @var Amhsoft_Label_Control $cmsMainMenuLabel */
    public $cmsMainMenuLabel;

    /**
     * Grid Constuct
     * @param type $linkUrl
     */
    public function __construct($linkUrl = '') {
        parent::__construct(array('id' => 'c'));
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $this->titleLabel = new Amhsoft_Label_Control(_t('Menu item name'), new Amhsoft_Data_Binding('title'));
        $this->urlLabel = new Amhsoft_Label_Control(_t('URL'), new Amhsoft_Data_Binding('url'));
        $this->categoryLabel = new Amhsoft_Label_Control(_t('Product Category'), new Amhsoft_Data_Binding('product_category'));
        $this->stateLabel = new Amhsoft_Link_OnOffline_Control(_t('Status'), '?module=cms&page=menu-online');
        $this->stateLabel->DataBinding = new Amhsoft_Data_Binding('id', 'state');
        $this->stateLabel->setWidth(60);
        $this->cmsMainMenuLabel = new Amhsoft_Label_Control(_t('Main Menu'), new Amhsoft_Data_Binding('mainmenu', 'cms_main_menu_id'));
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=cms&page=menu-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->setWidth(60);
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setClass('delete');
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=cms&page=menu-modify');
        $editCol->setWidth(60);
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->setClass('edit');
        $this->AddColumn($this->titleLabel);
        $this->AddColumn($this->urlLabel);
        $this->AddColumn($this->cmsMainMenuLabel);
        $this->AddColumn($this->categoryLabel);
        $this->AddColumn($this->stateLabel);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    /**
     * Initialize Search Fiels
     */
    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField('text');
        $this->addSearcField('text');



        $menuCol = new Amhsoft_ListBox_Control('cms_main_menu_id', _t('Main Menu'));
        $menuCol->DataBinding = new Amhsoft_Data_Binding('cms_main_menu_id', 'id', 'name');
        $adapter = new Cms_MainMenu_Model_Adapter();
        $data = $adapter->fetch()->fetchAll();
        $menuCol->DataSource = new Amhsoft_Data_Set($data);
        $menuCol->WithNullOption = true;
        $this->addSearcField($menuCol);
        
    }

}

?>
