<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Verify.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Frontend_Verify_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_Verify_Form $verifyForm */
    public $verifyForm;

    /**
     * Initialize event
     */
    public function __initialize() {
		  $this->setBreadCrumb(array('link' => 'index.php?module=cart&page=list', 'label' => _t('Shopping Cart')))->setBreadCrumb(array('link' => 'index.php?module=coupon&page=verify', 'label' => _t('Verify Coupon Promotion Code')));
        $this->verifyForm = new Coupon_Verify_Form('verify_form', 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->verifyForm->isSend()) {
            if ($this->verifyForm->isFormValid()) {
                $data = $this->verifyForm->getValues();
                $result = $this->verifyCode($data['promotion_code']);
                if ($result > 0) {
                    $cart = Cart_Shoppingcart_Model::getInstance();
                    $cart->coupon_code_id = $result;
                    $cart->Persist();
                    $this->getRedirector()->go('index.php?module=cart&page=list');
                }
            } else {
                $this->getView()->assign('promotion_message', _t('Please check your inputs'));
            }
        }
        if ($this->verifyForm->isBack()) {
            $this->getRedirector()->go('index.php?module=cart&page=list');
        }
    }

    protected function verifyCode($code) {
        if ($code) {
            $adapter = new Coupon_Code_Model_Adapter();
            $adapter->where('code = ?', addslashes($code), PDO::PARAM_STR);
            $model = $adapter->fetch()->fetch();
            if ($model instanceof Coupon_Code_Model) {

                if ($model->state_id != 1) {
                    $this->getView()->assign('promotion_message', _t('Promotion Code was expired on :' . $model->expire_date));
                    return null;
                }

                if ($model->expire_date < Amhsoft_Locale::UCTDateTime(null, 'Y-m-d')) {
                    $this->getView()->assign('promotion_message', _t('Promotion Code was expired on :' . $model->expire_date));
                    return null;
                }

                return $model->getId();
            } else {
                $this->getView()->assign('promotion_message', _t('Invalid Promtion Code'));
                return null;
            }
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('widget', $this->verifyForm);
        $this->show();
    }

}

?>
