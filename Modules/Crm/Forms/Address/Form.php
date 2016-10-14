<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 207 2016-01-29 16:12:25Z imen.amhsoft $
 * $Rev: 207 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-29 17:12:25 +0100 (ven., 29 janv. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Address_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    public $idHidden;

    /** @var Amhsoft_Input_Control $personnameInput */
    public $personnameInput;

    /** @var Amhsoft_Input_Control $streetInput */
    public $streetInput;

    /** @var Amhsoft_Input_Control $zipCodeInput */
    public $zipCodeInput;

    /** @var Amhsoft_Input_Control $cityInput */
    public $cityInput;

    /** @var Amhsoft_Input_Control $provinceInput */
    public $provinceInput;

    /** @var Amhsoft_Input_Control $countryInput */
    public $countryInput;
    public $submitButton;
    private $prefix;

    public function __construct($name, $method = null, $prefix = null) {
        parent::__construct($name, $method);
        $this->prefix = $prefix;
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->idHidden = new Amhsoft_Hidden_Control($this->prefix . 'id', new Amhsoft_Data_Binding('id'));
        $this->personnameInput = new Amhsoft_Input_Control($this->prefix . 'name', _t('Person Name'));
        $this->personnameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->personnameInput->addValidator('String|3');
        $this->personnameInput->Required = true;
        $this->personnameInput->setWidth(250);
        $this->streetInput = new Amhsoft_Input_Control($this->prefix . 'street', _t('Street'));
        $this->streetInput->DataBinding = new Amhsoft_Data_Binding('street');
        $this->streetInput->Required = true;
        $this->streetInput->setWidth(300);

        $this->zipCodeInput = new Amhsoft_Input_Control($this->prefix . 'zipcode', _t('Zip Code/PBOX'));
        $this->zipCodeInput->DataBinding = new Amhsoft_Data_Binding('zipcode');
        $this->cityInput = new Amhsoft_Input_Control($this->prefix . 'city', _t('City'));
        $this->cityInput->DataBinding = new Amhsoft_Data_Binding('city');
        $this->cityInput->setWidth(300);
        $this->provinceInput = new Amhsoft_Input_Control($this->prefix . 'province', _t('Province'));
        $this->provinceInput->DataBinding = new Amhsoft_Data_Binding('province');
        $this->provinceInput->setWidth(300);
        $this->countryInput = new Amhsoft_ListBox_Control($this->prefix . 'country', _t('Country'));
        $this->countryInput->DataBinding = new Amhsoft_Data_Binding('country', 'iso', 'name', Amhsoft_Locale::getCountryIso3());
        $this->countryInput->DataSource = new Amhsoft_Data_Set(Amhsoft_Locale::getCountryArray());
        $this->countryInput->setRequired(true);
        $this->countryInput->setWidth(250);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $this->addComponent($this->idHidden);
        $this->addComponent($this->personnameInput);
        $this->addComponent($this->streetInput);
        $this->addComponent($this->cityInput);
        $this->addComponent($this->provinceInput);
         $this->addComponent($this->zipCodeInput);
        $this->addComponent($this->countryInput);
        $this->addComponent($this->submitButton);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
