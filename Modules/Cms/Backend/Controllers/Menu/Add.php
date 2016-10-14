<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Backend_Menu_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Menu_Form $cmsMenuForm */
  protected $cmsMenuForm;

  /** @var Cms_Menu_Model $cmsMenuModel */
  protected $cmsMenuModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->cmsMenuForm = new Cms_Menu_Form('cmsMenuForm_form', 'POST');
    $this->cmsMenuModel = new Cms_Menu_Model();
    $this->getView()->setMessage(_t('Create new Menu Item'), View_Message_Type::INFO);
    $selectedpage = Amhsoft_Registry::get('page_quick_list_selected_id');
    if ($selectedpage) {
      $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
      $cmspage = $cmsPageModelAdapter->fetchById($selectedpage);
      if ($cmspage instanceof Cms_Page_Model) {
	$this->cmsMenuForm->pageListbox->Value = $cmspage;
      }
    }
    //destroy session after adding product to quotation
    Amhsoft_Registry::destroy('page_quick_list_selected_id');
    $menuId = $this->getRequest()->getInt('menuid');
    if ($menuId > 0) {
      $mainMenusAdapter = new Cms_Menu_Model_Adapter();
      $mainMenusAdapter->where('parent_id = ?', $menuId);
      $data = $mainMenusAdapter->fetch()->fetchAll();
      $this->cmsMenuForm->parentListBox->DataSource = new Amhsoft_Data_Set($data);
    } else {
      $this->includeJsFile('cms-add-menu.js');
    }
  }

  /**
   * Default event
   */
  public function __default() {
    $this->cmsMenuForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->cmsMenuForm->isSend()) {
      if ($this->cmsMenuForm->isFormValid()) {
	$this->cmsMenuForm->DataBinding = $this->cmsMenuModel;
	$cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
	$this->cmsMenuModel = $this->cmsMenuForm->getDataBindItem();
	$this->cmsMenuModel->cms_page_id = $this->getRequest()->postInt('cms_page_id');
	if (!$this->cmsMenuModel->isMainMenu()) {
	  $cms_main_menu_override = Cms_Menu_Model_Adapter::getMainMenuIdByParentID($this->cmsMenuModel->parent_id);
	  if ($cms_main_menu_override > 0)
	    $this->cmsMenuModel->cms_main_menu_id = $cms_main_menu_override;
	}
	$cmsMenuModelAdapter->save($this->cmsMenuModel);
	$this->handleSuccess();
      }else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('?module=cms&page=menu-list&ret=true');
  }

  /**
   * 
   */
  public function __parentsajax() {
    $mainmenuid = $this->getRequest()->getInt('mainmenuid');
    $selectedId = $this->getRequest()->getInt('parent_id');
    if ($mainmenuid > 0) {
      $menus = Cms_Menu_Model_Adapter::fetchAsTree(0, $mainmenuid);
      foreach ($menus as $m) {
	$selectedText = '';
	if ($selectedId == $m['id']) {
	  $selectedText = ' selected="selected" ';
	}
	echo '<option value="' . $m['id'] . '" ' . $selectedText . '>' . $m['title'] . '</option>';
      }
    }
    exit;
  }

  /**
   * 
   */
  public function __parentsajaxformodify() {
    $mainmenuid = $this->getRequest()->getInt('mainmenuid');
    $selectedId = $this->getRequest()->getInt('parent_id');
    if ($mainmenuid > 0) {
      $menus = Cms_Menu_Model_Adapter::fetchAsTree(0, $mainmenuid);
      foreach ($menus as $m) {
	$selectedText = '';
	if ($selectedId == $m['id']) {
	  $selectedText = ' selected="selected" ';
	}
	echo '<option value="' . $m['id'] . '" ' . $selectedText . '>' . $m['title'] . '</option>';
      }
    }
    exit;
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
