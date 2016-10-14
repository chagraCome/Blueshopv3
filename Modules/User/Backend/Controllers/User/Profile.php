<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Profile.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_User_Profile_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Form $userForm */
  protected $userForm;

  /** @var UserModel $userModel */
  protected $userModel;

  /**
   * Initialize controller.
   */
  public function __initialize() {
    $this->userForm = new User_User_Form('user_form', 'POST');
    $this->getView()->setMessage(_t('My Profile'), View_Message_Type::INFO);
    $id = Amhsoft_Authentication::getInstance()->getObject()->id;
    if ($id > 0) {
      $userModelAdapter = new User_User_Model_Adapter();
      $this->userModel = $userModelAdapter->fetchById($id);
    }
    if (!$this->userModel instanceof User_User_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->userForm->DataSource = new Amhsoft_Data_Set($this->userModel);
    $this->userForm->usernameInput->addValidator(new Amhsoft_Unique_Validator('user', 'username', $this->userModel->getUsername()));
    
    $this->userForm->picture->deleteUrl = 'admin.php?module=user&page=user-profile&event=deletepic';
    
    $this->userForm->Bind();
    $this->userForm->removeByName('admin');
    $this->userForm->removeByName('role_id');
    $this->userForm->removeByName('department_id');
    $this->userForm->removeByName('password');
    $this->userForm->removeByName('send_password');
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->userForm->isSend()) {
      $this->userForm->DataSource = Amhsoft_Data_Source::Post();
      $this->userForm->Bind();
      if ($this->userForm->isValid()) {
	$this->userForm->DataBinding = $this->userModel;
	$userModelAdapter = new User_User_Model_Adapter();
	$this->userModel = $this->userForm->getDataBindItem();
	$this->userModel->setUpdate_date_time(Amhsoft_Locale::UCTDateTime());
	$userModelAdapter->save($this->userModel);
        
        
        $pictureDir = 'media/user/picture';
        if (!is_dir($pictureDir)) {
          @mkdir($pictureDir, 0777, true);
        }

        @unlink($pictureDir . '/' . $this->userModel->id . '.' . $this->userForm->picture->getUploadControl()->getExtention()); //remove it if exists
        $this->userForm->picture->getUploadControl()->uploadTo($pictureDir . '/' . $this->userModel->id . '.jpg');
        
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }
  
  public function __deletepic(){
    @unlink($this->userModel->getImage());
    $this->getRedirector()->go('admin.php?module=user&page=user-profile');
  }


  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
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
