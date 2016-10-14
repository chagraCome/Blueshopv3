<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Coupon_Backend_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Form couponForm */
    protected $couponForm;

    /** @var Coupon_Model couponModel */
    protected $couponModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponForm = new Coupon_Form('couponForm_form', 'POST');
        $this->couponModel = new Coupon_Model();
        $this->getView()->setMessage(_t('Add new Coupon'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->couponForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->couponForm->isSend()) {
            if ($this->couponForm->isValid()) {
                $this->couponForm->DataBinding = $this->couponModel;
                $couponModelAdapter = new Coupon_Model_Adapter();
                $this->couponModel = $this->couponForm->getDataBindItem();
                $this->couponModel->insert_date_time = Amhsoft_Locale::UCTDateTime();
                $this->couponModel->update_time_time = Amhsoft_Locale::UCTDateTime();
                $this->couponModel->setUser(Amhsoft_Authentication::getInstance()->getObject());
                $couponModelAdapter->save($this->couponModel);
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
        $this->getRedirector()->go('?module=coupon&page=list&ret=true');
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('widget', $this->couponForm);
        $this->show();
    }

}

?>