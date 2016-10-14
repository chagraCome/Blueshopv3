<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Contactus.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Frontend_Contactus_Controller extends Amhsoft_System_Web_Controller {

  public $contactForm;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->contactForm = new Crm_ContactUs_Form('contact_us', 'POST');
  }

  /**
   * Default event
   */
  public function __default() {
    $this->contactForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->contactForm->isSend()) {
      if ($this->contactForm->isValid()) {
	//$this->insertContact($this->contactForm->getValues());
	$notificationModel = new Crm_Notification_Contact_Model();
	$notificationModel->newContactFormSubmitted($this->contactForm);
	Amhsoft_Navigator::go('index.php?module=crm&page=contactsend');
      }
    }
  }

  public function insertContact($data) {
    $contactModel = new Crm_Contact_Model();
    $contactModel->number = $contactModel->getNextContactNumber();
    $contactModel->setFirstname($data['name']);
    $contactModel->setEmail($data['email1']);
    $contactModel->setMobile($data['mobile']);
    $contactModel->setNotice($data['message']);
    $contactModel->setUpdatedatetime(Amhsoft_Locale::UCTDateTime());
    $contactModelAdapter = new Crm_Contact_Model_Adapter();
    $contactModelAdapter->save($contactModel);
    $notificationModel = new Crm_Notification_Contact_Model();
    $notificationModel->replyToCustometContactUs($contactModel);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    if (Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
      $pageModelAdapter = new Cms_Page_Model_Adapter();
      $page = $pageModelAdapter->fetchByAlias('crm.frontend.contact');
      if ($page instanceof Cms_Page_Model) {
	$this->contactForm->infoPanel->setLabel($page->getTitle());
	$this->contactForm->htmlInfo->setHtml($page->getContent());
      }
    }
    $this->getView()->assign('form', $this->contactForm);
    $this->show();
  }

}

?>
