<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Notification_Contact_Model {

    /** @var Crm_Contact_Model $contactModel */
    protected $contactModel;

    const CONTACT_US_AUTO_REPLY = 18;

    /**
     * Construct a new contact notification model
     * @param Crm_Contact_Model $contact
     * @param type $oldState
     */
    public function __construct() {
        
    }

    public function newContactUsFormSubmitted(Crm_ContactRes_Form $form) {
        $subject = 'Conatct Us Form Submitted';
        $content = "Dear Wemaster" . ": <br />";
        $content .= "New Contact form was submited" . ": <br />";
        $content .="Informations" . ':' . " <br/>";
        $content .= "Name" . ':' . $form->nameInput->Value . "<br />";
        $content .= "Email" . ':' . $form->email1Input->Value . "<br />";
        $content .="Mobile" . ':' . $form->mobileInput->Value . "<br />";
        $content .= "Message" . ':' . $form->messageInput->Value . "<br />";
        $content .= "Best Regards ";
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $from = $accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
        $options = Webmail_Setting_Model::getMailClientOptionsById($from);
        $this->sendEmail($options['Username'], $from, $subject, $content);
    }
      public function newContactFormSubmitted(Crm_ContactUs_Form $form) {
        $subject = 'Conatct Us Form Submitted';
        $content = "Dear Wemaster" . ": <br />";
        $content .= "New Contact form was submited" . ": <br />";
        $content .="Informations" . ':' . " <br/>";
        $content .= "Name" . ':' . $form->nameInput->Value . "<br />";
        $content .= "Email" . ':' . $form->email1Input->Value . "<br />";
        $content .="Mobile" . ':' . $form->mobileInput->Value . "<br />";
        $content .= "Message" . ':' . $form->messageInput->Value . "<br />";
        $content .= "Best Regards ";
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $from = $accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
        $options = Webmail_Setting_Model::getMailClientOptionsById($from);
        $this->sendEmail($options['Username'], $from, $subject, $content);
    }

    public function replyToCustometContactUs(Crm_Contact_Model $contactModel) {
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $from = $accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
        $templateAdapter = new Setting_Template_Email_Model_Adapter();
        $templateModel = $templateAdapter->fetchById(Crm_Notification_Contact_Model::CONTACT_US_AUTO_REPLY);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $content = $templateModel->getFilledContent(array($contactModel));
        } else {
            $subject = 'Auto Reply for Contact us form';
            $content = "Dear " . $contactModel->getFullName() . "<br/>";
            $content .= "We have received your contact form , and we will contact you soon<br/>";
            $content .= "Best Regards";
        }
        $this->sendEmail($contactModel->getEmail(), $from, $subject, $content);
    }

    /**
     * Send Email .
     * @param type $to
     * @param type $from
     * @param type $subject
     * @param type $message
     */
    public function sendEmail($to, $from, $subject, $message) {
        try {
            $mailClient = new Amhsoft_Mail_Client(null, $from);
            $data = Webmail_Setting_Model::getMailClientOptionsById($from);

            $mailClient->AddAddress($to);
            $mailClient->setSubject($subject);
            $mailClient->SetHtmlBody(@htmlspecialchars_decode($message));
            $mailClient->SetFrom(@$data['From']);
            $mailClient->Send();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function notifyAdminContactAdded(Crm_Contact_Model $contact = null) {
        $this->contactModel = $contact;
        $template = $this->getContactAddedTemplate($this->contactModel);
        $mailClient = new Amhsoft_Mail_Client();
        $mailClient->SetSubject($template->getSubject());
        $mailClient->SetHtmlBody($template->getContent());
        $mailClient->Send();
    }

    protected function getContactAddedTemplate(Crm_Contact_Model $contact) {
        $template = new Setting_Template_Email_Model();
        $subject = "New contact added to Pro Edition";
        $content = "Dear Admin , <br/>";
        $content .="New Contact was added to metjar.com/pro <br />";
        $content .="Contact Inforamtions : <br/>";
        $content .="Contact Name :" . $contact->getFirstname() . "<br/>";
        $content .="Contact Email : " . $contact->getEmail() . "<br/>";
        $content .="Contact Mobile :" . $contact->getMobile() . "<br/>";
        $contactGroupModelAdapter = new Crm_Contact_Group_Model_Adapter();
        $groupModel = $contactGroupModelAdapter->fetchById($contact->contact_group_id);
        $content .="Contact Type : " . $groupModel->getName() . "<br/>";
        $content .="Notices : " . $contact->getNotice() . "<br/>";
        $content .="Best Regards <br/>";
        $template->setSubject($subject);
        $template->setContent($content);
        return $template;
    }

}

?>
