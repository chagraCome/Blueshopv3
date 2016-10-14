<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Statistics.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Backend_Statistics_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Mode_Adapter $couponModeAdapter */
    protected $couponModeAdapter;

    /** @var Amhsoft_Widget_Panel $mainPanel */
    protected $mainPanel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->getView()->setMessage(_t('Coupon Statistics'), View_Message_Type::INFO);
        $this->couponModeAdapter = new Coupon_Model_Adapter();
        $this->mainPanel = new Amhsoft_Widget_Panel(_t('Coupon Statistics'));
    }

    /**
     * Default event
     */
    public function __default() {
        $this->loadExpiredCoupons();
        $this->loadFreeCoupons();
        $this->loadUsedCoupons();
        $this->loadTotalCodeAmount();
        $this->loadTotalUsedCodeAmount();
        $this->loadTotalExpiredCodeAmount();
        $this->loadTotalFreeCodeAmount();
    }

    protected function loadExpiredCoupons() {
        $codeModelAdapter = new Coupon_Code_Model_Adapter();
        $codeModelAdapter->where('state_id = ?', Coupon_Code_State_Model::EXPIRED);
        $panel = new Amhsoft_Widget_Panel(_t('Expired Coupons'));
        $label = new Amhsoft_Label_Control(_t('Count'));
        $label->setValue($codeModelAdapter->getCount());
        $label->ToolTip = _t('Expired Code');
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadUsedCoupons() {
        $codeModelAdapter = new Coupon_Code_Model_Adapter();
        $codeModelAdapter->where('state_id = ?', Coupon_Code_State_Model::USED);
        $panel = new Amhsoft_Widget_Panel(_t('Used Coupons'));
        $label = new Amhsoft_Label_Control(_t('Count'));
        $label->setValue($codeModelAdapter->getCount());
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadFreeCoupons() {
        $codeModelAdapter = new Coupon_Code_Model_Adapter();
        $codeModelAdapter->where('state_id = ?', Coupon_Code_State_Model::FREE);
        $panel = new Amhsoft_Widget_Panel(_t('Free Coupons'));
        $label = new Amhsoft_Label_Control(_t('Count'));
        $label->setValue($codeModelAdapter->getCount());
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadTotalCodeAmount() {
        $sql = "SELECT SUM(amount) as sum_amount FROM coupon LEFT JOIN coupon_code ON coupon_code.coupon_id = coupon.id";
        $result = Amhsoft_Database::querySingle($sql);
        $panel = new Amhsoft_Widget_Panel(_t('Total Coupons Amounts'));
        $label = new Amhsoft_Currency_Label_Control(_t('Total Amount'));
        $label->setValue($result);
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadTotalUsedCodeAmount() {
        $sql = "SELECT SUM(amount) as sum_amount FROM coupon LEFT JOIN coupon_code ON coupon_code.coupon_id = coupon.id WHERE coupon_code.state_id = " . Coupon_Code_State_Model::USED;
        $result = Amhsoft_Database::querySingle($sql);
        $panel = new Amhsoft_Widget_Panel(_t('Total Used Coupons Amounts'));
        $label = new Amhsoft_Currency_Label_Control(_t('Total Used Amount'));
        $label->setValue($result);
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadTotalExpiredCodeAmount() {
        $sql = "SELECT SUM(amount) as sum_amount FROM coupon LEFT JOIN coupon_code ON coupon_code.coupon_id = coupon.id WHERE coupon_code.state_id = " . Coupon_Code_State_Model::EXPIRED;
        $result = Amhsoft_Database::querySingle($sql);
        $panel = new Amhsoft_Widget_Panel(_t('Total Expired Coupons Amounts'));
        $label = new Amhsoft_Currency_Label_Control(_t('Total Expired Amount'));
        $label->setValue($result);
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    protected function loadTotalFreeCodeAmount() {
        $sql = "SELECT SUM(amount) as sum_amount FROM coupon LEFT JOIN coupon_code ON coupon_code.coupon_id = coupon.id WHERE coupon_code.state_id = " . Coupon_Code_State_Model::FREE;
        $result = Amhsoft_Database::querySingle($sql);
        $panel = new Amhsoft_Widget_Panel(_t('Total Free Coupons Amounts'));
        $label = new Amhsoft_Currency_Label_Control(_t('Total Free Amount'));
        $label->setValue($result);
        $panel->addComponent($label);
        $this->mainPanel->addComponent($panel);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign("widget", $this->mainPanel);
        $this->show();
    }

}

?>