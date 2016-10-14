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
class Coupon_Code_DataGridView extends Amhsoft_Widget_DataGridView {

    public $code;
    public $insert_date_time;
    public $expire_date;
    public $state;
    public $editCol;
    public $deleteCol;

    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    public function initializeComponents() {
        $this->code = new Amhsoft_Link_Control(_t('Code'), '?module=coupon&page=code-detail');
        $this->code->DataBinding = new Amhsoft_Data_Binding('id', 'code');
        $this->code->DisplayValue = true;
        $this->AddColumn($this->code,'code');

        $this->insert_date_time = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'));
        $this->insert_date_time->DataBinding = new Amhsoft_Data_Binding('insert_date_time');
        $this->AddColumn($this->insert_date_time);
        $this->expire_date = new Amhsoft_Date_Label_Control(_t('Expire Date'));
        $this->expire_date->DataBinding = new Amhsoft_Data_Binding('expire_date');
        $this->AddColumn($this->expire_date);
        $this->state = new Amhsoft_Label_Control(_t('State'));
        $this->state->DataBinding = new Amhsoft_Data_Binding('state');
        $this->AddColumn($this->state);
        $this->editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=coupon&page=code-modify');
        $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->editCol->Class = "edit";
        $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), '?module=coupon&page=code-delete');
        $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
        $this->deleteCol->Class = "delete";
        $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
        $this->AddColumn($this->editCol,'edit');
        $this->AddColumn($this->deleteCol,'delete');
    }

    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField('text');
        $this->addSearcField('date');
        $this->addSearcField('date');
        $state = new Amhsoft_ListBox_Control('state_id', 'state');
        $state->DataBinding = new Amhsoft_Data_Binding('state_id', 'id', 'name');
        $stateAdapter = new Coupon_Code_State_Model_Adapter();
        $state->DataSource = new Amhsoft_Data_Set($stateAdapter->fetch()->fetchAll());
        $state->WithNullOption = true;
        $this->addSearcField($state);
        $this->addSearcField(null);
        $this->addSearcField(null);
    }

}

?>