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
class User_Backend_Department_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Department_Form $userDepartmentForm */
  protected $userDepartmeForm;

  /** @var User_Department_Model $userDepartmentModel */
  protected $userDepartmentModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userDepartmentForm = new User_Department_Form('userDepartment_form', 'POST');
    $this->userDepartmentModel = new User_Department_Model();
    $this->getView()->setMessage(_t('Create new Department'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userDepartmentForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->userDepartmentForm->isSend()) {
      if ($this->userDepartmentForm->isValid()) {
	$this->userDepartmentForm->DataBinding = $this->userDepartmentModel;
	$userDepartmentModelAdapter = new User_Department_Model_Adapter();
	$this->userDepartmentModel = $this->userDepartmentForm->getDataBindItem();
	$userDepartmentModelAdapter->save($this->userDepartmentModel);
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
    $this->getRedirector()->go('admin.php?module=user&page=department-list&ret=true');
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
