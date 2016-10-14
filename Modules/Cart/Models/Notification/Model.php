<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cart_Notification_Model {

    protected $saleorderConfiguration;
    protected $saleorderModel;
    protected $throwsExceptions = false;

    function __construct(Saleorder_Model $saleorder, $throwsExceptions = false) {
        $this->saleorderModel = $saleorder;
        $this->throwsExceptions = ($throwsExceptions == true);
        $this->saleorderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
    }

    /**
     * Send Notifications.
     */
    public function notifySalesOrderSubmitted() {
        $this->notifyAdminSalesOrderSubmitted();
        $this->notifyAccountSalesOrderSubmitted();
    }

    /**
     * Notify Admin after add salesorder.
     */
    public function notifyAdminSalesOrderSubmitted() {
        $templateModel = $this->getSalesOrderSubmittedTemplate(Saleorder_State_Model::CREATED_ADMIN_EMAIL_TEMPLATE);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $saleOrderModel = $saleOrderModelAdapter->fetchById($this->saleorderModel->getId());

            if ($saleOrderModel instanceof Saleorder_Model) {
                $this->saleorderModel = $saleOrderModel;
            }
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this->saleorderModel)));
        } else {
            $subject = _t('New sales order was submitted');
            $content = _t('New Sales order was submitted');
        }
        $fromID = $this->saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
		$data = Webmail_Setting_Model::getMailClientOptionsById($fromID);
		$from = @$data['From'];
        $emailValidator = new Amhsoft_Email_Validator($from);
		 
        if ($emailValidator->isValid()) {
            $this->sendEmail($from, $fromID, $subject, $content);
        } else {
            Amhsoft_Log::error('Main not valid :' . $from);
        }
    }

    /**
     * Notify Account after add salesorder.
     */
    public function notifyAccountSalesOrderSubmitted() {

        $templateModel = $this->getSalesOrderSubmittedTemplate(Saleorder_State_Model::CREATED_CUSTOMER_EMAIL_TEMPLATE);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this->saleorderModel)));
        } else {
            $subject = _t('Your sales order was submitted');
            $content = _t('Dear Customer');
            $content .= ',<br />';
            $content .= _t('Your Sales order was submitted') . '<br />';
            $content .= _t('Best regards');
        }
        $from = $this->saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $this->sendEmail($this->saleorderModel->account->getEmail(), $from, $subject, $content);
    }

    /**
     * Gets Email Template By State.
     * @param type $state
     * @return type
     */
    public function getSalesOrderSubmittedTemplate($state) {
        $templateID = $state;
        $emailTemplateModel = null;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
        }
        return $emailTemplateModel;
    }

    /**
     * Send Email .
     * @param type $to
     * @param type $from
     * @param type $subject
     * @param type $message
     */
    public function sendEmail($to, $from, $subject, $message) {
        //try to send email
        try {
            $mailClient = new Amhsoft_Mail_Client(null, $from);
            $data = Webmail_Setting_Model::getMailClientOptionsById($from);
            
            $mailClient->AddAddress($to);
            $mailClient->setSubject($subject);
            $mailClient->SetFrom(@$data['From']);
            $mailClient->SetHtmlBody($message);
            $mailClient->Send();
            return true;
        } catch (Exception $e) {
            if ($this->throwsExceptions == false) {
                Amhsoft_Log::error('cart model notification: email cannot be send');
                return false;
            } else {
                throw $e;
            }
        }
    }

    protected function sendSMS($to, $message) {
        Amhsoft_Log::info('SMS WILL BE SEND TO' . $to . ' message : ' . $message);
    }

}

?>
