<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Refund_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $nameLabel * */
  public $nameLabel;

  /** @var Amhsoft_Label_Control $numberLabel * */
  public $numberLabel;

  /** @var Amhsoft_Label_Control $priceLabel * */
  public $priceLabel;

  /** @var Amhsoft_Label_Control $paymentLogLabel * */
  public $paymentLogLabel;

  /** @var Amhsoft_Label_Control $saleOrderDiscountTypeLabel * */
  public $saleOrderDiscountTypeLabel;

  /** @var Amhsoft_Label_Control $userLabel * */
  public $userLabel;

  /** @var Amhsoft_Label_Control $personLabel * */
  public $personLabel;

  /** @var Amhsoft_Label_Control $personNameLabel * */
  public $personNameLabel;

  /** @var Amhsoft_Label_Control $creatorNameLabel * */
  public $creatorNameLabel;

  /** @var Amhsoft_Label_Control $paymentMethodNameLabel * */
  public $paymentMethodNameLabel;

  /** @var Amhsoft_Label_Control $shippingMethodNameLabel * */
  public $shippingMethodNameLabel;

  /** @var Amhsoft_Label_Control $dueLabel * */
  public $dueLabel;

  /** @var Amhsoft_Label_Control $descriptionLabel * */
  public $descriptionLabel;

  /** @var Amhsoft_Label_Control $paymentLabel * */
  public $paymentLabel;

  /** @var Amhsoft_Label_Control $insertAtLabel * */
  public $insertAtLabel;

  /** @var Amhsoft_Label_Control $updateAtlabel * */
  public $updateAtLabel;

  /** @var Amhsoft_Label_Control $discountLabel * */
  public $discountLabel;

  /** @var Amhsoft_Label_Control $policyLabel * */
  public $policyLabel;

  /** @var Amhsoft_Label_Control $saleOrderStateLabel * */
  public $saleOrderStateLabel;

  /** @var Crm_Address_Panel $saleOrderInvoiceAddressPanel */
  public $saleOrderInvoiceAddressPanel;

  /** @var Crm_Address_Panel $saleOrderShippingAddressPanel */
  public $saleOrderShippingAddressPanel;

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->saleOrderShippingAddressPanel = new Crm_Address_Panel(_t('Shipping Address'));
    $this->saleOrderShippingAddressPanel->setLayout(new Amhsoft_Grid_Layout(1));
    $this->saleOrderInvoiceAddressPanel = new Crm_Address_Panel(_t('Invoice Address'));
    $this->saleOrderInvoiceAddressPanel->setLayout(new Amhsoft_Grid_Layout(1));

    $topLayout = new Amhsoft_Grid_Layout(3);
    $topLayout->setWidth('100%');
    
    $topPanel = new Amhsoft_Widget_Panel();
    $topPanel->setLayout($topLayout);

    $layout = new Amhsoft_Grid_Layout(2);
    $layout->setWidth(500);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Sales Order Refund Information'));
    $panelInformation->setLayout($layout);

    $this->nameLabel = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('name'));
    $this->numberLabel = new Amhsoft_Label_Control(_t('Sales Order No'), new Amhsoft_Data_Binding('number'));
    $this->priceLabel = new Amhsoft_Currency_Label_Control(_t('Grand Total'), new Amhsoft_Data_Binding('total_price'));
    $this->saleOrderDiscountTypeLabel = new Amhsoft_Label_Control(_t('Sales Order Discount Type'), new Amhsoft_Data_Binding('saleorderdiscounttype'));
    $this->userLabel = new Amhsoft_Label_Control(_t('Assigned To'), new Amhsoft_Data_Binding('user'));
    $this->personLabel = new Amhsoft_Label_Control(_t('Related To'), new Amhsoft_Data_Binding('accountlink'));
    $this->personLabel->Html = true;
    $this->personNameLabel = new Amhsoft_Label_Control(_t('Account name'), new Amhsoft_Data_Binding('account_name'));
    $this->creatorNameLabel = new Amhsoft_Label_Control(_t('Creator Name'), new Amhsoft_Data_Binding('creator_name'));
    $this->paymentMethodNameLabel = new Amhsoft_Label_Control(_t('Payment Method'), new Amhsoft_Data_Binding('payment_method_name'));
    $this->shippingMethodNameLabel = new Amhsoft_Label_Control(_t('Shipping Method'), new Amhsoft_Data_Binding('shipping_method_name'));
    $this->dueLabel = new Amhsoft_Date_Label_Control(_t('Due Date'), new Amhsoft_Data_Binding('due_date'));
    $this->paymentLabel = new Amhsoft_Label_Control(_t('Payment'), new Amhsoft_Data_Binding('payment'));
    $this->insertAtLabel = new Amhsoft_Date_Time_Label_Control(_t('Created Time'), new Amhsoft_Data_Binding('insertat'));
    $this->updateAtLabel = new Amhsoft_Date_Time_Label_Control(_t('Modified Time'), new Amhsoft_Data_Binding('updateat'));
    $this->discountLabel = new Amhsoft_Currency_Label_Control(_t('Discount'), new Amhsoft_Data_Binding('discount'));
    $this->saleOrderStateLabel = new Amhsoft_Label_Control(_t('Sales Order State'), new Amhsoft_Data_Binding('saleOrderState'));
   // $stateLink = new Amhsoft_Link_Control(_t('Change State'), '?module=saleorder&page=saleorder-updatestate&id='.Amhsoft_Web_Request::getId());
    //$stateLink->Class = 'edit';
    $panelState = new Amhsoft_Widget_Panel();
    $panelState->setLayout(new Amhsoft_Grid_Layout(2));
    $panelState->addComponent($this->saleOrderStateLabel);
    //$panelState->addComponent($stateLink);
    $panelInformation->addComponent($this->numberLabel);
    $panelInformation->addComponent($this->nameLabel);
    $panelInformation->addComponent($this->priceLabel);
    $panelInformation->addComponent($this->discountLabel);
    $panelInformation->addComponent($this->personNameLabel);
    $panelInformation->addComponent($this->creatorNameLabel);
    $panelInformation->addComponent($this->updateAtLabel);
    $panelInformation->addComponent($this->personLabel);
    $panelInformation->addComponent($this->insertAtLabel);
    $panelInformation->addComponent($this->dueLabel);
    $panelInformation->addComponent($this->userLabel);
    $panelInformation->addComponent($panelState);
    $panelInformation->addComponent($this->paymentMethodNameLabel);
    $panelInformation->addComponent($this->shippingMethodNameLabel);


    $topPanel->addComponent($panelInformation);
    $topPanel->addComponent($this->saleOrderShippingAddressPanel);
    $topPanel->addComponent($this->saleOrderInvoiceAddressPanel);


    $panelDescription = new Amhsoft_Widget_Panel(_t('Description'));
    $this->descriptionLabel = new Amhsoft_Label_Control(_t('Description'), new Amhsoft_Data_Binding('description'));
    $this->descriptionLabel->Class = 'editable';
    $this->descriptionLabel->Id = 'div_description';
    $panelDescription->addComponent($this->descriptionLabel);

    $policyDescription = new Amhsoft_Widget_Panel(_t('Policy'));
    $this->policyLabel = new Amhsoft_Label_Control(_t('Policy'), new Amhsoft_Data_Binding('policy'));
    $this->policyLabel->Class = 'editable';
    $this->policyLabel->Id = 'div_policy';
    $policyDescription->addComponent($this->policyLabel);



    $panelPaymentLog = new Amhsoft_Widget_Panel(_t('Payment Log'));
    $this->paymentLogLabel = new Amhsoft_Label_Control(_t('Payment Log'), new Amhsoft_Data_Binding('payment_log'));
    $panelPaymentLog->addComponent($this->paymentLogLabel);

    $this->addComponent($topPanel);
    $this->addComponent($panelDescription);
    $this->addComponent($policyDescription);
    $this->addComponent($panelPaymentLog);
  }

}

?>