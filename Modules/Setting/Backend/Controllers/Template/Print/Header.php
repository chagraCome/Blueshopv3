<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Header.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Seting 
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Setting_Backend_Template_Print_Header_Controller extends Amhsoft_System_Web_Controller {

  protected $headerTemplateForm;
  protected $printemailTemplateModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->headerTemplateForm = new Amhsoft_Widget_Form('headerform', 'POST');
    $variableList = new Amhsoft_WorkFlow_Attribute_ListBox_Control('variablelist', 'variablelist', _t('Variables'));
    $variableList->JavaScript = 'appendToTinyMce(this.value)';
    $headerTextArea = new Amhsoft_TextArea_Wysiwyg_Control('header', _t('Header'));
    $headerTextArea->DataBinding = new Amhsoft_Data_Binding('header');
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $submitButton->Class = 'ButtonSave';
    $this->headerTemplateForm->addComponent($variableList);
    $this->headerTemplateForm->addComponent($headerTextArea);
    $this->headerTemplateForm->addComponent($submitButton);
    $this->getView()->setMessage(_t('Edit header template'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $emailTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
      $this->printemailTemplateModel = $emailTemplateModelAdapter->fetchById($id);
    }
    if (!$this->printemailTemplateModel instanceof Setting_Template_Print_Model) {
      die('Requested Print template not found');
    }
    $this->headerTemplateForm->DataSource = new Amhsoft_Data_Set($this->printemailTemplateModel);
    $this->headerTemplateForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if (isset($_POST["submit"])) {
      $this->headerTemplateForm->DataSource = Amhsoft_Data_Source::Post();
      $this->headerTemplateForm->Bind();
      if ($this->headerTemplateForm->isValid()) {
	$this->headerTemplateForm->DataBinding = $this->printemailTemplateModel;
	$emailTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
	$this->printemailTemplateModel = $this->headerTemplateForm->getDataBindItem();
	$emailTemplateModelAdapter->save($this->printemailTemplateModel);
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
    $this->getRedirector()->go('admin.php?module=setting&page=template-print-modify&id=' . $this->getRequest()->getId() . '&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->headerTemplateForm);
    $this->show();
  }

}

?>
