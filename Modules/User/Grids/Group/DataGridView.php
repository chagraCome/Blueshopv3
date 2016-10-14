<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Group_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /**
     * Construct
     * @param type $link
     */
    public function __construct($link = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $link;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Comonents
     */
    public function initializeComponents() {
        $nameCol = new Amhsoft_Link_Control(_t('Name'), '?module=user&page=group-detail');
        $nameCol->DisplayValue = "name";
        $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=user&page=group-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth('60');
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=user&page=group-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth('60');
        $this->AddColumn($nameCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    public function initializeSearch() {
        $this->addSearcField('text');
    }

}

?>
