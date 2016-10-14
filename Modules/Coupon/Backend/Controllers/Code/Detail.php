<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of datail
 *
 * @author cherif
 */
class Coupon_Backend_Code_Detail_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Code_Model $couponCodeModel */
    public $couponCodeModel;
    public $couponCodePanel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        $this->couponCodePanel = new Amhsoft_Widget_Panel();
        if ($id > 0) {
            $couponCodeModelAdapter = new Coupon_Code_Model_Adapter();
            $this->couponCodeModel = $couponCodeModelAdapter->fetchById($id);
            if (!$this->couponCodeModel instanceof Coupon_Code_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $couponCodePanel = new Coupon_Code_Panel(_t('Coupon Details'));
        $this->couponCodePanel->addComponent($couponCodePanel);
        $this->getView()->setMessage(_t('Coupon Code Details'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->loadCouponData();
        $this->loadCouponTemplate();
    }

    public function loadCouponTemplate() {
        if (!@file_exists("media/coupons/" . $this->couponCodeModel->getId() . ".jpg")) {
            $this->couponCodeModel->generateImage();
        }

        $panel = new Amhsoft_Widget_Panel(_t('Coupon Template'));
        $png = new Amhsoft_Html_Control('<img src="media/coupons/' . $this->couponCodeModel->getId() . '.jpg"/>');
        $panel->addComponent($png);

        $addNewEmailLink = new Amhsoft_Link_Control(_t('Send Email'), 'admin.php?module=webmail&page=email-add&target=coupon&targetid=' . $this->couponCodeModel->getId() . "&docid=media/coupons/" . $this->couponCodeModel->getId() . ".jpg");
        $addNewEmailLink->setClass('add');

        $this->couponCodePanel->addComponent($panel);
        $this->couponCodePanel->addComponent($addNewEmailLink);
    }

    public function loadCouponData() {
        $couponPanel = new Coupon_Panel(_t('Coupon Informations'));
        $couponPanel->DataSource = new Amhsoft_Data_Set($this->couponCodeModel->coupon);
        $this->couponCodePanel->addComponent($couponPanel);
    }

    public function loadSaleOrderDataGridView() {
        if (!Amhsoft_System_Module_Manager::isModuleInstalled('saleorder')) {
            return;
        }

        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ?', $this->accountModel->getId());

        $dataGridView = new Saleorder_DataGridView();
        $panel = new Amhsoft_Widget_Panel(_t('Related Sales Order'));

        $data = $saleOrderModelAdapter->fetch();
        $dataGridView->DataSource = new Amhsoft_Data_Set($saleOrderModelAdapter);

        $panel->addComponent($dataGridView);
        $this->couponCodePanel->addComponent($panel);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->couponCodePanel->setDataSource(new Amhsoft_Data_Set($this->couponCodeModel));
        $this->couponCodePanel->Bind();
        $this->getView()->assign('widget', $this->couponCodePanel);
        $this->show();
    }

}

?>
