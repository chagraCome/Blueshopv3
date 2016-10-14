<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 395 2016-02-11 09:09:30Z amira.amhsoft $
 * $Rev: 395 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-11 10:09:30 +0100 (jeu., 11 févr. 2016) $
 * $LastChangedDate: 2016-02-11 10:09:30 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

class Crm_Backend_Contact_Detail_Controller extends Amhsoft_System_Web_Controller {
    /**
     * Description of detail
     *
     * @author cherif
     */

    /** @var Crm_Contact_Panel $contactPanel */
    protected $contactPanel;

    /** @var Crm_Contact_Model $contactModel */
    protected $contactModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id < 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->contactPanel = new Crm_Contact_Panel();
        $contactModelAdapter = new Crm_Contact_Model_Adapter();
        $this->contactModel = $contactModelAdapter->fetchById($id);

        if (!$this->contactModel instanceof Crm_Contact_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->getView()->assign('account_id', $this->contactModel->account_id); // to avoid convert to account
        $this->getView()->setMessage(_t('Contact Details'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->loadWebailDataGridView();
        $this->addDocumentGrid();
    }

    public function loadWebailDataGridView() {
        if (!Amhsoft_System_Module_Manager::isModuleInstalled('Webmail')) {
            return;
        }
        $adapter = new Webmail_Email_Model_Adapter();
        $adapter->leftJoinWithoutCardinality('contact_has_email', 'id', 'webmail_email_id');
        $adapter->leftJoinWithoutCardinality("contact", "contact_has_email.crm_contact_id", 'contact.id');
        $adapter->where('contact_has_email.crm_contact_id = ' . $this->contactModel->getId());
        $dataGridView = new Webmail_Email_DataGridView();
        $dataGridView->Searchable = false;
        $dataGridView->Sortable = false;
        $panel = new Amhsoft_Widget_Panel(_t('Related Emails'));
        $data = $adapter->fetch();
        $dataGridView->DataSource = new Amhsoft_Data_Set($data);
        $addNewEmailLink = new Amhsoft_Link_Control(_t('Add New Email'), 'admin.php?module=webmail&page=email-add&target=contact&targetid=' . $this->contactModel->getId() . '&to=' . $this->contactModel->getEmail());
        $addNewEmailLink->setClass('add');
        $panel->addComponent($dataGridView);
        $panel->addComponent($addNewEmailLink);
        $this->contactPanel->addComponent($panel);
    }

    protected function addDocumentGrid() {
        $panel = new Amhsoft_Widget_Panel(_t('Related Documents'));
        $documentDataGridView = new Crm_Contact_Document_DataGridView();
        $contactEmail = $this->contactModel->getEmail();
        $documentDataGridView->mailLinkCol->Href = 'admin.php?module=webmail&page=email-add&target=contact&targetid=' . $this->contactModel->getId() . '&to=' . $contactEmail . '&acc_id=' . $this->contactModel->id;
        $documentDataGridView->DataSource = new Amhsoft_Data_Set($this->contactModel->getDocuments());
        $addDocumentUrl = new Amhsoft_Link_Control(_t('Add new Document'), 'admin.php?module=crm&page=contact-document-add&contact_id=' . $this->getRequest()->getId());
        $addDocumentUrl->Class = 'add';
        $genDocument = new Amhsoft_Link_Control(_t('Generate PDF'), 'admin.php?module=crm&page=contact-document-generate&id=' . $this->getRequest()->getId());
        $genDocument->Class = 'print';
        $panelButtons = new Amhsoft_Widget_Panel();
        $panelButtons->setLayout(new Amhsoft_Grid_Layout(2));
        $panelButtons->addComponent($addDocumentUrl)->addComponent($genDocument);
        $panel->addComponent($documentDataGridView);
        $panel->addComponent($panelButtons);
        $this->contactPanel->addComponent($panel);
    }

    /**
     * Convert event
     */
    public function __convert() {
        $account = $this->contactModel->convertToAccount();
        if ($account instanceof Crm_Account_Model) {
            $this->getRedirector()->go('?module=crm&page=account-modify&id=' . $account->getId());
        } else {
            $this->getView()->setMessage(_t('Failed to convert this contact'), View_Message_Type::ERROR);
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->contactPanel->setDataSource(new Amhsoft_Data_Set($this->contactModel));
        $this->contactPanel->Bind();
        $this->getView()->assign('panel', $this->contactPanel);
        $this->show();
    }

}

?>
