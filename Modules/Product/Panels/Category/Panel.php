<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Category_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel * */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $parentLabel * */
  public $parentLabel;

  /** @var Amhsoft_Label_Control $sortIdLabel * */
  public $sortIdLabel;

  /** @var $stateLabel * */
  public $stateLabel;

  /** @var Amhsoft_Label_Control $descriptionLabel * */
  public $descriptionLabel;

  /**
   * Panel construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Panel Components
   */
  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Product Category Information'));
    $panelInformation->setLayout($layout);
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->parentLabel = new Amhsoft_Label_Control(_t('Parent'), new Amhsoft_Data_Binding('parent'));
    $this->sortIdLabel = new Amhsoft_Label_Control(_t('Sort Id'), new DataBindig('sortId'));
    $this->stateLabel = new Amhsoft_Label_Control(_t('State'), new Amhsoft_Data_Binding('state'));
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->parentLabel);
    $panelInformation->addComponent($this->sortIdLabel);
    $panelInformation->addComponent($this->stateLabel);
    $panelDescription = new Amhsoft_Widget_Panel(_t('Product Category Description'));
    $panelDescription->setLayout($layout);
    $this->descriptionLabel = new Amhsoft_Label_Control(_t('Description '), new Amhsoft_Data_Binding('description'));
    $panelDescription->addComponent($this->descriptionLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelDescription);
  }

}

?>
