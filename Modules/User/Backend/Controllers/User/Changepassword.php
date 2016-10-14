<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Changepassword.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_User_Changepassword_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Model_Adapter $userModelAdapter */
  public $userModelAdapter;

  /** @var User_ChangePassword_Form $changePasswordForm */
  public $changePasswordForm;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Change Your Password'), View_Message_Type::INFO);
    $this->userModelAdapter = new User_User_Model_Adapter();
    $this->changePasswordForm = new User_ChangePassword_Form('account_form', 'POST');
  }

  /**
   * Default event
   */
  public function __default() {
    $auth = Amhsoft_Authentication::getInstance();
    if (!$auth->isAuthenticated()) {
      $this->getRedirector()->go('admin.php?module=user&page=user-login');
    }
    $currentCustomer = $auth->getObject()->id;
    if ($this->changePasswordForm->isSend()) {
      if ($this->changePasswordForm->isValid()) {
	$this->changePassword($currentCustomer);
      }
    }
  }

  /**
   * change user password
   * @param type $id
   * @return type
   */
  protected function changePassword($id) {
    $userModel = $this->userModelAdapter->fetchById($id);
    $oldpassword = trim($this->changePasswordForm->passwordInput->Value);
    $password = trim($this->changePasswordForm->newPasswordInput->Value);
    $repassword = trim($this->changePasswordForm->confirmPasswordInput->Value);
    if ($password != $repassword) {
      $this->getView()->setMessage(_t('Password not identical'), View_Message_Type::ERROR);
      return;
    }
    if ($userModel) {
      if (sha1($oldpassword) == $userModel->getPassword()) {
	$userModel->setPassword(sha1($password));
	$this->userModelAdapter->update($userModel);
	$this->getView()->setMessage(_t('Password was changed!'), View_Message_Type::SUCCESS);
      } else {
	$this->getView()->setMessage(_t('Old Password not correct!'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->changePasswordForm);
    $this->show();
  }

}

?>
