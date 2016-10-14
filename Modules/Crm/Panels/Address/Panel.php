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

/**
 * Description of AccountPanel
 *
 * @author Montasser
 */
class Crm_Address_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $countryLabel */
  public $countryLabel;

  /** @var Amhsoft_Label_Control $provinceLabel */
  public $provinceLabel;

  /** @var Amhsoft_Label_Control $cityLabel */
  public $cityLabel;

  /** @var Amhsoft_Label_Control $zipCodeLabel */
  public $zipCodeLabel;

  /** @var Amhsoft_Label_Control $streetLabel */
  public $streetLabel;

  /** @var Amhsoft_Label_Control $zipcodeLabel */
  public $zipcodeLabel;

  public function __construct($name = null, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->countryLabel = new Amhsoft_Label_Control(_t('Country'), new Amhsoft_Data_Binding('country'));
    $this->provinceLabel = new Amhsoft_Label_Control(_t('Province'), new Amhsoft_Data_Binding('province'));
    $this->cityLabel = new Amhsoft_Label_Control(_t('City'), new Amhsoft_Data_Binding('city'));
    $this->streetLabel = new Amhsoft_Label_Control(_t('Street'), new Amhsoft_Data_Binding('street'));
    $this->zipCodeLabel = new Amhsoft_Label_Control(_t('Zip Code'), new Amhsoft_Data_Binding('zipcode'));
    $this->addComponent($this->nameLabel);
    $this->addComponent($this->streetLabel);
    $this->addComponent($this->cityLabel);
    $this->addComponent($this->zipCodeLabel);
    $this->addComponent($this->provinceLabel);
    $this->addComponent($this->countryLabel);
  }

}

?>