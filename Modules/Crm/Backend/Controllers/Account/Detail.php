<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of detail
 *
 * @author cherif
 */
class Crm_Backend_Account_Detail_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_Panel $accountPanel */
  protected $accountPanel;

  /** @var Crm_Account_Model $accountModel */
  protected $accountModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Account Details'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      die('Access denied');
    }
    $this->accountPanel = new Crm_Account_Panel();
    $accountModelAdapter = new Crm_Account_Model_Adapter();
    $this->accountModel = $accountModelAdapter->fetchById($id);
    if (!$this->accountModel instanceof Crm_Account_Model) {
      die('Requested Account not found');
    }
  }

  public function loadInvoiceDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Invoice')) {
      return;
    }
    $panel = new Amhsoft_Widget_Panel(_t('Related Invoices'));
    $dataGridView = new Invoice_DataGridView();
    $adapter = new Invoice_Model_Adapter();
    $adapter->where('account_id = ?', $this->accountModel->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $addNewQuotationLink = new Amhsoft_Link_Control(_t('Add New Invoice'), 'admin.php?module=invoice&page=invoice-add&account_id=' . $this->accountModel->getId());
    $addNewQuotationLink->setClass('add');
    $panel->addComponent($addNewQuotationLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadTasks() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Task')) {
      return;
    }
    $taskSetting = new Amhsoft_Config_Table_Adapter(Task_Model::CONFIG);
    $panel = new Amhsoft_Widget_Panel(_t('Related Tasks'));
    $dataGridView = new Task_DataGridView();
    $adapter = new Task_Model_Adapter();
    $adapter->where('account_id = ? ', $this->accountModel->getId(), PDO::PARAM_INT);
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $addNewTaksLink = new Amhsoft_Link_Control(_t('Add New Task'), 'admin.php?module=task&page=add&entity=Crm_Account_Model&entityid=' . $this->accountModel->getId() . '&entitylabel=' . $this->accountModel->getName());
    $addNewTaksLink->setClass('add');
    $panel->addComponent($addNewTaksLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadTickets() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Ticket')) {
      return;
    }
    $panel = new Amhsoft_Widget_Panel(_t('Related Tickets'));
    $dataGridView = new Ticket_Ticket_DataGridView();
    $dataGridView->Searchable = FALSE;
    $dataGridView->Pagination = false;
    $dataGridView->Sortable = false;
    $adapter = new Ticket_Ticket_Model_Adapter();
    $adapter->where('entity = ?', 'Crm_Account_Model');
    $adapter->where('entity_id = ?', $this->accountModel->getId());
    $adapter->orderBy('id DESC ');
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $addNewTaksLink = new Amhsoft_Link_Control(_t('Add New Ticket'), 'admin.php?module=ticket&page=ticket-add&entity=Crm_Account_Model&entityid=' . $this->accountModel->getId() . '&entitylabel=' . $this->accountModel->getName());
    $addNewTaksLink->setClass('add');
    $panel->addComponent($addNewTaksLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadTaskHistories() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Task')) {
      return;
    }
    $taskSetting = new Amhsoft_Config_Table_Adapter(Task_Model::CONFIG);
    $panel = new Amhsoft_Widget_Panel(_t('Tasks History'));
    $dataGridView = new Task_DataGridView();
    $adapter = new Task_Model_Adapter();
    $adapter->where("account_id = ? ", $this->accountModel->getId());
    $adapter->where('task_state_id = ?', $taskSetting->getValue(Task_State_Model::CLOSED));
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $panel->addComponent($dataGridView);
    $this->accountPanel->addComponent($panel);
  }

  protected function addDocumentGrid() {
    $panel = new Amhsoft_Widget_Panel(_t('Related Documents'));
    $documentDataGridView = new Crm_Account_Document_DataGridView();
    $accountEmail = $this->accountModel->getEmail();
    $documentDataGridView->mailLinkCol->Href = 'admin.php?module=webmail&page=email-add&target=account&targetid=' . $this->accountModel->getId() . '&to=' . $accountEmail . '&acc_id=' . $this->accountModel->id;
    $documentDataGridView->DataSource = new Amhsoft_Data_Set($this->accountModel->getDocuments());
    $addDocumentUrl = new Amhsoft_Link_Control(_t('Add new Document'), 'admin.php?module=crm&page=account-document-add&account_id=' . $this->getRequest()->getId());
    $addDocumentUrl->Class = 'add';
    $genDocument = new Amhsoft_Link_Control(_t('Generate PDF'), 'admin.php?module=crm&page=account-document-generate&id=' . $this->getRequest()->getId());
    $genDocument->Class = 'print';
    $panelButtons = new Amhsoft_Widget_Panel();
    $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
    $panelButtons->addComponent($addDocumentUrl)->addComponent($genDocument);
    $panel->addComponent($documentDataGridView);
    $panel->addComponent($panelButtons);
    $this->accountPanel->addComponent($panel);
  }

  public function loadSaleOrderDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Saleorder')) {
      return;
    }
    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $_var = $accountConfiguration->getValue('fetch_related_contacts_data');
    if ($_var) {
      $saleOrderModelAdapter->where('(account_id = ' . $this->accountModel->getId() . ' OR contact_id IN (SELECT id FROM contact where account_id = ' . $this->accountModel->getId() . '))');
    } else {
      $saleOrderModelAdapter->where('account_id = ?', $this->accountModel->getId());
    }
    $dataGridView = new Saleorder_DataGridView();
    $panel = new Amhsoft_Widget_Panel(_t('Related Sales Order'));
    $saleOrderModelAdapter->fetch();
    $dataGridView->DataSource = new Amhsoft_Data_Set($saleOrderModelAdapter);
    $panel->addComponent($dataGridView);
    $addNewSaleorderLink = new Amhsoft_Link_Control(_t('Add New Saleorder'), 'admin.php?module=saleorder&page=saleorder-add&account_id=' . $this->accountModel->getId());
    $addNewSaleorderLink->setClass('add');
    $panel->addComponent($addNewSaleorderLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadQuotationDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Quotation')) {
      return;
    }
    $quotationModelAdapter = new Quotation_Model_Adapter();
    $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $_var = $accountConfiguration->getValue('fetch_related_contacts_data');
    if ($_var) {
      $quotationModelAdapter->where('(account_id = ' . $this->accountModel->getId() . ' OR contact_id IN (SELECT id FROM contact where account_id = ' . $this->accountModel->getId() . '))');
    } else {
      $quotationModelAdapter->where('account_id = ?', $this->accountModel->getId());
    }
    $dataGridView = new Quotation_DataGridView();
    $panel = new Amhsoft_Widget_Panel(_t('Related Quotations'));
    $dataGridView->DataSource = new Amhsoft_Data_Set($quotationModelAdapter);
    $panel->addComponent($dataGridView);
    $addNewQuotationLink = new Amhsoft_Link_Control(_t('Add New Quotation'), 'admin.php?module=quotation&page=quotation-add&account_id=' . $this->accountModel->getId());
    $addNewQuotationLink->setClass('add');
    $panel->addComponent($addNewQuotationLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadWebailDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Webmail')) {
      return;
    }
    $adapter = new Webmail_Email_Model_Adapter();
    $id = $this->accountModel->getId();
    $adapter->setPreDefinedSelectStatement("SELECT * FROM webmail_email WHERE id IN(SELECT webmail_email_id FROM account_has_email WHERE crm_account_id = $id) OR id IN (SELECT webmail_email_id FROM contact_has_email WHERE crm_contact_id IN(SELECT id FROM contact WHERE account_id = $id))");
    $dataGridView = new Webmail_Email_DataGridView();
    $dataGridView->Searchable = false;
    $dataGridView->Sortable = false;
    $panel = new Amhsoft_Widget_Panel(_t('Related Emails'));
    $data = $adapter->fetch();
    $dataGridView->DataSource = new Amhsoft_Data_Set($data);
    $addNewEmailLink = new Amhsoft_Link_Control(_t('Add New Email'), 'admin.php?module=webmail&page=email-add&target=account&targetid=' . $this->accountModel->getId() . '&to=' . $this->accountModel->getEmail());
    $addNewEmailLink->setClass('add');
    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewEmailLink);
    $this->accountPanel->addComponent($panel);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->loaddAddressBookGrid();
    $this->loadOpportunityDataGridView();
    $this->loadQuotationDataGridView();
    $this->loadSaleOrderDataGridView();
    $this->loadInvoiceDataGridView();
    $this->loadTickets();
    $this->addDocumentGrid();
    $this->loadTasks();
    $this->loadTaskHistories();
    $this->loadProcessesGrid();
    $this->loadWebailDataGridView();
  }

  protected function handleSelectedContact() {
    $contact_id = Amhsoft_Registry::get('selected_contact_id');
    if ($contact_id > 0) {
      $this->saveContact($contact_id);
    }
  }

  protected function saveContact($id) {
    $contactModelAdapter = new Crm_Contact_Model_Adapter();
    $contactModel = $contactModelAdapter->fetchById($id);
    if ($contactModel instanceof Crm_Contact_Model) {
      $contactModel->account_id = $this->accountModel->getId();
      $contactModelAdapter->save($contactModel);
      Amhsoft_Registry::destroy("selected_contact_id");
      $this->getView()->setMessage(_t('Account was successufully assigned to this account'), View_Message_Type::SUCCESS);
    } else {
      $this->getView()->setMessage(_t('Cannot assign this contact'), View_Message_Type::ERROR);
    }
  }

  /**
   * Delete event
   */
  public function __delete() {
    Amhsoft_Database::getInstance()->exec("UPDATE contact SET account_id = null where id = " . $this->getRequest()->getInt('contact_id'));
    $this->getRedirector()->go('?module=crm&page=account-detail&id=' . $this->accountModel->getId() . '&ret=true');
  }

  protected function loadContactsDataGridView() {
    $panel = new Amhsoft_Widget_Panel(_t('Related Contacts'));
    $dataGridView = new Crm_Contact_DataGridView();
    $dataGridView->Searchable = false;
    $dataGridView->Sortable = false;
    $adapter = new Crm_Contact_Model_Adapter();
    $adapter->where('account_id = ?', $this->accountModel->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $dataGridView->removeByIdentName('del');
    $delCol = new Amhsoft_Link_Control(_t('Unassign'), '?module=crm&page=account-detail&event=delete&id=' . $this->accountModel->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'contact_id';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $dataGridView->removeByIdentName('delete');
    $addNewContactLink = new Amhsoft_Link_Control(_t('Add New Contact'), 'admin.php?module=crm&page=contact-quicklist&refresh=true');
    $addNewContactLink->setClass('add');
    $addNewContactLink->onClickOpenInPopUp('640', '480');
    $dataGridView->AddColumn($delCol);
    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewContactLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadOpportunityDataGridView() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Opportunity')) {
      return;
    }
    $opportunityModelAdapter = new Opportunity_Opportunity_Model_Adapter();
    $opportunityModelAdapter->where('account_id = ?', $this->accountModel->getId());
    $dataGridView = new Opportunity_Opportunity_DataGridView();
    $dataGridView->Sortable = false;
    $dataGridView->Searchable = false;
    $dataGridView->setWithPagination(false);
    $panel = new Amhsoft_Widget_Panel(_t('Related Opportunity'));
    $opportunityModelAdapter->fetch();
    $dataGridView->DataSource = new Amhsoft_Data_Set($opportunityModelAdapter);
    $panel->addComponent($dataGridView);
    $addNewSaleorderLink = new Amhsoft_Link_Control(_t('Add New Opportunity'), 'admin.php?module=opportunity&page=opportunity-add&account_id=' . $this->accountModel->getId());
    $addNewSaleorderLink->setClass('add');
    $panel->addComponent($addNewSaleorderLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loadProcessesGrid() {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled('Bpm')) {
      return;
    }
    $dataGridView = Modules_Bpm_Backend_Boot::getProcessDataGridView('Crm_Account_Model', $this->accountModel->getId());
    $panel = new Amhsoft_Widget_Panel(_t('Related Processes'));
    $addNewAddressLink = new Amhsoft_Link_Control(_t('Create Process'), 'admin.php?module=bpm&page=circulation-add&entity=Crm_Account_Model&entity_id=' . $this->accountModel->getId() . '&entity_label=' . $this->accountModel->getName());
    $addNewAddressLink->setClass('add');
    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewAddressLink);
    $this->accountPanel->addComponent($panel);
  }

  public function loaddAddressBookGrid() {
    $panel = new Amhsoft_Widget_Panel(_t('Address Book'));
    $dataGridView = new Amhsoft_Widget_DataGridView(array('name' => _t('Name'), 'street' => _t('Street'), 'city' => _t('City'), 'country' => _t('Country')));
    $dataGridView->DataSource = new Amhsoft_Data_Set($this->accountModel->getAddresses());
    $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=crm&page=account-address-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=crm&page=account-address-delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $dataGridView->AddColumn($editCol);
    $dataGridView->AddColumn($delCol);
    $addNewAddressLink = new Amhsoft_Link_Control(_t('Add New Address'), 'admin.php?module=crm&page=account-address-add&acc_id=' . $this->accountModel->getId());
    $addNewAddressLink->setClass('add');
    $panel->addComponent($dataGridView);
    $panel->addComponent($addNewAddressLink);
    $this->accountPanel->addComponent($panel);
  }

  /**
   * Vcard event
   */
  public function __vcard() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $accountModelAdapter = new Crm_Account_Model_Adapter();
    $accountModel = $accountModelAdapter->fetchById($id);
    if (!$accountModel instanceof Crm_Account_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $v = new Amhsoft_VCard();

    $v->setPhoneNumber($accountModel->getTelefon(), "WORK");
    $v->setName("", $accountModel->getName(), "", "");
    $v->setAddress("", "", $accountModel->getStreet(), $accountModel->getCity(), "", $accountModel->getZipcode(), $accountModel->getCountry(), "HOME");
    $v->setEmail($accountModel->getEmail());
    $v->setNote("Account Number:" . $accountModel->getNumber());
    $output = $v->getVCard();
    $filename = $v->getFileName();
    Header("Content-Disposition: attachment; filename=$filename");
    Header("Content-Length: " . strlen($output));
    Header("Connection: close");
    header('Content-Type: text/x-vcard; charset=utf-8');
    echo $output;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->accountPanel->setDataSource(new Amhsoft_Data_Set($this->accountModel));
    $this->accountPanel->Bind();
    $this->getView()->assign('panel', $this->accountPanel);
    $this->show();
  }

}

?>
