<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
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
class Crm_Backend_Account_Group_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Group_Form $accountGroupForm */
  protected $accountGroupForm;

  /** @var Crm_Group_Model $accountGroupModel */
  protected $accountGroupModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->accountGroupForm = new Crm_Account_Group_Form('accountGroupForm_form', 'POST');
    $this->accountGroupModel = new Crm_Account_Group_Model();
    $this->getView()->setMessage(_t('Create new Account Group'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->accountGroupForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->accountGroupForm->isSend()) {
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

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=crm&page=group-account&ret=true');
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
