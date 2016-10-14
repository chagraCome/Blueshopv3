<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: add.class.php 505 2012-03-08 12:12:18Z cherif $
 * $Rev: 505 $
 * @package    Setting
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2012-03-08 13:12:18 +0100 (Do, 08 Mrz 2012) $
 * $LastChangedDate: 2012-03-08 13:12:18 +0100 (Do, 08 Mrz 2012) $
 * $Author: cherif $
 * *********************************************************************************************** */

class Setting_Backend_Template_Email_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Setting_EmailTemplate_Form $emailTemplateForm */
  protected $emailTemplateForm;

  /** @var Setting_EmailTemplate_Model $emailTemplateModel */
  protected $emailTemplateModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->emailTemplateForm = new Setting_Template_Email_Form('emailTemplateForm_form', 'POST');
    $this->emailTemplateModel = new Setting_Template_Email_Model();
    $this->getView()->setMessage(_t('Create new Email Template'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->emailTemplateForm->isSend()) {
      if ($this->emailTemplateForm->isFormValid()) {
	$this->emailTemplateForm->DataBinding = $this->emailTemplateModel;
	$emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
	$this->emailTemplateModel = $this->emailTemplateForm->getDataBindItem();
	$emailTemplateModelAdapter->save($this->emailTemplateModel);
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
    $this->getRedirector()->go('admin.php?module=setting&page=template-email-list&ret=true');
  }

  /*
   * Finalize Event
   */

  public function __finalize() {
    $this->getView()->assign('form', $this->emailTemplateForm);
    $this->show();
  }

}

?>
