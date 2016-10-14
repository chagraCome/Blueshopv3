<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Coupon_Code_Execute_Panel extends Amhsoft_Widget_Panel {

  public $contactCount;
  public $accountCount;

  public function __construct() {
    parent::__construct();
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $panelInformation = new Amhsoft_Widget_Panel(_t('Information'));
    $layout = new Amhsoft_Grid_Layout(1);
    $layout->setWidth(600);
    $panelInformation->setLayout($layout);

    $this->contactCount = new Amhsoft_Label_Control(_t('Number of contact'), new Amhsoft_Data_Binding('contactcount'));
    $this->acountCount = new Amhsoft_Label_Control(_t('Number of account'), new Amhsoft_Data_Binding('accountcount'));
    
    $panelInformation->addComponent($this->contactCount);
    $panelInformation->addComponent($this->acountCount);
   
    $this->addComponent($panelInformation);
  }

}

?>
