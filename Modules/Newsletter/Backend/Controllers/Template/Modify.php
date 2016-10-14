<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Template_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Template_Form newsletterTemplateForm */
  protected $newsletterTemplateForm;

  /** @var Newsletter_Template_Model newsletterTemplateModel */
  protected $newsletterTemplateModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->newsletterTemplateForm = new Newsletter_Template_Form('newsletterTemplateForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Newsletter template'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $newsletterTemplateModelAdapter = new Newsletter_Template_Model_Adapter();
      $this->newsletterTemplateModel = $newsletterTemplateModelAdapter->fetchById($id);
    }
    if (!$this->newsletterTemplateModel instanceof Newsletter_Template_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->newsletterTemplateForm->DataSource = new Amhsoft_Data_Set($this->newsletterTemplateModel);
    $this->newsletterTemplateForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->newsletterTemplateForm->isSend()) {
      $this->newsletterTemplateForm->DataSource = Amhsoft_Data_Source::Post();
      $this->newsletterTemplateForm->Bind();
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
    Amhsoft_Navigator::go('admin.php?module=newsletter&page=template-list&ret=true ');
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

