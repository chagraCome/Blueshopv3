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
class Crm_Account_Group_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $aliasLabel */
  public $aliasLabel;

  /** @var Amhsoft_Label_Control $defaultLabel */
  public $defaultLabel;

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Group Information'));
    $panelInformation->setLayout($layout);
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->aliasLabel = new Amhsoft_Label_Control(_t('Alias'), new Amhsoft_Data_Binding('password'));
    $this->defaultLabel = new Amhsoft_YesNo_Text_Control(_t('Default'), new Amhsoft_Data_Binding('as_default'));
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->aliasLabel);
    $panelInformation->addComponent($this->defaultLabel);
    $this->addComponent($panelInformation);
  }

}

?>
