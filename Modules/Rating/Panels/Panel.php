<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Rating_Panel extends Amhsoft_Widget_Panel {

  public $nameLabel;
  public $rateLabel;
  public $commentLabel;
  public $ipLabel;

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
    $layout = new Amhsoft_Grid_Layout(1);
    $panelInformation = new Amhsoft_Widget_Panel(_t('General Information'));
    $panelInformation->setLayout($layout);
    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->rateLabel = new Amhsoft_Label_Control(_t('Rate'), new Amhsoft_Data_Binding('rate'));
    $this->commentLabel = new Amhsoft_Label_Control(_t('Comment'), new Amhsoft_Data_Binding('comment'));
    $this->ipLabel = new Amhsoft_Label_Control(_t('IP'), new Amhsoft_Data_Binding('ip'));
    $product = new Amhsoft_Label_Control(_t('Go to Product'), new Amhsoft_Data_Binding('link'));
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->rateLabel);
    $panelInformation->addComponent($this->ipLabel);
    $panelInformation->addComponent($this->commentLabel);
    $panelInformation->addComponent($product);
    $this->addComponent($panelInformation);
  }

}

?>
