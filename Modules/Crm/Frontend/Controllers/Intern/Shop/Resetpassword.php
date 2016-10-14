<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Resetpassword.php 406 2016-02-11 12:31:01Z imen.amhsoft $
 * $Rev: 406 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-11 13:31:01 +0100 (jeu., 11 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Resetpassword_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Model_Adapter $accountModelAdapter */
    public $accountModelAdapter;

    /** @var Crm_Account_Model $accountModel */
    public $accountModel;
    public $forgotForm;
    public $token;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-forgotpassword', 'label' => _t('Reset Password')));

        $this->token = $this->getRequest()->get('token');
        if (!$this->token) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->accountModelAdapter = new Crm_Account_Model_Adapter();
        $this->accountModelAdapter->where('token = ?', addslashes($this->token), PDO::PARAM_STR);
        $this->accountModel = $this->accountModelAdapter->fetch()->fetch();
        if (!$this->accountModel instanceof Crm_Account_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->forgotForm = new Crm_Resetpassword_Form("forgot_password", 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->forgotForm->isSend()) {
            if ($this->forgotForm->isFormValid()) {
                $data = $this->forgotForm->getValues();
                if ($data['password'] == $data['repassword']) {
                    $this->accountModelAdapter->where('email1 = ?', $data['email'], PDO::PARAM_STR);
                    $this->accountModel->setPassword(sha1($data['password']));
                    $this->accountModel->setToken('');
                    $this->accountModelAdapter->save($this->accountModel);
                    $this->getView()->assign('success', _t('Your Password was changed'));
                } else {
                    $this->getView()->assign('message', _t('Password not identical'));
                }
            }
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
