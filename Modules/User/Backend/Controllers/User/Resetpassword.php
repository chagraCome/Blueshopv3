<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Resetpassword.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_User_Resetpassword_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Model_Adapter $userModelAdapter */
  public $userModelAdapter;

  /** @var User_User_Model $userModel */
  public $userModel;
  public $forgotForm;
  public $token;

  /**
   * Initialize controller.
   */
  public function __initialize() {
    $this->token = $this->getRequest()->get('token');
    if (!$this->token) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->userModelAdapter = new User_User_Model_Adapter();
    $this->userModel = $this->userModelAdapter->fetch()->fetch();
    if (!$this->userModel instanceof User_User_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->forgotForm = new Crm_Resetpassword_Form("forgot_password", 'POST');
    $this->forgotForm->emailInput->setSize(30);
    $this->forgotForm->repasswordInput->setSize(30);
    $this->forgotForm->passwordInput->setSize(30);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->forgotForm->isSend()) {
      if ($this->forgotForm->isFormValid()) {
	$data = $this->forgotForm->getValues();
	if ($data['password'] == $data['repassword']) {
	  $this->userModelAdapter->where('email = ?', $data['email'], PDO::PARAM_STR);
	  $this->userModel = $this->userModelAdapter->fetch()->fetch();
	  if ($this->userModel instanceof User_User_Model) {
	    $this->userModel->setPassword(sha1($data['password']));
	    $this->userModel->setToken('');
	    $this->userModelAdapter->save($this->userModel);
	    $this->getView()->assign('reset_message', _t('Your Password Was Changed'));
	    sleep(1);
	    $this->getRedirector()->go('admin.php?module=user&page=user-login');
	  } else {
	    $this->getView()->assign('reset_message', _t('User within email address not found'));
	  }
	} else {
	  $this->getView()->assign('reset_message', _t('Password not identical'));
	}
      }
    }
  }

  /**
   * Finalize event.
   */
  public function __finalize() {
    $this->getView()->assign("form", $this->forgotForm);
    $design_file = 'Design/Backend/' . Amhsoft_System::getLayout() . '/Modules/User/Backend/Views/User/Resetpassword.html';
    if (file_exists($design_file)) {
      $this->getView()->display($design_file);
    } else {
      $this->getView()->display('Modules/User/Backend/Views/User/Resetpassword.html');
    }
  }

}

?>
