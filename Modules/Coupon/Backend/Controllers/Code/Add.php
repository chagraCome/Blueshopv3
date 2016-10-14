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

class Coupon_Backend_Code_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Code_Form couponCodeForm */
    protected $couponCodeForm;

    /** @var Coupon_Code_Model couponCodeModel */
    protected $couponCodeModel;
    protected $couponID;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponID = $this->getRequest()->getInt('coupon_id');
        if ($this->couponID <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->couponCodeForm = new Coupon_Code_Form('couponCodeForm_form', 'POST');
        $this->couponCodeForm->removeByName('coupon_code_state_id');
        $this->couponCodeModel = new Coupon_Code_Model();
        $this->getView()->setMessage(_t('Add new Coupon Code'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->couponCodeForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->couponCodeForm->isSend()) {
            if ($this->couponCodeForm->isValid()) {
                $this->couponCodeForm->DataBinding = $this->couponCodeModel;
                $couponCodeModelAdapter = new Coupon_Code_Model_Adapter();
                $this->couponCodeModel = $this->couponCodeForm->getDataBindItem();
                $this->couponCodeModel->insert_date_time = Amhsoft_Locale::UCTDateTime();
                $this->couponCodeModel->state_id = 1;
                $this->couponCodeModel->coupon_id = $this->couponID;
                try {
                    $couponCodeModelAdapter->save($this->couponCodeModel);
                    $this->handleSuccess();
                } catch (Exception $e) {
                    $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
                }
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    /**
     * Handle success.
     */
    protected function handleSuccess() {
        Amhsoft_Navigator::go('?module=coupon&page=detail&id=' . $this->couponID . '&ret=true');
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('widget', $this->couponCodeForm);
        $this->show();
    }

}

?>