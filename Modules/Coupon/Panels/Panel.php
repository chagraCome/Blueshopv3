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
class Coupon_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel * */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $typeLabel * */
  public $typeLabel;

  /** @var Amhsoft_Currency_Label_Control $amountLabel * */
  public $amountLabel;

  /** @var Amhsoft_Label_Control $percentLabel * */
  public $percentLabel;

  /** @var Amhsoft_Currency_Label_Control $minimumShoppingCartLabel * */
  public $minimumShoppingCartLabel;

  /** @var Amhsoft_YesNo_Text_Control $enabledYesNo * */
  public $enabledYesNo;

  /** @var Amhsoft_YesNo_Text_Control $pyhiscalYesNo * */
  public $pyhiscalYesNo;

  /** @var Amhsoft_Label_Control $userLabel * */
  public $userLabel;

  /** @var Amhsoft_Date_Time_Label_Control $insertAtLabel * */
  public $insertAtLabel;

  /** @var Amhsoft_Date_Time_Label_Control $updateAtlabel * */
  public $updateAtLabel;

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
    $this->typeLabel = new Amhsoft_Label_Control(_t('Type'), new Amhsoft_Data_Binding('type'));
    $this->amountLabel = new Amhsoft_Currency_Label_Control(_t('Amount'), new Amhsoft_Data_Binding('amount'));
    $this->percentLabel = new Amhsoft_Label_Control(_t('Percent'), new Amhsoft_Data_Binding('percent'));
    $this->minimumShoppingCartLabel = new Amhsoft_Currency_Label_Control(_t('Minimum Shopping Cart Amount'), new Amhsoft_Data_Binding('minum_shopping_cart_amount'));
    $this->enabledYesNo = new Amhsoft_YesNo_Text_Control(_t('Enabled'), new Amhsoft_Data_Binding('enabled'));
    $this->pyhiscalYesNo = new Amhsoft_YesNo_Text_Control(_t('Physical'), new Amhsoft_Data_Binding('physical'));
    $this->userLabel = new Amhsoft_Label_Control(_t('Created By'), new Amhsoft_Data_Binding('user'));
    $this->insertAtLabel = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insert_date_time'));
    $this->updateAtLabel = new Amhsoft_Date_Time_Label_Control(_t('Update Date'), new Amhsoft_Data_Binding('update_date_time'));

    $couponPanel = new Amhsoft_Widget_Panel();
    $couponPanel->setLayout(new Amhsoft_Grid_Layout(2));
    $couponPanel->addComponent($this->nameLabel);
    $couponPanel->addComponent($this->typeLabel);
    $couponPanel->addComponent($this->amountLabel);
    $couponPanel->addComponent($this->percentLabel);
    $couponPanel->addComponent($this->enabledYesNo);
    $couponPanel->addComponent($this->pyhiscalYesNo);
    $couponPanel->addComponent($this->insertAtLabel);
    $couponPanel->addComponent($this->updateAtLabel);
    $couponPanel->addComponent($this->userLabel);
    $couponPanel->addComponent($this->minimumShoppingCartLabel);
    $this->addComponent($couponPanel);
  }

}

?>
