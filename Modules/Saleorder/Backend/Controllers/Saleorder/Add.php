<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_Saleorder_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Saleorder_Form $SaleOrderForm */
    protected $SaleOrderForm;

    /** @var Saleorder_Model $SaleOrderModel */
    protected $SaleOrderModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->SaleOrderForm = new Saleorder_Form('saleOrderForm_form', 'POST');
        $this->SaleOrderModel = new Saleorder_Model();
        $saleOrderConf = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);

        $this->SaleOrderModel->sale_order_state_id = Saleorder_State_Model::CREATED;
        $this->SaleOrderForm->numberInput->Value = $this->SaleOrderModel->getNextSaleOrderNumber();
        $this->SaleOrderForm->policyTextArea->Value = $saleOrderConf->getValue('sale_order_policy');
        if ($this->getRequest()->getInt('account_id') > 0) {
            $accountModelAdapter = new Crm_Account_Model_Adapter();
            $accountModel = $accountModelAdapter->fetchById($this->getRequest()->getInt('account_id'));
            if ($accountModel instanceof Crm_Account_Model) {
                $this->SaleOrderForm->personListBox->Value = $accountModel;
            }
        }
        $this->getView()->setMessage(_t('Create new Sales Order'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->SaleOrderForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->SaleOrderForm->isSend()) {
            if ($this->SaleOrderForm->isValid()) {
                $this->SaleOrderForm->DataBinding = $this->SaleOrderModel;
                $saleOrderModelAdapter = new Saleorder_Model_Adapter();
                $this->SaleOrderModel = $this->SaleOrderForm->getDataBindItem();
                $this->SaleOrderModel->setInsertAt(Amhsoft_Locale::DateTime());
                $this->SaleOrderModel->account_id = ($this->getRequest()->postInt('account_id')) ? ($this->getRequest()->postInt('account_id')) : null;
                $this->SaleOrderModel->updateat = Amhsoft_Locale::DateTime();
                $this->SaleOrderModel->shipping_method_name = Shipping_Shipping_Model::getNameById($this->SaleOrderModel->shipping_id);
                $this->SaleOrderModel->payment_method_name = Payment_Payment_Model::getNameById($this->SaleOrderModel->payment_id);
                $account = null;
                if ($this->SaleOrderModel->account_id > 0) {
                    $account = Crm_Account_Model::byId($this->SaleOrderModel->account_id);
                }
                if ($account instanceof Crm_Account_Model) {
                    /** @var Crm_Account_Model $account */
                    $this->SaleOrderModel->account_name = $account->name;
                    $this->SaleOrderModel->account_email = $account->getEmail();
                    $this->SaleOrderModel->account_mobile = $account->mobile;
                    $addresses = $account->getAddresses();

                    if (!empty($addresses)) {
                        $saleOrderAddresModel = new Saleorder_Address_Model();
                        $saleOrderAddresModel->copyFrom($addresses[0]);
                        $adapter = new Saleorder_Address_Model_Adapter();
                        $adapter->save($saleOrderAddresModel);


                        $this->SaleOrderModel->shippingAddress = $saleOrderAddresModel;
                        $this->SaleOrderModel->invoiceAddress = $saleOrderAddresModel;
                    }
                }
                $this->SaleOrderModel->creator_name = Amhsoft_Authentication::getInstance()->getObject()->getFullName();
                $this->SaleOrderModel->setCurrency(Amhsoft_Locale::getCurrencyIso3());
                $this->SaleOrderModel->setBaseCurrency(Amhsoft_System_Config::getProperty('base_currency'));
                $currencySetModelAdapter = new Setting_Local_Model_Adapter();
                $currency_set_id = $currencySetModelAdapter->getLastLocalId();
                $this->SaleOrderModel->setCurrencySetId($currency_set_id);

                $saleOrderModelAdapter->save($this->SaleOrderModel);
                $this->handleSuccess();
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    /**
     * Handle success.
     */
    protected function handleSuccess() {

        $this->getView()->setMessage(_t('Sales Order was successully added'), View_Message_Type::SUCCESS);
        $this->getRedirector()->go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->SaleOrderModel->getId());
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->SaleOrderForm);
        $this->show();
    }

}

?>
