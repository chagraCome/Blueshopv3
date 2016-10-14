<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 235 2016-02-01 13:28:53Z imen.amhsoft $
 * $Rev: 235 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-01 14:28:53 +0100 (lun., 01 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_ContactRes_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Input $nameInput */
    public $nameInput;

    /** @var Input $telefonInput */
    public $telefonInput;

    /** @var Input $mobileInput */
    public $mobileInput;

    /** @var Input $email1Input */
    public $email1Input;

    /** @var Input $countryInput */
    public $countryInput;

    /** @var Input $provinceInput */
    public $provinceInput;

    /** @var Input $cityInput */
    public $cityInput;

    /** @var Input $streetInput */
    public $streetInput;

    /** @var Input $messageInput */
    public $messageInput;

    /** @var Input $zipcodeInput */
    public $zipcodeInput;
    public $submitbutton;
    public $captcha;

    //public $htmlInfo;
    // public $infoPanel;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;
        $this->nameInput->addValidator('String|2');
        

        $this->mobileInput = new Amhsoft_Input_Control('mobile', _t('Mobile'));
        $this->mobileInput->DataBinding = new Amhsoft_Data_Binding('mobile');
        $this->mobileInput->setRequired(true);
        $this->mobileInput->setClass('input-box');


        $this->email1Input = new Amhsoft_Input_Control('email1', _t('Email'));
        $this->email1Input->DataBinding = new Amhsoft_Data_Binding('email1');
        $this->email1Input->addValidator('Email');
        $this->email1Input->Required = true;
        $this->email1Input->setClass('input-box');

        $this->messageInput = new Amhsoft_TextArea_Control('message', _t('Message'));
        $this->messageInput->DataBinding = new Amhsoft_Data_Binding('message');
        $this->messageInput->setClass('full_width r_corners');
        $this->captcha = new Amhsoft_CaptchaControl_Control('cap', _t('Security Code'));
        $this->captcha->setRequired(true);
        $this->captcha->setClass('full_width r_corners');

        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Submit'));
        $regPanel = new Amhsoft_Widget_Panel();
        $regPanel->addComponent($this->nameInput);
        $regPanel->addComponent($this->email1Input);
        $regPanel->addComponent($this->mobileInput);
        $regPanel->addComponent($this->messageInput);
        $regPanel->addComponent($this->captcha);
        $regPanel->addComponent($this->submitButton);
        $gridLayout = new Amhsoft_Grid_Layout(2);
        $panel = new Amhsoft_Widget_Panel();
        $panel->setLayout($gridLayout);

        $panel->addComponent($regPanel);
        $this->addComponent($panel);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
