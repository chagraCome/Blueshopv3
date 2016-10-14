<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Contact.php 236 2016-02-01 14:21:29Z imen.amhsoft $
 * $Rev: 236 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-01 15:21:29 +0100 (lun., 01 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Contact_Controller extends Amhsoft_System_Web_Controller {

    public $contactForm;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=contact', 'label' => _t('Contact Us')));
        $this->contactForm = new Crm_ContactRes_Form('contact_form', 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->contactForm->isSend()) {
            $this->contactForm->DataSource = Amhsoft_Data_Source::Post();
            $this->contactForm->Bind();
            if ($this->contactForm->isFormValid()) {
                $this->insertContact($this->contactForm->getValues());
                $notificationModel = new Crm_Notification_Contact_Model();
                $notificationModel->newContactUsFormSubmitted($this->contactForm);
                Amhsoft_Navigator::go('index.php?module=crm&page=contactsend');
            } else {
                $this->getView()->assign('message', _t('Cannot send message please try again'));
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
        $pageModelAdapter = new Cms_Page_Model_Adapter();
        $page = $pageModelAdapter->fetchByAlias('crm.frontend.contact.default');
        if ($page instanceof Cms_Page_Model) {
            $this->getView()->assign('pageContent', $page->getContent());
        }
        $this->getView()->assign('formn', $this->contactForm);
        $this->show();
    }

}

?>
