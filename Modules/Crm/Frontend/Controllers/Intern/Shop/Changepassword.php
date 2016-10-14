<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Changepassword.php 383 2016-02-10 14:43:34Z montassar.amhsoft $
 * $Rev: 383 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-10 15:43:34 +0100 (mer., 10 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Changepassword_Controller extends Amhsoft_System_Web_Controller {

    public $accountModelAdapter;
    public $changePasswordForm;
    protected $notificationModel;

    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-changepassword', 'label' => _t('Change Password')));
        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }

        $this->accountModelAdapter = new Crm_Account_Model_Adapter();
        $this->changePasswordForm = new Amhsoft_Widget_Form("change_password", 'POST');

        $oldPassword = new Amhsoft_Password_Control('oldpassword', _t('Old Password'));
        $oldPassword->DataBinding = new Amhsoft_Data_Binding('oldpassword');
        $oldPassword->setRequired(true);
        $this->changePasswordForm->addComponent($oldPassword);

        $newPassword = new Amhsoft_Password_Control('newpassword', _t('New Password'));
        $newPassword->DataBinding = new Amhsoft_Data_Binding('newpassword');
        $newPassword->setRequired(true);
        $newPassword->addValidator(new Amhsoft_String_Validator(4));

        $reNewPassword = new Amhsoft_Password_Control('renewpassword', _t('Re-enter Password'));
        $reNewPassword->DataBinding = new Amhsoft_Data_Binding('renewpassword');
        $reNewPassword->setRequired(true);
        $reNewPassword->addValidator(new Amhsoft_String_Validator(4));

        $this->changePasswordForm->addComponent($newPassword);
        $this->changePasswordForm->addComponent($reNewPassword);
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Submit'));
        //$submitButton->setClass('Button');
        $this->changePasswordForm->addComponent($submitButton);
    }

    public function __default() {
        $auth = Amhsoft_Authentication::getInstance();

        $currentCustomer = $auth->getObject()->id;
        if (isset($_POST['submit'])) {
            $this->changePasswordForm->DataSource = Amhsoft_Data_Source::Post();
            if ($this->changePasswordForm->isValid()) {
                $this->changePassword($currentCustomer);
            }
        }
    }

    protected function changePassword($id) {
        $accountModel = $this->accountModelAdapter->fetchById($id);
        $oldpassword = trim($this->getRequest()->post('oldpassword'));
        $password = trim($this->getRequest()->post('newpassword'));
        $renewpassword = trim($this->getRequest()->post('renewpassword'));
        if ($password != $renewpassword) {
            $this->getView()->assign("message", _t('Faild to change password , new password and rentred password doesnt match'));
            return;
        }

        if ($accountModel) {
            if (sha1($oldpassword) == $accountModel->getPassword()) {
                $accountModel->setPassword(sha1($password));
                $this->accountModelAdapter->save($accountModel);
                $this->getView()->assign("success", _t('Password was changed !'));
            } else {
                $this->getView()->assign("error", _t('Old Password not correct !'));
            }
        }
    }

    public function __finalize() {
        $this->getView()->assign('form', $this->changePasswordForm->Render());
        $this->show();
    }

}
?>