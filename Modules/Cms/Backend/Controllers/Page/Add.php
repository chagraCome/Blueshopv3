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

class Cms_Backend_Page_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Page_Form $cmsPageForm */
  protected $cmsPageForm;

  /** @var Cms_Page_Model $cmsPageModel */
  protected $cmsPageModel;

  /*
   * Initialize Controller
   */

  public function __initialize() {
    $this->cmsPageForm = new Cms_Page_Form('cmsPageForm_form', 'POST');
    $this->cmsPageModel = new Cms_Page_Model();
    $this->getView()->setMessage(_t('Create new Page'), View_Message_Type::INFO);
    $this->cmsPageForm->contentTextArea->Value = $this->fetchLayout();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->cmsPageForm->isSend()) {
      if ($this->cmsPageForm->isFormValid()) {
	$this->cmsPageForm->DataBinding = $this->cmsPageModel;
	$cmsPageModelAdapter = new Cms_Page_Model_Adapter();
	$this->cmsPageModel = $this->cmsPageForm->getDataBindItem();
	$cmsPageModelAdapter->save($this->cmsPageModel);
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
    $this->getView()->setMessage(_t('Page was successully added'), View_Message_Type::INFO);
    if ($this->cmsPageModel->getInherit_design_from_site()) {
      Cms_Page_Model::inheritDesignFromSite($this->cmsPageModel->getId(), $this->cmsPageModel->cms_site_id);
    }
    //TODO: @cherif check this commented code.
    //$this->customizePageDesignReferencedToSite($this->cmsPageModel->cms_site_id);
    $this->getRedirector()->go("?module=cms&page=page-list" . "&ret=true");
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->cmsPageForm);
    $this->show();
  }

  protected function customizePageDesignReferencedToSite($siteId) {
    $sql_select = "SELECT * FROM cms_site_has_cms_box WHERE cms_site_id = $siteId";
    $sql_insert = "INSERT INTO cms_page_has_cms_box(cms_page_id, cms_box_id, `position`, sortid) VALUES(:pid, :bid, :p, :s)";
    $stmt_insert = Amhsoft_DataBase::getInstance()->prepare($sql_insert);
    $stmt_select = Amhsoft_DataBase::getInstance()->query($sql_select);
    while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
      $stmt_insert->bindParam(':pid', $this->cmsPageModel->getId(), PDO::PARAM_INT);
      $stmt_insert->bindParam(':bid', $row['cms_box_id'], PDO::PARAM_INT);
      $stmt_insert->bindParam(':p', $row['position'], PDO::PARAM_INT);
      $stmt_insert->bindParam(':s', $row['sortid'], PDO::PARAM_INT);
      $stmt_insert->execute();
    }
  }

  /**
   * Fetch Layout
   * @return string
   */
  protected function fetchLayout() {
    if ($this->getRequest()->isGet('layout')) {
      switch ($this->getRequest()->get('layout')) {
	case '2r':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/2rows_template.tmpl");
	  break;
	case '2c':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/2columns_template.tmpl");
	  break;
	case '2r2ct':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/2r2ct.tmpl");
	  break;
	case '2r2cb':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/2r2cb.tmpl");
	  break;
	case '2r2c':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/2r2c.tmpl");
	  break;
	case '3r':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/3r.tmpl");
	  break;
	case '3r2ct':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/3r2ct.tmpl");
	  break;
	case '3r2cm':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/3r2cm.tmpl");
	  break;
	case '3r2cb':
	  return $this->getView()->fetch($this->getView()->getLayoutPath() . "/templates/3r2cb.tmpl");
	  break;
	default:
	  return '';
	  break;
      }
    } else {
      return '';
    }
  }

}

?>
