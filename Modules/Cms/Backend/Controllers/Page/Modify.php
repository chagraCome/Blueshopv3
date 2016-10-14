<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Backend_Page_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Page_Form $cmsPageForm */
  protected $cmsPageForm;

  /** @var Cms_Page_Model $cmsPageModel */
  protected $cmsPageModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->cmsPageForm = new Cms_Page_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Page'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
      $this->cmsPageModel = $cmsPageModelAdapter->fetchById($id);
    }
    if (!$this->cmsPageModel instanceof Cms_Page_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->cmsPageForm->DataSource = new Amhsoft_Data_Set($this->cmsPageModel);
    $this->cmsPageForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->cmsPageForm->isSend()) {
      $this->cmsPageForm->Bind();
      if ($this->cmsPageForm->isFormValid()) {
	$this->cmsPageForm->DataBinding = $this->cmsPageModel;
	$cmsPageModelAdapter = new Cms_Page_Model_Adapter();
	$this->cmsPageModel = $this->cmsPageForm->getDataBindItem();
	$cmsPageModelAdapter->save($this->cmsPageModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Action after success.
   */
  protected function handleSuccess() {
    if ($this->cmsPageModel->getInherit_design_from_site()) {
      Cms_Page_Model::inheritDesignFromSite($this->cmsPageModel->getId(), $this->cmsPageModel->cms_site_id);
    }
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->cmsPageForm);
    $this->show();
  }

}

?>
