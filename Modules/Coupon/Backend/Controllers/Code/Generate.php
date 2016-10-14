<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Generate.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Coupon_Backend_Code_Generate_Controller extends Amhsoft_System_Web_Controller {

    protected $couponID;
    public $mainPanel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponID = $this->getRequest()->getInt('coupon_id');
        if ($this->couponID <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->getView()->setMessage(_t('Generate Coupon Codes'), View_Message_Type::INFO);
        $this->mainPanel = new Amhsoft_Widget_Panel(_t('Generations Informations'));
    }

    /**
     * Default event
     */
    public function __default() {
        $this->drawForm();
    }

//validate number of coupon code
    public static function validate_CouponCode_CallBack(Amhsoft_Abstract_Control $component) {

        if (!is_numeric($component->getValue())) {
            $component->setErrorMessage(_t('Check number of code must be number'));
            return false;
        }

        if ($component->getValue() <= 0) {
            $component->setErrorMessage(_t('Check number of code'));
            return false;
        }
    }

    protected function drawForm() {
        $form = new Amhsoft_Widget_Form('codes', 'POST');

        $number = new Amhsoft_Input_Control('count', _t('Number of codes'));
        $number->DataBinding = new Amhsoft_Data_Binding('count');
        $number->Required = true;
        $number->onValidate->registerEvent($this, 'validate_CouponCode_CallBack');


        $expire_date = new Amhsoft_Date_Input_Control('expire_date', _t('Expire Date'));
        $expire_date->DataBinding = new Amhsoft_Data_Binding('expire_date');
        $expire_date->Required = true;

        $sumitButton = new Amhsoft_Button_Submit_Control('submit', _t('Generate'));

        $form->addComponent($number);
        $form->addComponent($expire_date);
        $form->addComponent($sumitButton);

        $this->mainPanel->addComponent($form);
        if ($this->getRequest()->isPost('submit')) {
            if ($form->isFormValid()) {
                $data = $form->getValues();
                $this->generateCodes($data['count'], $data['expire_date']);
                $this->handleSuccess();
            } else {
                $this->getView()->setMessage(_t('Please Check inputs'), View_Message_Type::ERROR);
            }
        }
    }

    protected function generateCodes($count, $expirationDate) {
        for ($i = 1; $i <= $count; $i++) {
            $model = $this->generateModel($expirationDate);
            $this->saveModel($model);
        }
    }

    protected function generateModel($expirationDate) {
        $model = new Coupon_Code_Model();

        $model->setCode(Coupon_Code_Model::generateCode());
        $model->setExpire_date($expirationDate);
        $model->setInsert_date_time(Amhsoft_Locale::UCTDateTime());
        $model->state_id = 1;
        $model->coupon_id = $this->couponID;
        return $model;
    }

    protected function saveModel(Coupon_Code_Model $model) {
        $adapter = new Coupon_Code_Model_Adapter();
        $j = 0;
        try {
            $adapter->save($model);
            $model->generateImage();
        } catch (Exception $e) {
            $j++;
        }
        if ($j > 0) {
            $this->generateCodes($j, $model->getExpire_date());
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
        $this->getView()->assign('widget', $this->mainPanel);
        $this->show();
    }

}

?>