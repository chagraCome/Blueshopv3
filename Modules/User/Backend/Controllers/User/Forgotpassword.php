<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Forgotpassword.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_User_Forgotpassword_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Model_Adapter $userModelAdapter */
  public $userModelAdapter;

  /** @var User_User_Model $userModel */
  public $userModel;

  /** @var Crm_Forgotpassword_Form $forgotForm */
  public $forgotForm;

  /** @var User_Notification_Model $notificationModel */
  protected $notificationModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->getView()->assign("reset_message", '');
    $this->userModelAdapter = new User_User_Model_Adapter();
    $this->userModel = new User_User_Model();
    $this->forgotForm = new Crm_Forgotpassword_Form("forgot_password", 'POST');
    $this->forgotForm->emailInput->setSize(30);
  }

  /**
   * Default event
   */
  public function __default() {
    if (Amhsoft_Web_Request::isGet('ret')) {
      if ($this->getRequest()->get('ret') == 'false') {
	$this->getView()->assign("reset_message", _t("Email Not Exist"));
      } else {
	$this->getView()->assign("reset_message", _t('Reset Password link was send to your email'));
      }
    }
    if ($this->forgotForm->isSend()) {
      if ($this->forgotForm->isFormValid()) {
	$email = base64_encode($this->forgotForm->emailInput->Value);
	$this->getRedirector()->go('admin.php?module=user&page=user-forgotpassword&event=verify&hash=' . $email);
      }
    }
  }

  /**
   * verify email event
   */
  public function __verify() {
    $email = base64_decode($this->getRequest()->get('hash'));
    $result = $this->resetPassword($email);
    if ($result == true) {
      $this->getRedirector()->go('admin.php?module=user&page=user-forgotpassword&ret=true');
    } else {
      $this->getRedirector()->go('admin.php?module=user&page=user-forgotpassword&ret=false');
    }
  }

  /**
   * reset user password
   * @param type $email
   * @return boolean
   */
  function resetPassword($email) {
    if (!$email) {
      $this->getView()->assign("message", _t("Please check your email"));
      return false;
    }
    $this->userModel = $this->userModelAdapter->fetchByEmail($email, 'email');
    if (!$this->userModel instanceof User_User_Model) {
      return false;
    }
    if ($this->userModel->email == $email) {
      $token = md5(uniqid() . Amhsoft_Locale::DateTime('Y-m-d'));
      $this->userModel->setToken($token);
      $this->userModelAdapter->update($this->userModel);
      $this->notificationModel = new User_Notification_Model($this->userModel);
      $this->notificationModel->sendPasswordResetTokenByEmail($token);
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
    $design_file = 'Design/Backend/' . Amhsoft_System::getLayout() . '/Modules/User/Backend/Views/User/Forgotpassword.html';
    if (file_exists($design_file)) {
      $this->getView()->display($design_file);
    } else {
      $this->getView()->display('Modules/User/Backend/Views/User/Forgotpassword.html');
    }
  }

}

?>