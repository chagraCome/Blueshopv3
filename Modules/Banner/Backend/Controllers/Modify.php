<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Banner
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Banner_Backend_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var ImageForm $bannerForm */
  protected $bannerForm;

  /** @var ImageModel $bannerModel */
  protected $bannerModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->bannerForm = new Banner_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Banner'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $bannerModelAdapter = new Banner_Model_Adapter();
      $this->bannerModel = $bannerModelAdapter->fetchById($id);
    }
    if (!$this->bannerModel instanceof Banner_Model) {
      die('Requested Banner not found');
    }
    $this->bannerForm->DataSource = new Amhsoft_Data_Set($this->bannerModel);
    $this->bannerForm->Bind();
    $this->bannerForm->removeByName('banner_file');
    $this->bannerForm->removeByName('maxheight');
    $this->bannerForm->removeByName('maxwidth');
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->bannerForm->isSend()) {
      $this->bannerForm->DataSource = Amhsoft_Data_Source::Post();
      $this->bannerForm->Bind();
      if ($this->bannerForm->isValid()) {
	$this->bannerForm->DataBinding = $this->bannerModel;
	$bannerModelAdapter = new Banner_Model_Adapter();
	$this->bannerModel = $this->bannerForm->getDataBindItem();
	$bannerModelAdapter->save($this->bannerModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('?module=banner&page=list&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->bannerForm);
    $this->show();
  }

}

?>
