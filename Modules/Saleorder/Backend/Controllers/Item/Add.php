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

class Saleorder_Backend_Item_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderItemForm $saleOrderItemForm */
    protected $saleOrderItemForm;

    /** @var SaleOrderItemModel $saleOrderItemModel */
    protected $saleOrderItemModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderItemForm = new Saleorder_Item_Form('saleOrderItemForm_form', 'POST');
        $this->saleOrderItemModel = new Saleorder_Item_Model();
        $salesOrderId = $this->getRequest()->getInt('sale_order_id');
        if ($salesOrderId > 0) {
            $this->saleOrderItemModel->sale_order_id = $salesOrderId;
        } else {
            die('Sales Order Not found!');
        }


        $this->getView()->setMessage(_t('Create new Sales Order Item'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->saleOrderItemForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->saleOrderItemForm->isSend()) {
            if ($this->saleOrderItemForm->isValid()) {
                $this->saleOrderItemForm->DataBinding = $this->saleOrderItemModel;
                $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
                $this->saleOrderItemModel = $this->saleOrderItemForm->getDataBindItem();
                $this->saleOrderItemModel->setSubTotal(($this->saleOrderItemModel->getUnitPrice() - $this->saleOrderItemModel->getAmountDiscount()) * $this->saleOrderItemModel->getQuantity());
                $this->saleOrderItemModel->reCalculatePrices();
                $saleOrderItemModelAdapter->save($this->saleOrderItemModel);
                Saleorder_Model::reCalculateAnsSavePricesId($this->saleOrderItemModel->sale_order_id);
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
        $this->getView()->setMessage(_t('Sales Order Item was successully added'), View_Message_Type::SUCCESS);
        $this->close();
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->saleOrderItemForm);
        $this->popup();
    }

}

?>
