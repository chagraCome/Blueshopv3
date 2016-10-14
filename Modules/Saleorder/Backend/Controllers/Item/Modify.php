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

class Saleorder_Backend_Item_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderItemForm $saleOrderItemForm */
    protected $saleOrderItemForm;

    /** @var SaleOrderItemModel $saleOrderItemModel */
    protected $saleOrderItemModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderItemForm = new Saleorder_Item_Form('project_form', 'POST');
        $this->getView()->setMessage(_t('Edit Sales Order Item'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
            $this->saleOrderItemModel = $saleOrderItemModelAdapter->fetchById($id);
        }
        if (!$this->saleOrderItemModel instanceof Saleorder_Item_Model) {
            die('Requested Item not found');
        }
        $this->saleOrderItemForm->DataSource = new Amhsoft_Data_Set($this->saleOrderItemModel);
        $this->saleOrderItemForm->Bind();
    }

    /**
     * Default event
     */
    public function __default() {

        if ($this->saleOrderItemForm->isSend()) {
            $this->saleOrderItemForm->DataSource = Amhsoft_Data_Source::Post();
            $this->saleOrderItemForm->Bind();
            if ($this->saleOrderItemForm->isValid()) {
                $this->saleOrderItemForm->DataBinding = new Saleorder_Item_Model();
                $saleOrderItemModel = $this->saleOrderItemForm->getDataBindItem();
                $saleOrderItemModel->id = $this->saleOrderItemModel->id;
                $saleOrderItemModel->item_id = $this->saleOrderItemModel->item_id;

                if (intval($this->saleOrderItemModel->item_id) <= 0) { //no product related
                    $this->saveAndRecalculatePrices($saleOrderItemModel);
                    $this->close();
                    return;
                }


                // ftech product
                $productModelAdapter = new Product_Product_Model_Adapter();
                $productModel = $productModelAdapter->fetchById($this->saleOrderItemModel->item_id);


                if (!$productModel instanceof Product_Product_Model) {
                    // qunatity not changed save and recalculate prices
                    $this->saveAndRecalculatePrices($saleOrderItemModel);
                    $this->close();
                    return;
                }

                //checking if manage stock is enabled
                if (!Product_Product_Model::isManageStockEnabled($this->saleOrderItemModel->item_id)) {
                    $this->saveAndRecalculatePrices($saleOrderItemModel);
                    $this->close();
                }
                //trying handle item
                try {

                    //getting old quantity and new quantity if changed
                    $neededQuantity = $saleOrderItemModel->getQuantity();
                    $oldNeededQuantity = $this->saleOrderItemModel->getQuantity();
                    $realNeededQuantity = $neededQuantity - $oldNeededQuantity;

                    if ($realNeededQuantity == 0) { // no quantity changes
                        $this->saveAndRecalculatePrices($saleOrderItemModel);
                        $this->close();
                        return;
                    }

                    // if real quantity greater than 0 we must decrement from product quantity
                    if ($realNeededQuantity > 0) {
                        //by adding product to cart with quntity it will help us to catch exception 
                        $cart = new Cart_Shoppingcart_Model();
                        $cart->addProduct($productModel, $realNeededQuantity);
                        Product_Product_Model::liveDecrementQuantity(Amhsoft_Database::getInstance(), $productModel->getId(), $realNeededQuantity);
                    } else {
                        Product_Product_Model::liveIncrementQuantity(Amhsoft_Database::getInstance(), $productModel->getId(), $realNeededQuantity);
                    }


                    $this->saveAndRecalculatePrices($saleOrderItemModel);

                    $this->close();
                } catch (Exception $globalException) {
                    $this->getView()->setMessage($globalException->getMessage(), View_Message_Type::ERROR);
                }
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    protected function saveAndRecalculatePrices(Saleorder_Item_Model $saleOrderItemModel) {
        $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
        $saleOrderItemModel->reCalculatePrices();
        $saleOrderItemModel->sale_order_id = $this->saleOrderItemModel->sale_order_id;
        $saleOrderItemModelAdapter->save($saleOrderItemModel);
        $saleOrderId = $saleOrderItemModel->sale_order_id;
        $saleOrderItemModel->recalculatePricesForsaleOrder($saleOrderId);
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
