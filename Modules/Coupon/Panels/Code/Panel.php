<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Code_Panel extends Amhsoft_Widget_Panel {

  public $couponLabel;
  public $codeLabel;
  public $expireLabel;
  public $stateLabel;

  /** @var Amhsoft_Date_Time_Label_Control $insertAtLabel * */
  public $insertAtLabel;

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->codeLabel = new Amhsoft_Label_Control(_t('Code'), new Amhsoft_Data_Binding('code'));
    $this->stateLabel = new Amhsoft_Label_Control(_t('Code'), new Amhsoft_Data_Binding('state'));
    $this->insertAtLabel = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insert_date_time'));
    $this->expireLabel = new Amhsoft_Date_Label_Control(_t('Expire Date'), new Amhsoft_Data_Binding('expire_date'));

    $couponPanel = new Amhsoft_Widget_Panel();
    $couponPanel->setLayout(new Amhsoft_Grid_Layout(2));
    $couponPanel->addComponent($this->codeLabel);
    $couponPanel->addComponent($this->stateLabel);
    $couponPanel->addComponent($this->insertAtLabel);
    $couponPanel->addComponent($this->expireLabel);
    $this->addComponent($couponPanel);
  }

}

?>
