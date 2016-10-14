<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Template_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Template_Form newsletterTemplateForm */
  protected $newsletterTemplateForm;

  /** @var Newsletter_Template_Model newsletterTemplateModel */
  protected $newsletterTemplateModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->newsletterTemplateForm = new Newsletter_Template_Form('newsletterTemplateForm_form', 'POST');
    $this->newsletterTemplateModel = new Newsletter_Template_Model();
    $this->getView()->setMessage(_t('Add NewsLetter Template'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->newsletterTemplateForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->newsletterTemplateForm->isSend()) {
      if ($this->newsletterTemplateForm->isValid()) {
	$this->newsletterTemplateForm->DataBinding = $this->newsletterTemplateModel;
	$newsletterTemplateModelAdapter = new Newsletter_Template_Model_Adapter();
	$this->newsletterTemplateModel = $this->newsletterTemplateForm->getDataBindItem();
	$newsletterTemplateModelAdapter->save($this->newsletterTemplateModel);
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
    Amhsoft_Navigator::go('admin.php?module=newsletter&page=template-list&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->newsletterTemplateForm);
    $this->show();
  }

}

?>