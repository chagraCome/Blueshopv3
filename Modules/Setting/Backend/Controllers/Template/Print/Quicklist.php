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

class Setting_Backend_Template_Print_Quicklist_Controller extends Amhsoft_System_Web_Controller {

    protected $printTemplateDataGridView;
    protected $printTemplateModelAdapter;
    protected $target;
    protected $target_id;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->printTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
        $this->printTemplateDataGridView = new Amhsoft_Widget_DataGridView();
        $this->target = $this->getRequest()->get('target');
        $this->target_id = $this->getRequest()->getInt('target_id');
        $nameCol = new Amhsoft_Link_Control(_t('Template Name'), 'admin.php?module=setting&page=template-print-quicklist&event=select&target_id=' . $this->target_id . '&target=' . $this->target);
        $nameCol->DisplayValue = 'name';
        $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'name');
        $this->printTemplateDataGridView->addColum($nameCol);
        $this->printTemplateDataGridView->Sortable = true;
        $this->printTemplateDataGridView->Searchable = true;
        $this->printTemplateDataGridView->performSort($this->getRequest(), $this->printTemplateModelAdapter);
        $this->printTemplateDataGridView->performSearch($this->getRequest(), $this->printTemplateModelAdapter);
        $this->printTemplateDataGridView->setWithPagination(true);
        $this->printTemplateDataGridView->addSearcField('text');
        $this->printTemplateDataGridView->addSearcField('text');
        $this->getView()->setMessage(_t('List print templates'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->printTemplateDataGridView->performSort($this->getRequest(), $this->printTemplateModelAdapter);
        $this->printTemplateDataGridView->performSearch($this->getRequest(), $this->printTemplateModelAdapter);
    }

    /**
     * Select Template Event
     */
    public function __select() {
        $id = $this->getRequest()->getId();
        $target = $this->getRequest()->get('target');
        $target_id = $this->getRequest()->getInt('target_id');
        $printTemplateAdapter = new Setting_Template_Print_Model_Adapter();
        $printTemplate = $printTemplateAdapter->fetchById($id);
        $string = '';
        if ($id > 0 && $target_id > 0) {
            if ($target == 'account' && Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $account = $accountModelAdapter->fetchById($target_id);
                $string = $printTemplate->getFilledContent(array($account));
            } elseif ($target == 'quotation' && Amhsoft_System_Module_Manager::isModuleInstalled('Quotation')) {
                $quotationModelAdapter = new Quotation_Model_Adapter();
                $quotation = $quotationModelAdapter->fetchById($target_id);
                $string = $printTemplate->getFilledContent(array($quotation));
            } elseif ($target == 'saleorder' && Amhsoft_System_Module_Manager::isModuleInstalled('Saleorder')) {
                $saleOrderModelAdapter = new Saleorder_Model_Adapter();
                $saleOrder = $saleOrderModelAdapter->fetchById($target_id);
                $string = $printTemplate->getFilledContent(array($saleOrder));
            } elseif ($target == 'invoice' && Amhsoft_System_Module_Manager::isModuleInstalled('Invoice')) {
                $invoiceModelAdapter = new Invoice_Model_Adapter();
                $invoice = $invoiceModelAdapter->fetchById($target_id);
                $string = $printTemplate->getFilledContent(array($invoice));
            } elseif ($target == 'coupon' && Amhsoft_System_Module_Manager::isModuleInstalled('Coupon')) {
                $coupon_Code_Model_Adapter = new Coupon_Code_Model_Adapter();
                $coupon = $coupon_Code_Model_Adapter->fetchById($target_id);
                $string = $printTemplate->getFilledContent(array($coupon));
            }
            $string = str_replace('"', "'", $string);
            $string = str_replace("\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\t", "", $string);
            Amhsoft_Registry::register('print_template_id', $printTemplate->getId());
            $this->close(array('content' => $string));
        } else {
            $string = $printTemplate->getContent();
            $string = str_replace('"', "'", $string);
            $string = str_replace("\n", "", $string);
            $string = str_replace("\r", "", $string);
            $string = str_replace("\t", "", $string);
            $this->close(array('content' => $string));
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $projects = $this->printTemplateModelAdapter->fetch();
        $this->printTemplateDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->printTemplateDataGridView);
        $this->popup();
    }

}
?>