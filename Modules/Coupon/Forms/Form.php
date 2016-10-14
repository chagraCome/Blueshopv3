<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Form extends Amhsoft_Widget_Form {

    public $name;
    public $type;
    public $amount;
    public $percent;
    public $minum_shopping_cart_amount;
    public $enabled;
    public $user;
    public $physical;
    public $submitButton;
    public $captcha;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $panel = New Amhsoft_Widget_Panel(_t('Add Coupon'));
        $this->name = new Amhsoft_Input_Control('name', _t('Name'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('name');
        $this->name->Required = true;
        $this->type = new Amhsoft_ListBox_Control('type_id', _t('Type'));
        $this->type->DataBinding = new Amhsoft_Data_Binding('type_id', 'id', 'name');
        $this->type->DataSource = new Amhsoft_Data_Set(new Coupon_Type_Model_Adapter());
        $this->type->Required = true;
        $this->amount = new Amhsoft_Currency_Input_Control('amount', _t('Amount'));
        $this->amount->DataBinding = new Amhsoft_Data_Binding('amount');
        $this->percent = new Amhsoft_Input_Control('percent', _t('Percent'));
        $this->percent->DataBinding = new Amhsoft_Data_Binding('percent');
        $this->minum_shopping_cart_amount = new Amhsoft_Currency_Input_Control('minum_shopping_cart_amount', _t('Minum Shopping Cart Amount'));
        $this->minum_shopping_cart_amount->DataBinding = new Amhsoft_Data_Binding('minum_shopping_cart_amount');
        $this->enabled = new Amhsoft_YesNo_ListBox_Control('enabled', _t('Enabled'), 'enabled', 1);
        $this->physical = new Amhsoft_YesNo_ListBox_Control('physical', _t('Physical'), 'physical', 1);
        $panelNavigation = New Amhsoft_Widget_Panel(_t('Navigation'));
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
        $this->submitButton->Class = "ButtonSave";
        $panelNavigation->addComponent($this->submitButton);
        $panel->addComponent($this->name);
        $panel->addComponent($this->type);
        $panel->addComponent($this->amount);
        $panel->addComponent($this->percent);
        $panel->addComponent($this->minum_shopping_cart_amount);
        $panel->addComponent($this->enabled);
        $panel->addComponent($this->physical);
        $this->addComponent($panel);
        $this->addComponent($panelNavigation);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>