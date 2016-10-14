<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Shipping.php 449 2016-02-23 08:14:06Z imen.amhsoft $
 * $Rev: 449 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $LastChangedDate: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Backend_Product_Shipping_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_Panel $panelShipping */
    protected $panelShipping;

    /** @var Product_Product_Model $productModel */
    protected $productModel;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->panelShipping = new Amhsoft_Widget_Panel();
        $id = $this->getRequest()->getInt('id');
        if ($id < 0) {
            new Amhsoft_Item_Not_Found_Exception();
        }
        $productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModel = $productModelAdapter->fetchById($id);
        if (!$this->productModel instanceof Product_Product_Model) {
            new Amhsoft_Item_Not_Found_Exception();
        }
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getView()->setMessage(_t('Manage Shipping Options'), View_Message_Type::INFO);
        if ($this->getRequest()->isPost('save_global')) {
            $shipping_ids = $this->getRequest()->postInts('shipping_id');
            $transaction = Amhsoft_Database::getInstance();
            $transaction->beginTransaction();
            try {
                $transaction->exec("DELETE FROM product_has_shipping WHERE product_id = " . $this->productModel->getId());
                foreach ($shipping_ids as $shipping_id) {
                    $transaction->exec("INSERT INTO product_has_shipping VALUES(" . $this->productModel->getId() . ", " . $shipping_id . ")");
                }
                $transaction->commit();
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            } catch (Exception $e) {
                $transaction->rollBack();
                $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
            }
        }
        if ($this->getRequest()->isPost('submit_next')) {
            $this->getRedirector()->go('admin.php?module=product&page=product-marketing&id=' . $this->productModel->getId());
        }
        if ($this->getRequest()->isPost('submit_back')) {
            $this->getRedirector()->go('admin.php?module=product&page=product-payment&id=' . $this->productModel->getId());
        }
        $this->setGlobalShippingOptionsPanel();
    }

    /**
     * Set Shipping Option Panel
     */
    protected function setGlobalShippingOptionsPanel() {
        $form = new Amhsoft_Widget_Form('shipping_form', 'post');
        $panelShipping = new Amhsoft_Widget_Panel(_t('Allowed Shipping methods'));
        $headers = array('shipping_id' => 'c', 'title' => _t('Shipping Method'));
        $dataGridView = new Amhsoft_Widget_DataGridView($headers);
        $ds = new Shipping_Shipping_Model_Adapter();
        $ds->select('id as shipping_id');
        $ds->select('title');
        $dataGridView->DataSource = new Amhsoft_Data_Set($ds);
        $dataGridView->setCheckedLines($this->productModel->getEnabledShippingMethods());
        $panelShipping->addComponent($dataGridView);
        $submitButton = new Amhsoft_Button_Submit_Control('save_global', _t('Apply Changes'));
        $submitButton->setClass('ButtonSave');
        $panelShipping->addComponent($submitButton);
        $form->addComponent($panelShipping);
        $this->panelShipping->addComponent($form);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->panelShipping);
        $this->getView()->assign('product', $this->productModel);
        $this->show();
    }

}

?>
