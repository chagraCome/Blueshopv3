<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_Role_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Role_Form $userRoleForm */
  protected $userRoleForm;

  /** @var User_Role_Model $userRoleModel */
  protected $userRoleModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userRoleForm = new User_Role_Form('userRoleForm', 'POST');
    $this->userRoleModel = new User_Role_Model();
    $this->getView()->setMessage(_t('Create new User Role'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userRoleForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->userRoleForm->isSend()) {
      if ($this->userRoleForm->isValid()) {
	$this->userRoleForm->DataBinding = $this->userRoleModel;
	$userRoleModelAdapter = new User_Role_Model_Adapter();
	$this->userRoleModel = $this->userRoleForm->getDataBindItem();
	$userRoleModelAdapter->save($this->userRoleModel);
	if ($this->userRoleModel->getId() > 0) {
	  $this->handleSuccess();
	} else {
	  $this->getView()->setMessage(_t('Cannot insert role'), View_Message_Type::ERROR);
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
    $this->getRedirector()->go('?module=user&page=role-list' . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->userRoleForm);
    $this->show();
  }

}

?>
