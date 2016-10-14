<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Setting_Backend_Template_Email_Quicklist_Controller extends Amhsoft_System_Web_Controller {

    /** @var Setting_EmailTemplate_DataGridView $emailTemplateDataGridView */
    protected $emailTemplateDataGridView;

    /** @var Setting_EmailTemplate_Model_Adapter $emailTemplateModelAdapter */
    protected $emailTemplateModelAdapter;
    protected $target;
    protected $target_id;

    /**
     * Initialize Controller
     */
    public function __initialize() {

        $this->emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
        $this->emailTemplateDataGridView = new Amhsoft_Widget_DataGridView();
        $this->target = $this->getRequest()->get('target');
        $this->target_id = $this->getRequest()->getInt('target_id');
        $nameCol = new Amhsoft_Link_Control(_t('Template Name'), 'admin.php?module=setting&page=template-email-quicklist&event=select&target_id=' . $this->target_id . '&target=' . $this->target);
        $nameCol->DisplayValue = 'name';
        $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
        $subjectCol = new Amhsoft_Label_Control(_t('Template Subject'), new Amhsoft_Data_Binding('subject'));
        $this->emailTemplateDataGridView->addColum($nameCol);
        $this->emailTemplateDataGridView->addColum($subjectCol);
        $this->emailTemplateDataGridView->Sortable = true;
        $this->emailTemplateDataGridView->Searchable = true;
        $this->emailTemplateDataGridView->performSort($this->getRequest(), $this->emailTemplateModelAdapter);
        $this->emailTemplateDataGridView->performSearch($this->getRequest(), $this->emailTemplateModelAdapter);
        $this->emailTemplateDataGridView->setWithPagination(true);
        $this->emailTemplateDataGridView->addSearcField('text');
        $this->emailTemplateDataGridView->addSearcField('text');
        $this->getView()->setMessage(_t('List email templates'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->emailTemplateDataGridView->performSort($this->getRequest(), $this->emailTemplateModelAdapter);
        $this->emailTemplateDataGridView->performSearch($this->getRequest(), $this->emailTemplateModelAdapter);
    }

    /**
     * Select Template Event
     */
    public function __select() {
        $id = $this->getRequest()->getId();
        $target = $this->getRequest()->get('target');
        $target_id = $this->getRequest()->getInt('target_id');
        $emailTemplateAdapter = new Setting_Template_Email_Model_Adapter();
        $emailTemplate = $emailTemplateAdapter->fetchById($id);
        $string = '';
        if ($id > 0 && $target_id > 0) {
            if ($target == 'account' && Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $account = $accountModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($account));
            } elseif ($target == 'contact' && Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
                $contactModelAdapter = new Crm_Contact_Model_Adapter();
                $contact = $contactModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($contact));
            } elseif ($target == 'lead' && Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
                $leadModelAdapter = new Crm_Lead_Model_Adapter();
                $lead = $leadModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($lead));
            } elseif ($target == 'quotation' && Amhsoft_System_Module_Manager::isModuleInstalled('Quotation')) {
                $quotationModelAdapter = new Quotation_Model_Adapter();
                $quotation = $quotationModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($quotation));
            } elseif ($target == 'saleorder' && Amhsoft_System_Module_Manager::isModuleInstalled('Saleorder')) {
                $saleOrderModelAdapter = new Saleorder_Model_Adapter();
                $saleOrder = $saleOrderModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($saleOrder));
            } elseif ($target == 'invoice' && Amhsoft_System_Module_Manager::isModuleInstalled('Invoice')) {
                $invoiceModelAdapter = new Invoice_Model_Adapter();
                $invoice = $invoiceModelAdapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($invoice));
            } elseif ($target == 'coupon' && Amhsoft_System_Module_Manager::isModuleInstalled('Coupon')) {
                $coupon_Code_Model_Adapter = new Coupon_Code_Model_Adapter();
                $coupon = $coupon_Code_Model_Adapter->fetchById($target_id);
                $string = $emailTemplate->getFilledContent(array($coupon));
            }
            $string = str_replace('"', "'", $string);
            $string = str_replace("\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\t", "", $string);
            $string = addslashes($string);
            $this->close(array('subject' => addslashes($emailTemplate->getSubject()), 'content' => $string));
        } else {
            $string = $emailTemplate->getContent();
            $string = str_replace('"', "'", $string);
            $string = str_replace("\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\t", "", $string);
            $this->close(array('subject' => addslashes($emailTemplate->getSubject()), 'content' => $string));
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $projects = $this->emailTemplateModelAdapter->fetch();
        $this->emailTemplateDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->emailTemplateDataGridView);
        $this->popup();
    }

}

?>