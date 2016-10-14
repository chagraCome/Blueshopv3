<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Quicklist.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_User_Quicklist_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var User_User_Model_Adapter $userModelAdapter */
  protected $userModelAdapter;

  /**
   * Initialize controller.
   */
  public function __initialize() {
    $this->dataGridView = new Amhsoft_Widget_DataGridView();
    $this->setUpUserDataGridView();
    $this->userModelAdapter = new User_User_Model_Adapter();
    $this->getView()->setMessage(_t('List Users'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * 
   */
  public function setUpUserDataGridView() {
    $firstNameCol = new Amhsoft_Link_Control(_t('First Name'), '?module=user&page=user-quicklist&event=select');
    $firstNameCol->DisplayValue = "firstname";
    $firstNameCol->DataBinding = new Amhsoft_Data_Binding('id', 'firstname');
    $lastNameCol = new Amhsoft_Link_Control(_t('Last Name'), '?module=user&page=user-quicklist&event=select');
    $lastNameCol->DisplayValue = "lastname";
    $lastNameCol->DataBinding = new Amhsoft_Data_Binding('id', 'lastname');
    $emailCol = new Amhsoft_Label_Control(_t('Email'));
    $emailCol->DataBinding = new Amhsoft_Data_Binding('email1');
    $usernameCol = new Amhsoft_Link_Control(_t('Username'),'?module=user&page=user-quicklist&event=select');
    $usernameCol->DisplayValue = "username";
    $usernameCol->DataBinding = new Amhsoft_Data_Binding('id','username');
    $telefonCol = new Amhsoft_Label_Control(_t('Telefon'));
    $telefonCol->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->dataGridView->AddColumn($usernameCol);
    $this->dataGridView->AddColumn($firstNameCol);
    $this->dataGridView->AddColumn($lastNameCol);
    $this->dataGridView->AddColumn($emailCol);
    $this->dataGridView->AddColumn($telefonCol);
  }

  /**
   * Initialize controller.
   */
  public function __select() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $userModelAdapter = new User_User_Model_Adapter();
      $userModel = $userModelAdapter->fetchById($id);
      if ($userModel instanceof User_User_Model) {
	if ($this->getRequest()->get('refresh') == 'false') {
	  $this->close(array('user' => $userModel->getFullName(), 'user_id' => $userModel->getId()));
	} else {
	  Amhsoft_Registry::register('user_quick_list_selected_id', $id);
	  $this->close();
	}
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->userModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->popup();
  }

}

?>
