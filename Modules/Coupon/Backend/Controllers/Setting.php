<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    public $couponPanel;

    /** @var Amhsoft_Config_Table_Adapter $settings */
    public $settings;
    public $form;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->settings = new Amhsoft_Config_Table_Adapter(Coupon_Code_Model::SETTINGS);

        $this->couponPanel = new Amhsoft_Widget_Panel(_t('Coupon Settings'));
        $this->getView()->setMessage(_t('Manage Coupon Settings'), View_Message_Type::INFO);
        $this->form = new Coupon_Setting_Form('setting', 'POST');

        $this->form->printImage->setDeleteUrl('admin.php?module=coupon&page=setting&event=delete');
        $this->couponPanel->addComponent($this->form);

        if (file_exists('media/coupons/coupon_template.jpg')) {
            $this->form->printImage->Value = 'media/coupons/coupon_template.jpg';
        }
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->form->isSend()) {
            if ($this->form->isFormValid()) {
                $data = $this->form->getValues();
                $this->form->printImage->getUploadControl()->uploadTo('media/coupons/coupon_template.jpg');
                foreach ($data as $key => $val) {
                    $this->settings->setValue($key, $val);
                }
                $this->getRedirector()->go('admin.php?module=coupon&page=setting&ret=true');
            } else {
                $this->getView()->setMessage(_t('Please Check Inputs'));
            }
        }
    }

    /**
     * Delete event
     */
    public function __delete() {
        if (@file_exists('media/coupons/coupon_template.jpg')) {
            @unlink('media/coupons/coupon_template.jpg');
            $this->getRedirector()->go('admin.php?module=coupon&page=setting&ret=true');
        } else {
            $this->getRedirector()->go('admin.php?module=coupon&page=setting&ret=false');
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->form->DataSource = new Amhsoft_Data_Set($this->settings->getConfiguration());
        $this->form->Bind();
        $this->getView()->assign('widget', $this->couponPanel);
        $this->show();
    }

}

?>