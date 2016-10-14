<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Payment_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $accountLabel */
  public $accountLabel;

  /** @var Amhsoft_Label_Control $sortIdLabel */
  public $sortIdLabel;

  /** @var Amhsoft_Label_Control $onlineLabel */
  public $onlineLabel;

  /**
   * Panel Construct
   */
  public function __construct() {
    parent::__construct();
    $this->initializeComponents();
  }

  /**
   * Initialize Panel Components
   */
  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Payment Information'));
    $panelInformation->setLayout($layout);
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->sortIdLabel = new Amhsoft_Label_Control(_t('Sort ID'), new Amhsoft_Data_Binding('sortid'));
    $this->onlineLabel = new Amhsoft_Label_Control(_t('Status'), new Amhsoft_Data_Binding('online'));
    $this->accountLabel = new Amhsoft_Label_Control(_t('Account Information'), new Amhsoft_Data_Binding('account_info'));
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->sortIdLabel);
    $panelInformation->addComponent($this->onlineLabel);
    $panelInformation->addComponent($this->accountLabel);
    $this->addComponent($panelInformation);
  }

}

?>
