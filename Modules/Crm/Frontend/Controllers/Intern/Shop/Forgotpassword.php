<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Forgotpassword.php 282 2016-02-03 09:14:15Z amira.amhsoft $
 * $Rev: 282 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-03 10:14:15 +0100 (mer., 03 févr. 2016) $
 * $Author: amira.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Forgotpassword_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Model_Adapter $accountModelAdapter */
    public $accountModelAdapter;

    /** @var Crm_Account_Model $accountModel */
    public $accountModel;
    public $forgotForm;
    protected $notificationModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-forgotpassword', 'label' => _t('Reset Password')));
        $this->accountModelAdapter = new Crm_Account_Model_Adapter();
        $this->accountModel = new Crm_Account_Model();
        $this->forgotForm = new Crm_Forgotpassword_Form("forgot_password", 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->getRequest()->get('ret') == 'false') {
            $this->getView()->assign("message", "Email Not Exist");
        }
        if ($this->forgotForm->isSend()) {
            if ($this->forgotForm->isFormValid()) {
                $email = base64_encode($this->forgotForm->emailInput->Value);
                $this->getRedirector()->go('index.php?module=crm&page=intern-shop-forgotpassword&event=verify&hash=' . $email);
            }
        }
    }

    /**
     * Verify event
     */
    public function __verify() {
        $emai = base64_decode($this->getRequest()->get('hash'));
        $this->resetPassword($emai);
        $this->getRedirector()->go('index.php?module=crm&page=intern-shop-forgotpassword&ret=false');
    }

    function resetPassword($email) {
        if (!$email) {
            $this->getView()->assign("message", "Please check your email");
            return false;
        }
        $this->accountModel = $this->accountModelAdapter->fetchByEmail($email);
        if (!$this->accountModel instanceof Crm_Account_Model) {
            return false;
        }
        if ($this->accountModel->email1 == $email) {
            $token = md5(uniqid() . Amhsoft_Locale::DateTime('Y-m-d'));
            $this->accountModel->setToken($token);
            $this->accountModelAdapter->update($this->accountModel);
            $this->notificationModel = new Crm_Notification_Account_Model($this->accountModel);
            $this->notificationModel->sendPasswordResetTokenByEmail($token);
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-forgotpassworddone');
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign("form", $this->forgotForm);
        $this->show();
    }

}

?>
