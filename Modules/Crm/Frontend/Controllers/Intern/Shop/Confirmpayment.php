<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Confirmpayment.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Confirmpayment_Controller extends Amhsoft_System_Web_Controller {

    public $sale_order_id;
    public $confirmPaymentForm;
    public $saleOrderModel;
    public $accountModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $this->accountModel = $auth->getObject();
        } else {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $this->sale_order_id = $this->getRequest()->get('sale_order_id');
        $this->confirmPaymentForm = new Crm_Confirm_Payment_Form('confirmPayment', 'POST');
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=list', 'label' => _t('Orders List')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-confirmpayment&sale_order_id='.$this->sale_order_id , 'label' => _t('Confirm Payment')));
        $this->saleOrderModel = $saleOrderModelAdapter->fetchById($this->sale_order_id);
        if (!$this->saleOrderModel instanceof Saleorder_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->confirmPaymentForm->nameInput->Value = $this->accountModel->name;
        $this->confirmPaymentForm->emailInput->Value = $this->accountModel->email1;
        $this->confirmPaymentForm->mobileInput->Value = $this->accountModel->mobile;
        $this->confirmPaymentForm->paymentMethodName->Value = $this->saleOrderModel->payment_method_name;
        $this->confirmPaymentForm->amountInput->Value = $this->saleOrderModel->total_price;
    }

    /**
     * Default event
     */
    public function __default() {
        $this->confirmPaymentForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->confirmPaymentForm->isSend()) {
            if ($this->confirmPaymentForm->isValid()) {
                $str = _t('Name') . ':' . $this->confirmPaymentForm->nameInput->Value . "</br>";
                $str .= _t('Email') . ':' . $this->confirmPaymentForm->emailInput->Value . "</br>";
                $str .= _t('Mobile') . ':' . $this->confirmPaymentForm->mobileInput->Value . "</br>";
                $str .= _t('Bank') . ':' . $this->confirmPaymentForm->bankListBox->Value . "</br>";
                $str .= _t('Transferred Amount') . ':' . $this->confirmPaymentForm->amountInput->Value . "</br>";
                $str .= _t('Payment Method') . ':' . $this->confirmPaymentForm->paymentMethodName->Value . "</br>";
                $str .= _t('Bank Account Number') . ':' . $this->confirmPaymentForm->bankAccountNumberInput->Value . "</br>";
                $str .= _t('Bank Transaction Id') . ':' . $this->confirmPaymentForm->transfertIdInput->Value . "</br>";
                $str .= _t('Payment Date Time') . ':' . $this->confirmPaymentForm->paymentDateTime->Value . "</br>";
                $str .= _t('Description') . ':' . $this->confirmPaymentForm->descriptionTextArea->Value . "</br>";
                $this->postComment($str);
                $this->getRedirector()->go('index.php?module=saleorder&page=thankyou');
            } else {
                $this->getView()->assign('message', _t('Please verify inputs'));
            }
        }
    }

    public function postComment($str) {
        $saleOrderCommentModel = new Comment_Model();
        $saleOrderCommentModel->setSubject(_t('Confirm Payment'));
        $saleOrderCommentModel->setComment($str);
        $saleOrderCommentModel->setInsertat(Amhsoft_Locale::UCTDateTime());
        $saleOrderCommentModel->entity = 'Saleorder_Model';
        $saleOrderCommentModel->setPublic(1);
        $saleOrderCommentModel->entity_id = $this->saleOrderModel->getId();
        $saleOrderCommentModel->setAuthor_name($this->accountModel->getName());
        $saleOrderCommentModelAdapter = new Comment_Model_Adapter();
        $saleOrderCommentModelAdapter->save($saleOrderCommentModel);
        if ($saleOrderCommentModel->getId()) {
            @unlink('media/payment/confirm/' . $saleOrderCommentModel->getId() . '.jpg'); //remove it if exists
            $this->confirmPaymentForm->paymentLogo->getUploadControl()->uploadTo('media/payment/confirm/' . $saleOrderCommentModel->getId() . '.jpg');
        }
        if ($saleOrderCommentModel->getId() > 0) {
            Saleorder_Notification_Model::notifyAdminCommentSubmitted($this->saleOrderModel);
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->confirmPaymentForm);
        $this->show();
    }

}

?>