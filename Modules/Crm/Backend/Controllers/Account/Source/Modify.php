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

class Crm_Backend_Account_Source_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_Source_Form crmAccountSourceForm */
  protected $crmAccountSourceForm;

  /** @var Crm_Account_Source_Model crmAccountSourceModel */
  protected $crmAccountSourceModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->crmAccountSourceForm = new Crm_Account_Source_Form('crmAccountSourceForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Source'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $crmAccountSourceModelAdapter = new Crm_Account_Source_Model_Adapter();
      $this->crmAccountSourceModel = $crmAccountSourceModelAdapter->fetchById($id);
    }
    if (!$this->crmAccountSourceModel instanceof Crm_Account_Source_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->crmAccountSourceForm->DataSource = new Amhsoft_Data_Set($this->crmAccountSourceModel);
    $this->crmAccountSourceForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->crmAccountSourceForm->isSend()) {
      $this->crmAccountSourceForm->DataSource = Amhsoft_Data_Source::Post();
      $this->crmAccountSourceForm->Bind();
      if ($this->crmAccountSourceForm->isValid()) {
	$this->crmAccountSourceForm->DataBinding = $this->crmAccountSourceModel;
	$crmAccountSourceModelAdapter = new Crm_Account_Source_Model_Adapter();
	$this->crmAccountSourceModel = $this->crmAccountSourceForm->getDataBindItem();
	$crmAccountSourceModelAdapter->save($this->crmAccountSourceModel);
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
    Amhsoft_Navigator::go(Amhsoft_History::back() . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->crmAccountSourceForm);
    $this->show();
  }

}
?>

