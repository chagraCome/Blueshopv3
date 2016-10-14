<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_Group_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Group_Form $userGroupForm */
  protected $userGroupForm;

  /** @var User_Group_Model $userGroupModel */
  protected $userGroupModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->userGroupForm = new User_Group_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit User Group'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $userGroupModelAdapter = new User_Group_Model_Adapter();
      $this->userGroupModel = $userGroupModelAdapter->fetchById($id);
    }
    if (!$this->userGroupModel instanceof User_Group_Model) {
      die('Requested User Group not found');
    }
    $this->userGroupForm->DataSource = new Amhsoft_Data_Set($this->userGroupModel);
    $this->userGroupForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->userGroupForm->isSend()) {
      $this->userGroupForm->DataSource = Amhsoft_Data_Source::Post();
      $this->userGroupForm->Bind();
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
    $this->getRedirector()->go("admin.php?module=user&page=group-list&ret=true");
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
