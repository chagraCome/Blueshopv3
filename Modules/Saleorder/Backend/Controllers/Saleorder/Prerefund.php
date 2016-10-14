<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Prerefund.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * TODO: @cherif review sales order after monstassar add handling fee
 * *********************************************************************************************** */

class Saleorder_Backend_Saleorder_Prerefund_Controller extends Amhsoft_System_Web_Controller {

  /** @var Saleorder_Panel $saleOrderPanel */
  protected $saleOrderPanel;

  /** @var Saleorder_Model $saleOrderModel */
  protected $saleOrderModel;

  /** @var Saleorder_Model_Adapter $saleOrderModelAdapter */
  protected $saleOrderModelAdapter;
  protected $id;
  protected $form;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }



    $this->saleOrderPanel = new Saleorder_Refund_Panel();

    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->id);



    if (!$this->saleOrderModel instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }


    // $this->saleOrderPanel->saleOrderStateLabel->Html = false;
    //$this->saleOrderPanel->saleOrderStateLabel->ToolTip = "<a href='?module=saleorder&page=saleorder-updatestate&id=" . $this->saleOrderModel->getId() . "'> " . _t('Modify State') . " </a>";

    $this->getView()->setMessage(_t('Sales order Refund Details'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    //setup quotation items datagridview and add it to sale order panel
    $this->setUpSaleOrderItemsDataGridView();
    $message = '';
    if ($this->getRequest()->isPost('doRefund') && $this->isRefundPossible($message)) {
      $this->refundOrder();
    } else {
      if ($message) {
        $this->getView()->setMessage($message, View_Message_Type::ERROR);
      }
    }
  }

  protected function isRefundPossible(&$message) {
    $possible = true;
    $items = $this->saleOrderModel->getItems();
    
   
    for ($i = 0; $i < count($items); $i++) {

      if (isset($_POST['r_refund_qnt'][$items[$i]->id]) && intval($_POST['r_refund_qnt'][$items[$i]->id]) > 0) {
        if (intval($items[$i]->quantity) >= (intval($items[$i]->refund_qnt) + intval($_POST['r_refund_qnt'][$items[$i]->id]))) {
          //$possible &= false;
          $message .= _t('%s was refunded', array($items[$i]->getItemName()));
        } else {
            $possible &= false;
            $message .= _t('Quantity to refund for %s must be less then %s ', array($items[$i]->getItemName(), (intval($items[$i]->quantity) - intval($items[$i]->refund_qnt)) + 1)).'<br />';
          
        }
      }
    }
    return $possible;
  }

  protected function refundOrder() {
    $clonedSalesOrder = clone $this->saleOrderModel;
    $clonedSalesOrder->id = null;
    $clonedSalesOrder->items = array();
    $clonedSalesOrder->setNumber($clonedSalesOrder->getNumber() . ' - ' . _t('Refund'));
    $clonedSalesOrder->sale_order_state_id = Saleorder_State_Model::REFUNDED;

    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    $saleOrderModelAdapter->save($clonedSalesOrder);
    
    $itemModelAapter = new Saleorder_Item_Model_Adapter();
    
    $items = $this->saleOrderModel->getItems();
    $itemsToRefund = array();
    for ($i = 0; $i < count($items); $i++) {
      if (isset($_POST['r_refund_qnt'][$items[$i]->id]) && intval($_POST['r_refund_qnt'][$items[$i]->id]) > 0) {
        $item_to_refund = clone $items[$i];
        $item_to_refund->refund_qnt = 0;
        $item_to_refund->id = null;
        $item_to_refund->quantity = intval($_POST['r_refund_qnt'][$items[$i]->id]);
        //$item_to_refund = new Saleorder_Item_Model();
        $item_to_refund->setUnitPrice($item_to_refund->getUnitPrice() * -1);
        $item_to_refund->reCalculatePrices();
        $clonedSalesOrder->addItem($item_to_refund);
        $this->saleOrderModel->items[$i]->refund_qnt += $item_to_refund->quantity;
        $itemModelAapter->update($this->saleOrderModel->items[0]);
      }
    }
    
    
    $refund_shipping_cost = $this->getRequest()->postfloat('shipping_cost');
    $refund_fee = $this->getRequest()->postfloat('handling_fee');
    $adjustment_refund = $this->getRequest()->postfloat('adjustment_refund');
    
    
    $clonedSalesOrder->shipping_cost = -1 * $refund_shipping_cost;
    $clonedSalesOrder->handling_fee = -1 * $refund_fee;
    $clonedSalesOrder->reCalculatePrices();

    
    
    $saleOrderModelAdapter->save($clonedSalesOrder, true);
    
   
    $saleOrderModelAdapter->save($this->saleOrderModel);
    
    $this->getRedirector()->go('admin.php?module=saleorder&page=saleorder-details&id='.$clonedSalesOrder->id.'&ret=true');
  }

  protected function addRefundComment() {
    
  }

  protected function fillAddresses() {

    $shippingAddress = $this->saleOrderModel->getShippingAddress();
    if ($shippingAddress) {
      $this->saleOrderPanel->saleOrderShippingAddressPanel->setDataSource(
              new Amhsoft_Data_set($shippingAddress))->Bind();
    }

    $invoiceAddress = $this->saleOrderModel->getInvoiceAddress();
    if ($invoiceAddress) {
      $this->saleOrderPanel->saleOrderInvoiceAddressPanel->setDataSource(
              new Amhsoft_Data_set($invoiceAddress))->Bind();
    }
  }

  /**
   * Setup items datagrid view and add it to panel.
   */
  public function setUpSaleOrderItemsDataGridView() {
    $this->form = new Amhsoft_Widget_Form('refund_form', 'post');

    $items = $this->saleOrderModel->getItems();
    for ($i = 0; $i < count($items); $i++) {
      //$items[$i]->refund_qnt = isset($_POST['refund_qnt'][$items[$i]->id]) ? $_POST['refund_qnt'][$items[$i]->id] : $items[$i]->quantity;
    }

    $panel = new Amhsoft_Widget_Panel(_t('Sales order Refund Items'));
    $saleOrderItemDataGridView = new Saleorder_Refund_Item_DataGridView();
    $saleOrderItemDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $panel->addComponent($saleOrderItemDataGridView);


    $panelGridbottom = new Amhsoft_Widget_Panel();
    $panelGridbottomLayout = new Amhsoft_Grid_Layout(6);
    $panelGridbottomLayout->setWidth('100%');
    $panelGridbottom->setLayout($panelGridbottomLayout);
    $panelGridbottom->addComponent(new Amhsoft_TextArea_Control('refund_comment', _t('Comment')));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));




    $pricesPanel = new Amhsoft_Widget_Panel();
    $pricesPanelLayout = new Amhsoft_Grid_Layout(1, Amhsoft_Abstract_Layout::PREPAPPEND);

    $pricesPanel->setLayout($pricesPanelLayout);
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Sub Total'), new Amhsoft_Data_Binding('sub_total')));
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Discount'), new Amhsoft_Data_Binding('total_discount')));

    $refundshippingInput = new Amhsoft_Currency_Input_Control('shipping_cost', _t('Refund Shipping'));
    $refundshippingInput->DataBinding = new Amhsoft_Data_Binding('shipping_cost');

    
    $refundFeeInput = new Amhsoft_Currency_Input_Control('handling_fee', _t('Adjustment Fee'));
    $refundFeeInput->DataBinding = new Amhsoft_Data_Binding('handling_fee');

    $adjustmentRefoundInput = new Amhsoft_Currency_Input_Control('adjustment_refund', _t('Adjustment Refund'));
    $adjustmentRefoundInput->DataBinding = new Amhsoft_Data_Binding('adjustment_refund');




    $pricesPanel->addComponent($refundshippingInput);
    $pricesPanel->addComponent($refundFeeInput);
    $pricesPanel->addComponent($adjustmentRefoundInput);

    $refundUpdateButton = new Amhsoft_Button_Submit_Control("updateRefund", _t("Update Changes"));
    $refundUpdateButton->Class = "ButtonSave";
    $pricesPanel->addComponent($refundUpdateButton);
    $pricesPanel->addComponent(new Amhsoft_Html_Control('<hr />'));
    $labelGrandTotal = new Amhsoft_Currency_Label_Control(_t('Grand Total'), new Amhsoft_Data_Binding('total_price'));
    $labelGrandTotal->style = "font-weight:bold";
    $pricesPanel->addComponent($labelGrandTotal);

    $pricesPanel->addComponent(new Amhsoft_Html_Control('<hr />'));



    $payOffRadio = new Amhsoft_RadioBox_Control('refund_type', _t('Pay Back'), '0', 'payoff');
    $payOffRadio->DataBinding = new Amhsoft_Data_Binding('refund_type');
    $payOffRadio->Disabled = true;
    $payOffRadio->Checked = true;

    $pricesPanel->addComponent($payOffRadio);

    $creditRadio = new Amhsoft_RadioBox_Control('refund_type', _t('Credit Memo'), '1', 'creditmemo');
    $creditRadio->DataBinding = new Amhsoft_Data_Binding('refund_type');
    $creditRadio->Value = 1;
    $creditRadio->Checked = false;
    $creditRadio->Disabled = true;

    $pricesPanel->addComponent($creditRadio);

    $pricesPanel->addComponent(new Amhsoft_Html_Control('<hr />'));
    $refundButton = new Amhsoft_Button_Submit_Control("doRefund", _t("Refund Order"));
    $refundButton->Class = "ButtonSave";

    $pricesPanel->addComponent($refundButton);

    $panelGridbottom->addComponent($pricesPanel);
    $panel->addComponent($panelGridbottom);




    $this->form->addComponent($panel);
    $this->saleOrderPanel->addComponent($this->form);



    //var_dump($_POST); exit;
    //exit;
  }

  public function __edit() {
    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    if ($this->getRequest()->post('elementid') == 'div_policy') {
      $value = ($this->getRequest()->post('newvalue'));
      $this->saleOrderModel->setPolicy($value);
      $saleOrderModelAdapter->save($this->saleOrderModel);
      echo nl2br(@html_entity_decode($value));
      exit;
    }
    if ($this->getRequest()->post('elementid') == 'div_description') {
      $value = ($this->getRequest()->post('newvalue'));
      $this->saleOrderModel->setDescription($value);
      $saleOrderModelAdapter->save($this->saleOrderModel);
      echo nl2br(@html_entity_decode($value));
      exit;
    }
    exit;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->includeJsFile('Amhsoft/Ressources/Javascripts/JQuery/jquery.editable.js', false);

    $this->saleOrderPanel->setDataSource(new Amhsoft_Data_Set($this->saleOrderModel));
    $this->saleOrderPanel->Bind();

    $this->form->DataSource = Amhsoft_Data_Source::Post();
    $this->form->Bind();

    $pos = strpos($this->saleOrderPanel->discountLabel->getValue(), '%');
    if ($pos !== FALSE) {
      $this->saleOrderPanel->discountLabel->Value = $this->saleOrderModel->total_discount;
    }
    $this->fillAddresses();
    $this->getView()->assign('panel', $this->saleOrderPanel);
    $this->show();
  }

}

?>
