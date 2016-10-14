<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Setting_Backend_Template_Print_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Setting_Template_Print_Form $emailTemplateForm */
  protected $emailTemplateForm;

  /** @var Setting_Template_Print_Model $emailTemplateModel */
  protected $emailTemplateModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->emailTemplateForm = new Setting_Template_Print_Form('email_form', 'POST');
    $this->getView()->setMessage(_t('Edit Print template'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $emailTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
      $this->emailTemplateModel = $emailTemplateModelAdapter->fetchById($id);
    }
    if (!$this->emailTemplateModel instanceof Setting_Template_Print_Model) {
      die('Requested Print template not found');
    }
    $this->emailTemplateForm->DataSource = new Amhsoft_Data_Set($this->emailTemplateModel);
    $this->emailTemplateForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->emailTemplateForm->isSend()) {
      $this->emailTemplateForm->DataSource = Amhsoft_Data_Source::Post();
      $this->emailTemplateForm->Bind();
      if ($this->emailTemplateForm->isValid()) {
	$this->emailTemplateForm->DataBinding = $this->emailTemplateModel;
	$emailTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
	$this->emailTemplateModel = $this->emailTemplateForm->getDataBindItem();
       // var_dump($this->emailTemplateModel);exit;
	$emailTemplateModelAdapter->save($this->emailTemplateModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=saleorder&page=setting&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->emailTemplateForm);
    $this->show();
  }

}

?>
