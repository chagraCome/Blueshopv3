<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

class Crm_Account_Panel extends Amhsoft_Widget_Panel {

  /** @var Label $nameLabel */
  public $nameLabel;

  /** @var Label $numberLabel */
  public $numberLabel;

  /** @var Label $telefonLabel */
  public $telefonLabel;

  /** @var Label $mobileLabel */
  public $mobileLabel;
  public $company;
  public $company_website;

  /** @var Label $email1Label */
  public $email1Label;

  /** @var Label $email2Label */
  public $email2Label;

  /** @var Label $countryLabel */
  public $countryLabel;

  /** @var Label $provinceLabel */
  public $provinceLabel;

  /** @var Label $cityLabel */
  public $cityLabel;

  /** @var Label $streetLabel */
  public $streetLabel;

  /** @var Label $zipcodeLabel */
  public $zipcodeLabel;
  public $created;
  public $updated;

  public function __construct($name = null, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $layout->setWidth(600);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Person Information'));
    $panelInformation->setLayout($layout);
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->company = new Amhsoft_Label_Control(_t('Company'), new Amhsoft_Data_Binding('company'));
    $this->company_website = new Amhsoft_Label_Control(_t('Company Website'), new Amhsoft_Data_Binding('company_website'));
    $this->numberLabel = new Amhsoft_Label_Control(_t('Number'), new Amhsoft_Data_Binding('number'));
    $this->telefonLabel = new Amhsoft_Label_Control(_t('Telefon'), new Amhsoft_Data_Binding('telefon'));
    $this->mobileLabel = new Amhsoft_Label_Control(_t('Mobile'), new Amhsoft_Data_Binding('mobile'));
    $this->email1Label = new Amhsoft_Label_Control(_t('Email'), new Amhsoft_Data_Binding('email1'));
    $this->email2Label = new Amhsoft_Label_Control(_t('Email 2'), new Amhsoft_Data_Binding('email2'));
    $this->countryLabel = new Amhsoft_Label_Control(_t('Country'), new Amhsoft_Data_Binding('country'));
    $this->provinceLabel = new Amhsoft_Label_Control(_t('Province'), new Amhsoft_Data_Binding('province'));
    $this->cityLabel = new Amhsoft_Label_Control(_t('City'), new Amhsoft_Data_Binding('city'));
    $this->streetLabel = new Amhsoft_Label_Control(_t('Street'), new Amhsoft_Data_Binding('street'));
    $this->zipcodeLabel = new Amhsoft_Label_Control(_t('Zipcode'), new Amhsoft_Data_Binding('zipcode'));
    $this->created = new Amhsoft_Date_Time_Label_Control( _t('Created At'),new Amhsoft_Data_Binding('create_date_time'));
    $this->updated = new Amhsoft_Date_Time_Label_Control(_t('Updated At'),new Amhsoft_Data_Binding('update_date_time'));
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->company);
    $panelInformation->addComponent($this->company_website);
    $panelInformation->addComponent($this->numberLabel);
    $panelInformation->addComponent($this->telefonLabel);
    $panelInformation->addComponent($this->mobileLabel);
    $panelInformation->addComponent($this->email1Label);
    $panelInformation->addComponent($this->email2Label);
    $panelInformation->addComponent($this->countryLabel);
    $panelInformation->addComponent($this->provinceLabel);
    $panelInformation->addComponent($this->cityLabel);
    $panelInformation->addComponent($this->streetLabel);
    $panelInformation->addComponent($this->zipcodeLabel);
    $panelInformation->addComponent($this->created);
    $panelInformation->addComponent($this->updated);;
    $panelNotice = new Amhsoft_Widget_Panel(_t('Notice'));
    $panelNotice->setLayout($layout);
    $this->noticeLabel = new Amhsoft_Label_Control(_t('Notice'), new Amhsoft_Data_Binding('notice'));
    $panelNotice->addComponent($this->noticeLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelNotice);
  }

}

?>
