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
class Coupon_Code_Form extends Amhsoft_Widget_Form {

    public $code;
   public $couponcodeStateInput;
    public $expire_date;
    public $submitButton;
    public $captcha;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $Panel = new Amhsoft_Widget_Panel(_t('Coupon code'));
        $this->code = new Amhsoft_Input_Control('code', _t('Code'));
        $this->code->DataBinding = new Amhsoft_Data_Binding('code');
        $this->code->Required = true;
        $Panel->addComponent($this->code);
        $this->couponcodeStateInput = new Amhsoft_ListBox_Control('coupon_code_state_id', _t('State'));
        $this->couponcodeStateInput->DataBinding = new Amhsoft_Data_Binding('coupon_code_state_id', 'id', 'name');
        $this->couponcodeStateInput->DataSource = new Amhsoft_Data_Set(new Coupon_Code_State_Model_Adapter());
        $this->couponcodeStateInput->Required = true;
        $Panel->addComponent($this->couponcodeStateInput);
        $this->expire_date = new Amhsoft_Date_Input_Control('expire_date', _t('Expire Date'));
        $this->expire_date->DataBinding = new Amhsoft_Data_Binding('expire_date');
        $this->expire_date->Required = true;
        $Panel->addComponent($this->expire_date);
        $NavigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
        $this->submitButton->Class = "ButtonSave";
        $NavigationPanel->addComponent($this->submitButton);
        $this->addComponent($Panel);
        $this->addComponent($NavigationPanel);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>