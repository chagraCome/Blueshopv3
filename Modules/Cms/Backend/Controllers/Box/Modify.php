<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Cms_Backend_Box_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Box_Form $cmsBoxForm */
  protected $cmsBoxForm;

  /** @var Cms_Box_Model $cmsBoxModel */
  protected $cmsBoxModel;

  /**
   * Initialize Controller
   * 
   */
  public function __initialize() {
    $this->cmsBoxForm = new Cms_Box_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Block'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsBoxModelAdapter = new Cms_Box_Model_Adapter();
      $this->cmsBoxModel = $cmsBoxModelAdapter->fetchById($id);
    }
    if (!$this->cmsBoxModel instanceof Cms_Box_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    if ($this->cmsBoxModel->file != null) {
      $this->cmsBoxForm->removeByName('html');
    } else {
      $this->cmsBoxForm->removeByName('file');
    }
    $this->cmsBoxForm->DataSource = new Amhsoft_Data_Set($this->cmsBoxModel);
    $this->cmsBoxForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->cmsBoxForm->isSend()) {
      $this->cmsBoxForm->Bind();
      if ($this->cmsBoxForm->isFormValid()) {
	$this->cmsBoxForm->DataBinding = $this->cmsBoxModel;
	$cmsBoxModelAdapter = new Cms_Box_Model_Adapter();
	$cmsBoxModel = $this->cmsBoxForm->getDataBindItem();
	$cmsBoxModelAdapter->save($cmsBoxModel);
	$this->getRedirector()->go('admin.php?module=cms&page=box-list' . '&ret=true');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->cmsBoxForm);
    $this->show();
  }

}

?>
