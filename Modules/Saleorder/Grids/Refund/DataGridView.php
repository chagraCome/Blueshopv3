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
class Saleorder_Refund_DataGridView extends Amhsoft_Widget_DataGridView {

    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    public function initializeComponents() {

        $nameCol = new Amhsoft_Link_Control(_t('Name'), 'admin.php?module=saleorder&page=saleorder-Prerefund');
        $nameCol->DisplayValue = "name";
        $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
        $numberCol = new Amhsoft_Label_Control(_t('Number'), new Amhsoft_Data_Binding('number'));
        $priceCol = new Amhsoft_Currency_Label_Control(_t('Total Price'), new Amhsoft_Data_Binding('total_price'));

        $saleOrderState = new Amhsoft_Label_Control(_t('State'));
        $saleOrderState->DataBinding = new Amhsoft_Data_Binding('saleOrderState', 'sale_order_state_id');

        $creatorNameCol = new Amhsoft_Label_Control(_t('Creator Name'), new Amhsoft_Data_Binding('creator_name'));

        $relatedCol = new Amhsoft_Label_Control(_t('Related To'), new Amhsoft_Data_Binding('accountlink'));
        $relatedCol->Html = true;

        $personNameCol = new Amhsoft_Label_Control(_t('Assigned To'), new Amhsoft_Data_Binding('user'));

        $paymentMethodNameCol = new Amhsoft_Label_Control(_t('Payment Method'), new Amhsoft_Data_Binding('payment_method_name'));
        $insertAtCol = new Amhsoft_Date_Time_Label_Control(_t('Created Time'), new Amhsoft_Data_Binding('insertat'));

        $editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=saleorder&page=saleorder-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth(60);


        $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=saleorder&page=saleorder-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth(60);

        $this->AddColumn($numberCol);
        $this->AddColumn($nameCol);
        $this->AddColumn($priceCol);
        $this->AddColumn($saleOrderState);
        $this->AddColumn($relatedCol);
        $this->AddColumn($creatorNameCol);
        $this->AddColumn($personNameCol);
        $this->AddColumn($paymentMethodNameCol);
        $this->AddColumn($insertAtCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol,'delete');
    }

    public function initializeSearch() {
        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField('text');


        $saleOrderStateModelAdapter = new Saleorder_State_Model_Adapter();
        $saleOrderStates = $saleOrderStateModelAdapter->fetch()->fetchAll();

        $saleCol = new Amhsoft_ListBox_Control('sale_order_state_id', _t('State'));
        $saleCol->DataSource = new Amhsoft_Data_Set($saleOrderStates);
        $saleCol->DataBinding = new Amhsoft_Data_Binding('sale_order_state_id', 'id', 'name');
        $saleCol->WithNullOption = true;
        $this->addSearcField($saleCol);

        $accCol = new Amhsoft_ListBox_Control('account_id', _t('Account'));
        $adapter = new Crm_Account_Model_Adapter();
        $data = $adapter->fetch()->fetchAll();
        $accCol->DataSource = new Amhsoft_Data_Set($data);
        $accCol->DataBinding = new Amhsoft_Data_Binding('account', 'id', 'name');
        $accCol->WithNullOption = true;


        $assignedCol = new Amhsoft_ListBox_Control('user_id', _t('User'));
        $adapter = new User_User_Model_Adapter();
        $data = $adapter->fetch()->fetchAll();
        $assignedCol->DataSource = new Amhsoft_Data_Set($data);
        $assignedCol->DataBinding = new Amhsoft_Data_Binding('user_id', 'id', 'username');
        $assignedCol->WithNullOption = true;


        $this->addSearcField('text');
        $this->addSearcField('text');
        $this->addSearcField($assignedCol);



        $paymentCol = new Amhsoft_ListBox_Control('payment_method_name', _t('Payment'));
        $paymentAdapter = new Payment_Payment_Model_Adapter();
        $paymentCol->DataSource = new Amhsoft_Data_Set($paymentAdapter->fetch()->fetchAll());
        $paymentCol->DataBinding = new Amhsoft_Data_Binding('payment_method_name', 'name', 'name');
        $paymentCol->WithNullOption = true;

        $this->addSearcField($paymentCol);

        $this->addSearcField('date');
    }

}

?>
