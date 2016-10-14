<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_Department_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Department_Form $userDepartmentForm */
  protected $userDepartmentForm;

  /** @var User_Department_Model $userGroupModel */
  protected $userGroupModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userDepartmentForm = new User_Department_Form('department_form', 'POST');
    $this->getView()->setMessage(_t('Edit Department'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $userGroupModelAdapter = new User_Department_Model_Adapter();
      $this->userGroupModel = $userGroupModelAdapter->fetchById($id);
    }
    if (!$this->userGroupModel instanceof User_Department_Model) {
      die('Requested Department not found');
    }
    $this->userDepartmentForm->DataSource = new Amhsoft_Data_Set($this->userGroupModel);
    $this->userDepartmentForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->userDepartmentForm->isSend()) {
      $this->userDepartmentForm->DataSource = Amhsoft_Data_Source::Post();
      $this->userDepartmentForm->Bind();
      if ($this->userDepartmentForm->isValid()) {
	$this->userDepartmentForm->DataBinding = $this->userGroupModel;
	$userGroupModelAdapter = new User_Department_Model_Adapter();
	$this->userGroupModel = $this->userDepartmentForm->getDataBindItem();
	$userGroupModelAdapter->save($this->userGroupModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go("admin.php?module=user&page=department-list&ret=true");
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->userDepartmentForm);
    $this->show();
  }

}

?>
