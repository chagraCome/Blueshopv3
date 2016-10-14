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
class User_Backend_Privilege_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_Privilege_Form $privilegeForm */
  protected $privilegeForm;

  /** @var User_Privilege_Model_Adapter $ */
  protected $privilegeModelAdapter;
  protected $id;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id < 1) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->privilegeModelAdapter = new User_Privilege_Model_Adapter();
    $this->privilegeForm = new User_Privilege_Form('privilege_form', 'post');
    $this->getView()->setMessage(_t('List Privilege'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->privilegeForm->isSend()) {
      $data = $this->getRequest()->posts('access');
      $this->privilegeModelAdapter->deleteAll('WHERE role_id = ' . $this->id);
      foreach ($data as $privilege) {
	$privilegeModel = new User_Privilege_Model();
	$privilegeModel->setName($privilege);
	$privilegeModel->setRoleId($this->id);
	$this->privilegeModelAdapter->save($privilegeModel);
      }
      $this->getRedirector()->go('?module=user&page=role-list' . '&ret=true');
    }
  }

  /**
   * getSelectedPrivileges
   * get selected privileges
   */
  public function getSelectedPrivileges() {
    $data = array();
    $this->privilegeModelAdapter->where('role_id = ?', $this->id);
    foreach ($this->privilegeModelAdapter->fetch() as $p) {
      $data[] = $p->getName();
    }
    return $data;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->privilegeForm->treeView->setCheckedValues($this->getSelectedPrivileges());
    $this->getView()->assign('form', $this->privilegeForm);
    $this->includeJsFile('privilegetree.js');
    $this->show();
  }

}

?>
