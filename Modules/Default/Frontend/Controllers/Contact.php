<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Contact.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Default_Frontend_Contact_Controller extends Amhsoft_System_Web_Controller {

  /** @var Default_ContactUs_Form $contactForm */
  public $contactForm;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->contactForm = new Default_ContactUs_Form('contact_us', 'POST');
    $this->pageId = $this->getRequest()->getInt('lid');
  }

  /**
   * Default event
   */
  public function __default() {
    $this->contactForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->contactForm->isSend()) {
      if ($this->contactForm->isValid()) {
//        $notificationModel = new Crm_Notification_Contact_Model();
//        $notificationModel->newContactUsFormSubmitted($this->contactForm);
	Amhsoft_Navigator::go('index.php?module=default&page=contactsend');
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
      $pageModelAdapter = new Cms_Page_Model_Adapter();
      $page = $pageModelAdapter->fetchByAlias('default.frontend.contact.default');
      if ($page instanceof Cms_Page_Model) {
	$this->contactForm->htmlInfo->setHtml($page->getContent());
      }
    }
    $this->getView()->assign('form', $this->contactForm);
    $this->show();
  }

}

?>
