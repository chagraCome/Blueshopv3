<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_DataGridView extends Amhsoft_Widget_DataGridView {

    public $name;
    public $type;
    public $amount;
    public $insert_date_time;
    public $user;
    public $editCol;
    public $stateCol;
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
        $this->type = new Amhsoft_Label_Control(_t('Type'));
        $this->type->DataBinding = new Amhsoft_Data_Binding('type');
        $this->AddColumn($this->type);
        $this->amount = new Amhsoft_Currency_Label_Control(_t('Amount'));
        $this->amount->DataBinding = new Amhsoft_Data_Binding('amount');
        $this->AddColumn($this->amount);
        $this->insert_date_time = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'));
        $this->insert_date_time->DataBinding = new Amhsoft_Data_Binding('insert_date_time');
        $this->AddColumn($this->insert_date_time);
        $this->user = new Amhsoft_Label_Control(_t('Created By'));
        $this->user->DataBinding = new Amhsoft_Data_Binding('user');
        $this->AddColumn($this->user);
        $manageCodes = new Amhsoft_Link_Control(_t('Codes'), '?module=coupon&page=detail');
        $manageCodes->DataBinding = new Amhsoft_Data_Binding('id');
        $manageCodes->Class = "details";
        $this->AddColumn($manageCodes);
        $this->editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=coupon&page=modify');
        $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->editCol->Class = "edit";
        $this->stateCol = new Amhsoft_Link_OnOffline_Control(_t('Status'), '?module=coupon&page=online');
        $this->stateCol->DataBinding = new Amhsoft_Data_Binding('id', 'enabled');
        $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), '?module=coupon&page=delete');
        $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->deleteCol->Class = "delete";
        $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
        $this->AddColumn($this->stateCol);
        $this->AddColumn($this->editCol);
        $this->AddColumn($this->deleteCol);
    }

    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField('text');
        $type = new Amhsoft_ListBox_Control('type_id', 'type');
        $type->DataBinding = new Amhsoft_Data_Binding('type_id', 'id', 'name');
        $typeAdapter = new Coupon_Type_Model_Adapter();
        $type->DataSource = new Amhsoft_Data_Set($typeAdapter->fetch()->fetchAll());
        $type->WithNullOption = true;
        $this->addSearcField($type);
        $this->addSearcField('text');
        $this->addSearcField('date');
        $this->addSearcField('text');
    }

}

?>