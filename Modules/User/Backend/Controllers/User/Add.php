<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_User_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Form $userForm */
  protected $userForm;

  /** @var User_User_Model $userModel */
  protected $userModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userForm = new User_User_Form('userForm_form', 'POST');
    $this->userForm->usernameInput->addValidator(new Amhsoft_Unique_Validator('user', 'username'));
    $this->userModel = new User_User_Model();
    $this->userForm->numberInput->setValue($this->userModel->getNextNumber());
    $this->getView()->setMessage(_t('Create new User'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->userForm->isSend()) {
      if ($this->userForm->isValid()) {
        $this->userForm->DataBinding = $this->userModel;
        $userModelAdapter = new User_User_Model_Adapter();
        $this->userModel = $this->userForm->getDataBindItem();
        $this->userModel->setCreate_date_time(Amhsoft_Locale::UCTDateTime());
        $this->userModel->setState(1);
        $this->userModel->setUpdate_date_time(Amhsoft_Locale::UCTDateTime());
        $decryptedPassword = $this->userModel->getPassword();
        $this->userModel->setPassword(sha1($this->userModel->getPassword()));
        $userModelAdapter->save($this->userModel);
        if ($this->userModel->getId() > 0) {
          if ($this->userForm->sendPasswordCheckBox->getValue() == 1) {
            $notification = new User_Notification_Model($this->userModel);
            $notification->sendPasswordToUser($decryptedPassword);
          }
          if ($this->userModel->id > 0) {
            
            $pictureDir = 'media/user/picture';
            if(!is_dir($pictureDir)){
              @mkdir($pictureDir, 0777, true);
            }
            
            @unlink($pictureDir.'/' . $this->userModel->id . '.' . $this->userForm->picture->getUploadControl()->getExtention()); //remove it if exists
            $this->userForm->picture->getUploadControl()->uploadTo($pictureDir.'/'  . $this->userModel->id .  '.jpg');
          }
          $this->handleSuccess();
        }
      } else {
        $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('?module=user&page=user-list' . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->userForm);
    $this->show();
  }

}

?>
