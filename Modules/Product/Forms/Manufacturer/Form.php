<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Manufacturer_Form extends Amhsoft_Widget_Form {

    public $name;
    public $home_page;
    public $description;
    public $submitButton;
    public $captcha;
    public $manufacturerLogo;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $generalInformationsPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
        $this->name = new Amhsoft_Input_Control('name', _t('Name'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('name');
        $this->name->Required = true;
        $generalInformationsPanel->addComponent($this->name);

        $this->home_page = new Amhsoft_Input_Control('home_page', _t('Page'));
        $this->home_page->DataBinding = new Amhsoft_Data_Binding('home_page');
        $this->home_page->setWidth(250);
        $generalInformationsPanel->addComponent($this->home_page);

        $descriptionPanel = new Amhsoft_Widget_Panel(_t('Description'));


        $this->description = new Amhsoft_TextArea_Control('description', _t('Description'));
        $this->description->DataBinding = new Amhsoft_Data_Binding('description');
        $descriptionPanel->addComponent($this->description);

        $logoPanel = new Amhsoft_Widget_Panel(_t('Logo'));

        $this->manufacturerLogo = new Amhsoft_ImageControl_Control('logosrc');
        $fileUpload = new Amhsoft_FileInput_Control('logo', _t('Manufacturer Logo'));
        $this->manufacturerLogo->setUploadControl($fileUpload);
        $this->manufacturerLogo->setWidth(200);
        $this->manufacturerLogo->DataBinding = new Amhsoft_Data_Binding('logosrc');
        $logoPanel->addComponent($this->manufacturerLogo);


        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Save"));
        $this->submitButton->Class = "ButtonSave";

        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);


        $this->addComponent($generalInformationsPanel);
        $this->addComponent($descriptionPanel);
        $this->addComponent($logoPanel);
        $this->addComponent($navigationPanel);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>