<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cms_Backend_Box_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Box_Model */
  protected $boxModel;

  /** @var integer $id */
  protected $id;

  /** @var CmsBoxForm */
  protected $boxForm;

  /**
   * Initialize Compoenets.
   */
  public function __initialize() {
    $this->boxModel = new Cms_Box_Model();
    $this->boxForm = new Cms_Box_Form('cms_box_form', 'POST');
    $layout = $this->getRequest()->getInt('layout');
    if ($layout == 11) {
      $this->buildCategory();
    }
    if ($layout == 1 || $layout == 6) {
      $this->boxForm->borderYesNo->setDefaultValue(0);
      $this->boxForm->borderYesNo->Disabled = true;
    }
    $this->boxForm->removeByName('file');
  }

  protected function buildCategory() {
    $boxModelAdapter = new Cms_Box_Model_Adapter();
    $boxModel = new Cms_Box_Model();
    $boxModel->setFile('Modules/Product/Frontend/Views/Boxes/Category.tpl.html');
    $boxModel->setBorder(0);
    $boxModel->setName('Box Category');
    $boxModel->setOnline(1);
    $boxModelAdapter->save($boxModel);
    $this->getRedirector()->go('?module=cms&page=box-list');
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Add new Text Box'), View_Message_Type::INFO);
    if ($this->boxForm->isSend()) {
      if ($this->boxForm->isFormValid()) {
	$this->boxForm->DataBinding = $this->boxModel;
	$this->boxForm->Bind();
	$this->boxModel = $this->boxForm->getDataBindItem();
	$boxModelAdapter = new Cms_Box_Model_Adapter();
	$boxModelAdapter->save($this->boxModel);
	$this->getRedirector()->go('admin.php?module=cms&page=box-list' . '&ret=true');
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->boxForm);
    $this->show();
  }

}

?>
