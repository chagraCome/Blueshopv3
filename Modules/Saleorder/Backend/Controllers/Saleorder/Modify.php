<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_Saleorder_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderForm $saleOrderForm */
    protected $saleOrderForm;

    /** @var Saleorder_Model $saleOrderModel */
    protected $saleOrderModel;
    protected $saleOrderModelAdapter;
    protected $oldSaleOrderState;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderForm = new Saleorder_Form('saleOrderForm_form', 'POST');
        $this->getView()->setMessage(_t('Edit Sales Order'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $this->saleOrderModel = $this->saleOrderModelAdapter->fetchById($id);
            $this->oldSaleOrderState = $this->saleOrderModel->sale_order_state_id;
        }
        if (!$this->saleOrderModel instanceof Saleorder_Model) {
            Amhsoft_Log::error('modify saleorder error while sale order model not found requested id ' . $id, array($this->saleOrderModel));
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->saleOrderForm->DataSource = new Amhsoft_Data_Set($this->saleOrderModel);
        $this->saleOrderForm->Bind();

        if ($this->saleOrderModel->saleOrderState == null) {
            $this->saleOrderModel->saleOrderState = new Saleorder_State_Model();
        }
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->saleOrderForm->isSend()) {
            $this->saleOrderForm->DataSource = Amhsoft_Data_Source::Post();
            $this->saleOrderForm->Bind();
            if ($this->saleOrderForm->isValid()) {
                $this->saleOrderForm->DataBinding = $this->saleOrderModel;
                $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
                $oldAccountID = $this->saleOrderModel->account_id;
                $this->saleOrderModel = $this->saleOrderForm->getDataBindItem();
                $this->saleOrderModel->updateat = Amhsoft_Locale::DateTime();

                if ($oldAccountID != $this->getRequest()->postInt('account_id')) {
                    $this->saleOrderModel->account_id = $this->getRequest()->postInt('account_id');
                    $account = Crm_Account_Model::byId($this->saleOrderModel->account_id);

                    $this->saleOrderModel->account_name = $account->name;
                    $this->saleOrderModel->account_email = $account->getEmail();
                    $this->saleOrderModel->account_mobile = $account->mobile;

                    $addresses = $account->getAddresses();

                    if (!empty($addresses)) {

                        $saleOrderAddresModel = new Saleorder_Address_Model();
                        $saleOrderAddresModel->copyFrom($addresses[0]);
                        $adapter = new Saleorder_Address_Model_Adapter();
                        $adapter->save($saleOrderAddresModel);


                        $this->saleOrderModel->shippingAddress = $saleOrderAddresModel;
                        $this->saleOrderModel->invoiceAddress = $saleOrderAddresModel;
                    }
                }
                $this->saleOrderModel->updateat = Amhsoft_Locale::DateTime();
                $this->saleOrderModel->shipping_method_name = Shipping_Shipping_Model::getNameById($this->saleOrderModel->shipping_id);
                $this->saleOrderModel->payment_method_name = Payment_Payment_Model::getNameById($this->saleOrderModel->payment_id);
                $this->saleOrderModel->creator_name = Amhsoft_Authentication::getInstance()->getObject()->username;
                $this->saleOrderModel->reCalculatePrices();
                $this->saleOrderModelAdapter->save($this->saleOrderModel);
                if ($this->saleOrderModel->sale_order_state_id != $this->oldSaleOrderState) {
                    Amhsoft_Event_Handler::trigger('saleorder.state.changed', $this, array($this->saleOrderModel));
                }
                $this->getRedirector()->go('admin.php?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->saleOrderForm);
        $this->show();
    }

}

?>
