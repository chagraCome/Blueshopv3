<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Details.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * TODO: @cherif review sales order after monstassar add handling fee
 * *********************************************************************************************** */

class Saleorder_Backend_Saleorder_Details_Controller extends Amhsoft_System_Web_Controller {

  /** @var Saleorder_Panel $saleOrderPanel */
  protected $saleOrderPanel;

  /** @var Saleorder_Model $saleOrderModel */
  protected $saleOrderModel;

  /** @var Saleorder_Model_Adapter $saleOrderModelAdapter */
  protected $saleOrderModelAdapter;
  protected $id;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }

    $this->saleOrderPanel = new Saleorder_Panel();

    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->id);

    if (!$this->saleOrderModel instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->saleOrderPanel->saleOrderStateLabel->Html = false;
    $this->saleOrderPanel->saleOrderStateLabel->ToolTip = "<a href='?module=saleorder&page=saleorder-updatestate&id=" . $this->saleOrderModel->getId() . "'> " . _t('Modify State') . " </a>";

    $this->getView()->setMessage(_t('Sales Order Details'), View_Message_Type::INFO);
  }

  public function __print() {
    $printTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
    $printTemplateModelAdapter->where('name = ?', 'saleorder.backend', PDO::PARAM_STR);
    $printTemplateModel = $printTemplateModelAdapter->fetch()->fetch();
    if ($printTemplateModel instanceof Setting_Template_Print_Model) {
      $this->getView()->assign('saleorder_template', $printTemplateModel->getFilledContent(array($this->saleOrderModel)));
    }
    $this->getView()->assign('saleorder', $this->saleOrderModel);
    echo '<script type="text/javascript">window.print();</script>';
    $this->popup("Modules/Saleorder/Backend/Views/Saleorder/print.popup.html");
    exit;
  }

  public function loadInvoiceDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Invoice')) {
      return;
    }
    $panel = new Amhsoft_Widget_Panel(_t('Related Invoices'));
    $dataGridView = new Invoice_DataGridView();
    $dataGridView->removeByIdentName('delete');
    $delCol = new Amhsoft_Link_Control(_t('Unassign'), 'admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&event=deleteInvoice');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = "invoice_id";
    $delCol->Class = 'delete';
    $dataGridView->AddColumn($delCol);

    $adapter = new Invoice_Model_Adapter();
    $adapter->where('sale_order_id = ?', $this->saleOrderModel->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    if ($this->saleOrderModel->getAccount() != NULL) {

      $linkInvoice = new Amhsoft_Link_Control(_t('Link Invoice'), 'admin.php?module=invoice&page=invoice-quicklist&related=' . $this->saleOrderModel->getAccount()->getId() . '&event=&maxpp=50&gridapply=&number=&name=&grand_total=');
      $linkInvoice->setClass('details');
      $linkInvoice->onClickOpenInPopUp(640, 480);
      $panelButtons = new Amhsoft_Widget_Panel();
      $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
      $panelButtons->addComponent($linkInvoice);
      $panel->addComponent($panelButtons);
    }
    $this->saleOrderPanel->addComponent($panel);
  }
  

  /**
   * DeleteInvoice event
   */
  public function __deleteInvoice() {
    $invoiceId = $this->getRequest()->getInt('invoice_id');
    if ($invoiceId > 0) {
      $invoiceAdapter = new Invoice_Model_Adapter();
      $invoiceModel = $invoiceAdapter->fetchById($invoiceId);
      $invoiceModel->sale_order_id = null;
      $invoiceAdapter->save($invoiceModel);
      Amhsoft_Navigator::go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
    }
  }

  protected function handleSelectedInvoice() {
    $selectedinvoice = Amhsoft_Registry::get('selected_quicklist_invoice_id');
    if ($selectedinvoice) {
      $sql = 'UPDATE invoice SET sale_order_id =' . $this->saleOrderModel->getId() . ' WHERE id = ' . $selectedinvoice;
      Amhsoft_Database::getInstance()->exec($sql);
      Amhsoft_Registry::destroy('selected_quicklist_invoice_id');
      Amhsoft_Navigator::go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
    }
  }
  
   public function loadFormDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Form')) {
      return;
    }
	
    $panel = new Amhsoft_Widget_Panel(_t('Related Form'));
    $dataGridView = new Form_DataGridView(16);
	$adapter = new Form_Model_Adapter();
	$adapter->leftJoin('saleorder_has_form','id','form_id');
	$adapter->where('saleorder_has_form.saleorder_id = ?', $this->saleOrderModel->getId());
	
	$dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
	$panel->addComponent($dataGridView);
    $this->saleOrderPanel->addComponent($panel);
  }

  public function loadQuotationDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Quotation')) {
      return;
    }
    $quotationConfiguration = new Amhsoft_Config_Table_Adapter(Quotation_Model::SETTING);

    $panel = new Amhsoft_Widget_Panel(_t('Related Quotation'));
    $dataGridView = new Quotation_DataGridView();
    $dataGridView->removeByIdentName('delete');

    $delCol = new Amhsoft_Link_Control(_t('Unassign'), 'admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&event=unassign');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = "quotation_id";
    $delCol->Class = 'delete';
    $dataGridView->AddColumn($delCol);
    if ($this->saleOrderModel->quotation_id) {
      $adapter = new Quotation_Model_Adapter();
      $model = $adapter->fetchById($this->saleOrderModel->quotation_id);
      if ($model instanceof Quotation_Model) {
        $dataGridView->DataSource = new Amhsoft_Data_Set($model);
        $panel->addComponent($dataGridView);
      } else {
        throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      $dataGridView->DataSource = new Amhsoft_Data_Set(array());
      $panel->addComponent($dataGridView);
    }
    if ($this->saleOrderModel->getAccount() != NULL) {
      $linkQuotation = new Amhsoft_Link_Control(_t('Link Quotation'), 'admin.php?module=quotation&page=quotation-quicklist&related=' . $this->saleOrderModel->getAccount()->getId() . '&event=&maxpp=50&gridapply=&number=&name=&grand_total=&quotation_state_id=' . $quotationConfiguration->getValue(Quotation_State_Model::ACCEPTED));
      $linkQuotation->setClass('details');
      $linkQuotation->onClickOpenInPopUp(640, 480);
      $panelButtons = new Amhsoft_Widget_Panel();
      $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
      $panelButtons->addComponent($linkQuotation);
      $panel->addComponent($panelButtons);
    }
    $this->saleOrderPanel->addComponent($panel);
  }

  protected function handleSelectedQuotation() {
    $selectedquotation = Amhsoft_Registry::get('selected_quicklist_quotation_id');
    if ($selectedquotation) {
      $sql = 'UPDATE sale_order SET quotation_id =' . $selectedquotation . ' WHERE id = ' . $this->saleOrderModel->getId();
      Amhsoft_Database::getInstance()->exec($sql);
      Amhsoft_Registry::destroy('selected_quicklist_quotation_id');
      Amhsoft_Navigator::go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
    }
  }

  public function __unassign() {
    $quotationId = $this->getRequest()->getInt('quotation_id');
    if ($quotationId > 0) {
      $saleorderAdapter = new Saleorder_Model_Adapter();
      $this->saleOrderModel->quotation_id = null;
      $saleorderAdapter->save($this->saleOrderModel);
      Amhsoft_Navigator::go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
    }
  }

  public function loadTasks() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Task')) {
      return;
    }

    $taskSetting = new Amhsoft_Config_Table_Adapter(Task_Model::CONFIG);


    $panel = new Amhsoft_Widget_Panel(_t('Related Tasks'));
    $dataGridView = new Task_DataGridView();
    $adapter = new Task_Model_Adapter();
    $adapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
    $adapter->where('entity_id = ?', $this->saleOrderModel->getId());
    $adapter->where('task_state_id <> ?', $taskSetting->getValue(Task_State_Model::CLOSED));
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $addNewTaksLink = new Amhsoft_Link_Control(_t('Add New Task'), 'admin.php?module=task&page=add&entity=Saleorder_Model&entityid=' . $this->saleOrderModel->getId() . '&entitylabel=' . $this->saleOrderModel->getName());
    $addNewTaksLink->setClass('add');
    $panel->addComponent($addNewTaksLink);
    $this->saleOrderPanel->addComponent($panel);
  }

  public function loadTaskHistories() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Task')) {
      return;
    }


    $taskSetting = new Amhsoft_Config_Table_Adapter(Task_Model::CONFIG);
    $panel = new Amhsoft_Widget_Panel(_t('Related Tasks History'));
    $dataGridView = new Task_DataGridView();
    $adapter = new Task_Model_Adapter();
    $adapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
    $adapter->where('entity_id = ?', $this->saleOrderModel->getId());
    $adapter->where('task_state_id = ?', $taskSetting->getValue(Task_State_Model::CLOSED));
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $this->saleOrderPanel->addComponent($panel);
  }

  /**
   * Default event
   */
  public function __default() {
    //see handleSelectedProduct description.
    $this->handleSelectedProduct();
    //setup quotation items datagridview and add it to sale order panel
    $this->setUpSaleOrderItemsDataGridView();
	$this->loadFormDataGridView();
    $this->addDocumentGrid();
    $this->loadQuotationDataGridView();
    $this->handleSelectedQuotation();
    $this->loadInvoiceDataGridView();
    $this->handleSelectedInvoice();
    $this->loadTasks();
    $this->loadTaskHistories();
    $this->loadComments();
    $this->loadWebailDataGridView();
    $this->loadProcessesGrid();
  }

  public function loadProcessesGrid() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Bpm')) {
      return;
    }

    $dataGridView = Modules_Bpm_Backend_Boot::getProcessDataGridView('SaleOrder_Model', $this->saleOrderModel->getId());
    $panel = new Amhsoft_Widget_Panel(_t('Related Processes'));
    $addNewAddressLink = new Amhsoft_Link_Control(_t('Create Process'), 'admin.php?module=bpm&page=circulation-add&entity=SaleOrder_Model&entity_id=' . $this->saleOrderModel->getId() . '&entity_label=' . $this->saleOrderModel->getName());
    $addNewAddressLink->setClass('add');
    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewAddressLink);
    $this->saleOrderPanel->addComponent($panel);
  }

  /**
   * Convertinvoice event
   */
  public function __convertinvoice() {
    if (!$this->saleOrderModel instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }

    $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
    $acceptedState = $saleOrderConfiguration->getIntValue(Saleorder_State_Model::ACCEPTED);
    $paidState = $saleOrderConfiguration->getIntValue(Saleorder_State_Model::PAID);
    if ($this->saleOrderModel->sale_order_state_id == $acceptedState || $this->saleOrderModel->sale_order_state_id == $paidState) {
      $this->saleOrderModel->sale_order_state_id = $saleOrderConfiguration->getValue(Saleorder_State_Model::CLOSED);
      $this->saleOrderModelAdapter = new Saleorder_Model_Adapter ();
      $this->saleOrderModelAdapter->save($this->saleOrderModel);
      $invoiceModel = $this->saleOrderModel->convertToInvoice();
      if ($invoiceModel instanceof Invoice_Model) {
        $this->getRedirector()->go('admin.php?module=invoice&page=invoice-modify&id=' . $invoiceModel->getId());
      }
    } else {
      $this->getView()->setMessage(_t('Cannot convert sales order to invoice, please change state to accepted before'), View_Message_Type::ERROR);
    }
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
    if ($this->saleOrderModel->account && !$this->saleOrderModel->isLocked()) {
      $shippingAddressModifyLink = new Amhsoft_Link_Control(_t('Modify'), 'admin.php?module=crm&page=account-address-quicklist&target=so_shipping&target_id=' . $this->saleOrderModel->getId() . "&acc_id=" . $this->saleOrderModel->account_id);
      $shippingAddressModifyLink->setClass('edit');
      $shippingAddressModifyLink->onClickOpenInPopUp(640, 450);

      $invoiceAddressModifyLink = new Amhsoft_Link_Control(_t('Modify'), 'admin.php?module=crm&page=account-address-quicklist&target=so_invoice&target_id=' . $this->saleOrderModel->getId() . "&acc_id=" . $this->saleOrderModel->account_id);
      $invoiceAddressModifyLink->setClass('edit');
      $invoiceAddressModifyLink->onClickOpenInPopUp(640, 450);


      $this->saleOrderPanel->saleOrderShippingAddressPanel->addComponent($shippingAddressModifyLink);
      $this->saleOrderPanel->saleOrderInvoiceAddressPanel->addComponent($invoiceAddressModifyLink);
    }
  }

  /**
   * Handle selected product
   * When we select a product from quicllist then this page will be refresh
   * also we can access to quicllist selected id while the quicklist save the selected id
   * in the session.
   * after using the selected id, destroy it.
   */
  protected function handleSelectedProduct() {
    //check if a product is selected!
    $selectedproduct = Amhsoft_Registry::get('product_quick_list_selected_id');
    if ($selectedproduct) {
      $this->addProductItemToSaleOrder($selectedproduct);
    }
    //destroy session after adding product to quotation
    Amhsoft_Registry::destroy('product_quick_list_selected_id');
  }

  /**
   * Add product to quotation 
   * step1 fetch product
   * step2 create itemModel
   * step3 add item model to quotation model
   * $quotation->AddItem(QuotationItem item)
   * @param int $selectedproduct
   * @return void 
   */
  protected function addProductItemToSaleOrder($selectedproduct) {
    if (intval($selectedproduct) <= 0) {
      return;
    }

    $productAdapter = new Product_Product_Model_Adapter();
    $productModel = $productAdapter->fetchById($selectedproduct);

    if (!$productModel instanceof Product_Product_Model) {
      return;
    }

    try {
      Product_Product_Model::liveDecrementQuantity(Amhsoft_Database::getInstance(), $productModel->getId(), 1);
    } catch (Exception $pException) {
      $this->getView()->setMessage($pException->getMessage(), View_Message_Type::ERROR);
      return;
    }


    $saleOrderModelAdapter = new Saleorder_Model_Adapter();

    $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();

    $saleOrderItemModelAdapter->where('item_id = ?', $productModel->getId());

    $saleOrderItemModelAdapter->where('sale_order_id = ?', $this->saleOrderModel->getId());
    $item = $saleOrderItemModelAdapter->fetch()->fetch();

    if ($item instanceof Saleorder_Item_Model) {

      $item->setQuantity($item->getQuantity() + 1);
      $item->setSubTotal($item->getQuantity() * $item->getUnitPrice());
      $saleOrderItemModelAdapter->save($item);
      $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->saleOrderModel->getId());
      $this->saleOrderModel->reCalculatePrices();
      Saleorder_Model::reCalculateAnsSavePricesId($this->saleOrderModel->id);
      $saleOrderModelAdapter->save($this->saleOrderModel);
      $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->saleOrderModel->getId());
      return;
    }
    $productModel->quantity_in_cart = 1;

    $item = new Saleorder_Item_Model();
    $item->setItemNumber($productModel->getNumber());
    $item->setItemName($productModel->getTitle());
    $item->setItemDescription($productModel->getDescription());
    $item->setUnitPrice($productModel->getSalePrice());
    $item->setProductNumber($productModel->getNumber());
    $item->setQuantity(1);
    $item->reCalculatePrices();
    $item->item_id = $productModel->getId();
    $item->sale_order_id = $this->saleOrderModel->getId();

    $saleOrderItemModelAdapter->save($item);
    $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->saleOrderModel->getId());
    $this->saleOrderModel->reCalculatePrices();
    Saleorder_Model::reCalculateAnsSavePricesId($this->saleOrderModel->id);
    $saleOrderModelAdapter->save($this->saleOrderModel);
    $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->saleOrderModel->getId());
  }

  /**
   * Setup items datagrid view and add it to panel.
   */
  public function setUpSaleOrderItemsDataGridView() {
    $panel = new Amhsoft_Widget_Panel(_t('Sales Order Items'));

    $saleOrderItemDataGridView = new Saleorder_Item_DataGridView('admin.php', $this->saleOrderModel->isLocked());

    $saleOrderItemDataGridView->DataSource = new Amhsoft_Data_Set($this->saleOrderModel->getItems());
    $panel->addComponent($saleOrderItemDataGridView);



    $addNewProductLink = new Amhsoft_Link_Control(_t('Add Product'), 'admin.php?module=product&page=product-quicklist');
    $addNewProductLink->onClickOpenInPopUp(640, 480);
    $addNewProductLink->setClass('add');


    $addNewCustomtLink = new Amhsoft_Link_Control(_t('Add Custom Item'), 'admin.php?module=saleorder&page=item-add&sale_order_id=' . $this->getRequest()->getId());
    $addNewCustomtLink->onClickOpenInPopUp(640, 480);
    $addNewCustomtLink->setClass('add');

    $panelGridbottom = new Amhsoft_Widget_Panel();



    if (!$this->saleOrderModel->isLocked()) {
      $panelGridbottomLayout = new Amhsoft_Grid_Layout(4);
      $panelGridbottom->addComponent($addNewProductLink);
      $panelGridbottom->addComponent($addNewCustomtLink);
    } else {
      $panelGridbottomLayout = new Amhsoft_Grid_Layout(6);
    }

    $panelGridbottomLayout->setWidth('100%');
    $panelGridbottom->setLayout($panelGridbottomLayout);

    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));
    $panelGridbottom->addComponent(new Amhsoft_Label_Control(''));


    $pricesPanel = new Amhsoft_Widget_Panel();
    $pricesPanelLayout = new Amhsoft_Grid_Layout(1, Amhsoft_Abstract_Layout::PREPAPPEND);

    $pricesPanel->setLayout($pricesPanelLayout);
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Sub Total'), new Amhsoft_Data_Binding('sub_total')));
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Discount'), new Amhsoft_Data_Binding('total_discount')));
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Shipping Cost'), new Amhsoft_Data_Binding('shipping_cost')));
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Handling Fee'), new Amhsoft_Data_Binding('handling_fee')));
    $pricesPanel->addComponent(new Amhsoft_Currency_Label_Control(_t('Grand Total'), new Amhsoft_Data_Binding('total_price')));

    $panelGridbottom->addComponent($pricesPanel);

    $panel->addComponent($panelGridbottom);

    $this->saleOrderPanel->addComponent($panel);
  }

  protected function addDocumentGrid() {
    $panel = new Amhsoft_Widget_Panel(_t('Sales Order Documents'));
    $documentDataGridView = new Saleorder_Document_DataGridView();
    $documentDataGridView->removeByIdentName('modify');
    if ($this->saleOrderModel->account instanceof Crm_Account_Model) {
      $documentDataGridView->mailLinkCol->Href = 'admin.php?module=webmail&page=email-add&target=saleorder&targetid=' . $this->saleOrderModel->getId() . '&to=' . $this->saleOrderModel->account_email . '&acc_id=' . $this->saleOrderModel->account_id;
    }
    $documentDataGridView->DataSource = new Amhsoft_Data_Set($this->saleOrderModel->getDocuments());

    $addDocumentUrl = new Amhsoft_Link_Control(_t('Add Document'), 'admin.php?module=saleorder&page=document-add&sale_order_id=' . $this->getRequest()->getId());
    $addDocumentUrl->Class = 'add';
    $addDocumentUrl->onClickOpenInPopUp(640, 300);
    $generatePdf = new Amhsoft_Link_Control(_t('Generate PDF'), 'admin.php?module=saleorder&page=document-generate&id=' . $this->getRequest()->getId());
    $generatePdf->Class = 'add';

    $panelButtons = new Amhsoft_Widget_Panel();
    $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
    $panelButtons->addComponent($addDocumentUrl)->addComponent($generatePdf);

    $panel->addComponent($documentDataGridView);
    $panel->addComponent($panelButtons);
    $this->saleOrderPanel->addComponent($panel);
  }

  protected function loadComments() {
    $panel = new Amhsoft_Widget_Panel(_t('Sales Order Comments'));
    $commentModelAdapter = new Comment_Model_Adapter();
    $commentDataGridView = new Comment_DataGridView();
    $commentModelAdapter->where('entity_id = ?', $this->saleOrderModel->getId());
    $commentModelAdapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
    $commentDataGridView->DataSource = new Amhsoft_Data_Set($commentModelAdapter->fetch());

    $addCommentUrl = new Amhsoft_Link_Control(_t('Add new Comment'), 'admin.php?module=comment&page=add&entity=Saleorder_Model&entityid=' . $this->getRequest()->getId());
    $addCommentUrl->Class = 'add';

    $panel->addComponent($commentDataGridView);
    $panel->addComponent($addCommentUrl);
    $this->saleOrderPanel->addComponent($panel);
    return $commentDataGridView;
  }

  public function loadWebailDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Webmail')) {
      return;
    }

    $adapter = new Webmail_Email_Model_Adapter();
    $adapter->leftJoinWithoutCardinality('saleorder_has_email', 'id', 'webmail_email_id');
    $adapter->leftJoinWithoutCardinality("sale_order", "saleorder_has_email.saleorder_id", 'sale_order.id');
    $adapter->where('saleorder_has_email.saleorder_id = ' . $this->saleOrderModel->getId());
    $dataGridView = new Webmail_Email_DataGridView();
    $dataGridView->Searchable = false;
    $dataGridView->Sortable = false;
    $panel = new Amhsoft_Widget_Panel(_t('Related Emails'));
    $data = $adapter->fetch();
    $dataGridView->DataSource = new Amhsoft_Data_Set($data);
    $addNewEmailLink = new Amhsoft_Link_Control(_t('Add New Email'), 'admin.php?module=webmail&page=email-add&target=saleorder&targetid=' . $this->saleOrderModel->getId() . '&to=' . $this->saleOrderModel->account_email . '&acc_id=' . $this->saleOrderModel->account_id);
    $addNewEmailLink->setClass('add');

    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewEmailLink);
    $this->saleOrderPanel->addComponent($panel);
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
    $pos = strpos($this->saleOrderPanel->discountLabel->getValue(), '%');
    if ($pos !== FALSE) {
      $this->saleOrderPanel->discountLabel->Value = $this->saleOrderModel->total_discount;
    }
    $this->fillAddresses();
    $this->getView()->assign('panel', $this->saleOrderPanel);
    $this->getView()->assign('order_locked', $this->saleOrderModel->isLocked());
    $this->getView()->assign('order_refunded', $this->saleOrderModel->isRefund());
    $this->show();
  }

}

?>
