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

class Cms_Backend_Menu_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Menu_Form $cmsMenuForm */
  protected $cmsMenuForm;

  /** @var Cms_Menu_Model $cmsMenuModel */
  protected $cmsMenuModel;

  /**
   * Initialize Controller
   * 
   */
  public function __initialize() {
    $this->cmsMenuForm = new Cms_Menu_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Menu Point'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
      $this->cmsMenuModel = $cmsMenuModelAdapter->fetchById($id);
    }
    if (!$this->cmsMenuModel instanceof Cms_Menu_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->cmsMenuForm->pageListbox->Value = $this->cmsMenuModel->page;
    $selectedpage = Amhsoft_Registry::get('page_quick_list_selected_id');
    $this->getView()->assign('pre_parent_id', $this->cmsMenuModel->parent_id);
    if ($selectedpage) {
      $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
      $cmspage = $cmsPageModelAdapter->fetchById($selectedpage);
      if ($cmspage instanceof Cms_Page_Model) {
	$this->cmsMenuForm->pageListbox->Value = $cmspage;
	$this->cmsMenuModel->page = $cmspage;
      }
      //destroy session after adding product to quotation
      Amhsoft_Registry::destroy('page_quick_list_selected_id');
    }
    //to fix javascript
    $this->cmsMenuForm->addComponent(new Amhsoft_Hidden_Control("selected_parent", new Amhsoft_Data_Binding("parent_id")));
    $this->cmsMenuForm->parentListBox->setValue($this->getRequest()->getInt(''));
    $this->cmsMenuForm->DataSource = new Amhsoft_Data_Set($this->cmsMenuModel);
    $this->cmsMenuForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->cmsMenuForm->isSend()) {
      $this->cmsMenuForm->DataSource = Amhsoft_Data_Source::Post();
      $this->cmsMenuForm->Bind();
      if ($this->cmsMenuForm->isValid()) {
	$this->cmsMenuForm->DataBinding = $this->cmsMenuModel;
	$cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
	@$this->cmsMenuModel = $this->cmsMenuForm->getDataBindItem();
	if (!$this->cmsMenuModel->isMainMenu()) {
	  $cms_main_menu_override = Cms_Menu_Model_Adapter::getMainMenuIdByParentID($this->cmsMenuModel->parent_id);
	  if ($cms_main_menu_override > 0)
	    $this->cmsMenuModel->cms_main_menu_id = $cms_main_menu_override;
	}
	@$this->cmsMenuModel->cms_page_id = ($this->getRequest()->postInt('cms_page_id') == 0) ? null : $this->getRequest()->postInt('cms_page_id');
	$cmsMenuModelAdapter->save($this->cmsMenuModel);
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
    $this->getRedirector()->go('admin.php?module=cms&page=menu-list' . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->includeJsFile('cms-modify-menu.js');
    $this->getView()->assign('form', $this->cmsMenuForm);
    $this->show();
  }

}

?>
