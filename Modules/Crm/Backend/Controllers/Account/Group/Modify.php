<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of add
 *
 * @author cherif
 */
class Crm_Backend_Account_Group_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var account_Group_Form $accountGroupForm */
  protected $accountGroupForm;

  /** @var account_Group_Model $accountGroupModel */
  protected $accountGroupModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->accountGroupForm = new Crm_Account_Group_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Group'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $accountGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
      $this->accountGroupModel = $accountGroupModelAdapter->fetchById($id);
    }
    if (!$this->accountGroupModel instanceof Crm_Account_Group_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->accountGroupForm->DataSource = new Amhsoft_Data_Set($this->accountGroupModel);
    $this->accountGroupForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->accountGroupForm->isSend()) {
      $this->accountGroupForm->DataSource = Amhsoft_Data_Source::Post();
      $this->accountGroupForm->Bind();
      if ($this->accountGroupForm->isValid()) {
	$this->accountGroupForm->DataBinding = $this->accountGroupModel;
	$accountGroupModelAdapter = new Crm_Account_Group_Model_Adapter();
	$this->accountGroupModel = $this->accountGroupForm->getDataBindItem();
	$accountGroupModelAdapter->save($this->accountGroupModel);
	if ($this->accountGroupModel->as_default == 1) {
	  $this->setDefault();
	}
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  public function setDefault() {
    $id = $this->accountGroupModel->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $db = Amhsoft_Database::getInstance();
    $db->beginTransaction();
    try {
      $db->exec('UPDATE `account_group` SET as_default = 0');
      $db->exec('UPDATE `account_group` SET as_default = 1 WHERE id = ' . $id);
      $db->commit();
    } catch (Exception $e) {
      var_dump($e->getMessage());
      $db->rollBack();
    }
  }

  protected function handleSuccess() {
    $this->getRedirector()->go("admin.php?module=crm&page=group-account&ret=true");
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->accountGroupForm);
    $this->show();
  }

}

?>
