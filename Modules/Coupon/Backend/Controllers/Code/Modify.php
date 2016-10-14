<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Coupon_Backend_Code_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Code_Form couponCodeForm */
    protected $couponCodeForm;

    /** @var Coupon_Code_Model couponCodeModel */
    protected $couponCodeModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponCodeForm = new Coupon_Code_Form('couponCodeForm_form', 'POST');
        $this->getView()->setMessage(_t('Edit Coupon Code'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $couponCodeModelAdapter = new Coupon_Code_Model_Adapter();
            $this->couponCodeModel = $couponCodeModelAdapter->fetchById($id);
        }
        if (!$this->couponCodeModel instanceof Coupon_Code_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->oldCouponCodeState = $this->couponCodeModel->state_id;


        $this->couponCodeForm->DataSource = new Amhsoft_Data_Set($this->couponCodeModel);
        $this->couponCodeForm->Bind();

    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->couponCodeForm->isSend()) {
            $this->couponCodeForm->DataSource = Amhsoft_Data_Source::Post();
            $this->couponCodeForm->Bind();

            if ($this->couponCodeForm->isValid()) {
                $data = $this->couponCodeForm->getValues();
                $this->couponCodeForm->DataBinding = $this->couponCodeModel;
                $couponCodeModelAdapter = new Coupon_Code_Model_Adapter();

                $this->couponCodeModel = $this->couponCodeForm->getDataBindItem();


                if ($this->couponCodeModel->state_id != $data['coupon_code_state_id']) {
                    $this->couponCodeModel->state_id = $data['coupon_code_state_id'];
                }

                $couponCodeModelAdapter->save($this->couponCodeModel);
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
        $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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