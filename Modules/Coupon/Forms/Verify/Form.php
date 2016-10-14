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
class Coupon_Verify_Form extends Amhsoft_Widget_Form {

    public $name;

    /** @ var Amhsoft_Button_Submit_Control $submitButton * */
    public $submitButton;
    public $captcha;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $this->name = new Amhsoft_Input_Control('promotion_code', _t('Promotion Code'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('promotion_code');
        $this->name->Required = true;

        $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
        $this->captcha->setRequired(true);
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Checkout Now"));
        $this->submitButton->Class = "Button checkout";
        $backButton = new Amhsoft_Button_Submit_Control("back", _t("Back"));
        $backButton->Class = "Button checkout";
        $panelButtons = new Amhsoft_Widget_Panel();
        $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
        $panelButtons->addComponent($this->submitButton);
        $panelButtons->addComponent($backButton);
        $this->addComponent($this->name);
        $this->addComponent($this->captcha);
        $this->addComponent($panelButtons);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

    public function isBack() {
        return isset($_POST["back"]);
    }

}

?>