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

class User_Backend_Group_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Group_Form $userGroupForm */
  protected $userGroupForm;

  /** @var User_Group_Model $userGroupModel */
  protected $userGroupModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userGroupForm = new User_Group_Form('userGroupForm_form', 'POST');
    $this->userGroupModel = new User_Group_Model();
    $this->getView()->setMessage(_t('Create new User Group'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->userGroupForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->userGroupForm->isSend()) {
      if ($this->userGroupForm->isValid()) {
	$this->userGroupForm->DataBinding = $this->userGroupModel;
	$userGroupModelAdapter = new User_Group_Model_Adapter();
	$this->userGroupModel = $this->userGroupForm->getDataBindItem();
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
    $this->getRedirector()->go('admin.php?module=user&page=group-list&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->userGroupForm);
    $this->show();
  }

}

?>
