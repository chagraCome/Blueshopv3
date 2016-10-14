<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Generate.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Backend_Account_Document_Generate_Controller extends Amhsoft_System_Web_Controller {

  public $id;

  /** @var Crm_Account_Model $model * */
  public $model;

  /** @var Crm_Account_Document_Model $documentModel * */
  public $documentModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Generate a pdf document'), View_Message_Type::INFO);
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $adapter = new Crm_Account_Model_Adapter();
    $this->model = $adapter->fetchById($this->id);
    if (!$this->model instanceof Crm_Account_Model) {
      throw new Amhsoft_File_Not_Found_Exception();
    }
  }

  public function loadForm() {
    $panel = new Amhsoft_Widget_Panel(_t('Template'));
    $panel2 = new Amhsoft_Widget_Panel(_t('Content'));
    $form = new Amhsoft_Widget_Form('template_form', 'POST');
    $templateDirectoryInput = new Amhsoft_DirectoryInput_Control('emailtemplate', _t('Select from template'));
    $templateDirectoryInput->PopUpUrl = 'admin.php?module=setting&page=template-email-quicklist&target=account&target_id=' . $this->id;
    $templateDirectoryInput->OnlyIcon = true;
    $templateDirectoryInput->setWidth(200);
    $content = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Content'));
    $content->DataBinding = new Amhsoft_Data_Binding('content');
    $publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 1);
    $submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Generate PDF"));
    $submitButton->Class = "ButtonSave";
    $panel->addComponent($templateDirectoryInput);
    $panel2->addComponent($content);
    $panel2->addComponent($publicYesNoListBox);
    $panel2->addComponent($submitButton);
    $form->addComponent($panel);
    $form->addComponent($panel2);
    $this->getView()->assign('form', $form);
  }

  public function generate($content) {
    $pdf = new Amhsoft_PDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();
    $content = htmlspecialchars_decode($content);
    $pdf->writeHtml($content);
    $this->documentModel = new Crm_Account_Document_Model();
    $this->documentModel->setName($this->model->getNumber() . '-' . $this->model->getName() . '.pdf');
    $this->documentModel->setPublic($this->getRequest()->postInt('public'));
    $this->documentModel->setExtention("pdf");
    $this->documentModel->setType('Document');
    $this->documentModel->setFolder('media/account/docs');
    $documentAdapter = new Crm_Account_Document_Model_Adapter();
    $documentAdapter->save($this->documentModel);
    if ($this->documentModel->getId() > 0) {
      $pdf->Output('media/account/docs/' . $this->documentModel->getId() . '.pdf', 'F');
    }
    $saleorderModelAdapter = new Crm_Account_Model_Adapter();
    $this->model->addDocument($this->documentModel);
    $e = $saleorderModelAdapter->save($this->model);
    $this->getRedirector()->go('admin.php?module=crm&page=account-detail&ret=true&id=' . $this->id);
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('submit')) {
      $this->generate($this->getRequest()->post('content'));
    }
    $this->loadForm();
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->show();
  }

}

?>
