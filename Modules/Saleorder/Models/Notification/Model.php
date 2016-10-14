<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 414 2016-02-11 15:45:51Z amira.amhsoft $
 * $Rev: 414 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-11 16:45:51 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 */
class Saleorder_Notification_Model {

    public static function notifyAdminCommentSubmitted(Saleorder_Model $saleorder) {
        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $settingsId = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $mainClient = new Amhsoft_Mail_Client(null, $settingsId);
        $data = Webmail_Setting_Model::getMailClientOptionsById($settingsId);
        $fromEmail = @$data['From'];
        $mainClient->SetFrom($fromEmail);
        $mainClient->AddAddress($fromEmail);
        $templateAdapter = new Setting_Template_Email_Model_Adapter();
        $template = $templateAdapter->fetchById(Saleorder_Model::SALEORDER_ADD_NOTIFICATION_TEMPLATE);
        if ($template instanceof Setting_Template_Email_Model) {
            $body = $template->getFilledContent(array($saleorder));
            $mainClient->SetSubject($template->getSubject());
        } else {
            $body = "Dear Admin<br />new comment added to order number:" . $saleorder->getNumber();
            $mainClient->SetSubject(_t('Comment On') . ' ' . _t('Saleorder') . ' ' . _t('No.') . '[' . $saleorder->getNumber() . ']');
        }

        $mainClient->SetHtmlBody($body);
        $mainClient->Send();
    }

    public static function notifyCustomerCommentSubmitted(Saleorder_Model $saleorder) {

        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $settingsId = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $mainClient = new Amhsoft_Mail_Client(null, $settingsId);
        $data = Webmail_Setting_Model::getMailClientOptionsById($settingsId);
        $fromEmail = @$data['From'];
        $mainClient->SetFrom($fromEmail);

        $accountModelAdapter = new Crm_Account_Model_Adapter();

        $accountModel = $accountModelAdapter->fetchById($saleorder->account_id);
        if ($accountModel instanceof Crm_Account_Model) {
            $mainClient->AddAddress($accountModel->getEmail());
        }
        $templateAdapter = new Setting_Template_Email_Model_Adapter();
        $template = $templateAdapter->fetchById(Saleorder_Model::SALEORDER_ADD_ADMIN_NOTIFICATION_TEMPLATE);

        if ($template instanceof Setting_Template_Email_Model) {
            $mainClient->SetSubject($template->getSubject());
            $body = $template->getFilledContent(array($saleorder));
        } else {
            $mainClient->SetSubject(_t('Reply On') . ' ' . _t('Saleorder') . ' ' . _t('No') . '[' . $saleorder->getNumber() . ']');
            $body = "Dear " . $accountModel->getName() . "<br />new reply added to order number:" . $saleorder->getNumber();
        }
        $mainClient->SetHtmlBody($body);
        $mainClient->Send();
    }

    public static function notifyCustomerReplayCommentSubmitted(Saleorder_Model $saleorder) {

        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $settingsId = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $mainClient = new Amhsoft_Mail_Client(null, $settingsId);
        $data = Webmail_Setting_Model::getMailClientOptionsById($settingsId);
        $fromEmail = @$data['From'];
        $mainClient->SetFrom($fromEmail);
        $accountModelAdapter = new Crm_Account_Model_Adapter();
        $accountModel = $accountModelAdapter->fetchById($saleorder->account_id);
        if ($accountModel instanceof Crm_Account_Model) {
            $mainClient->AddAddress($accountModel->getEmail());
        }
        $templateAdapter = new Setting_Template_Email_Model_Adapter();
        $template = $templateAdapter->fetchById(Saleorder_Model::SALEORDER_REPLY_NOTIFICATION_TEMPLATE);

        if ($template instanceof Setting_Template_Email_Model) {
            $mainClient->SetSubject($template->getSubject());
            $body = $template->getFilledContent(array($saleorder));
        } else {
            $mainClient->SetSubject(_t('Reply On') . ' ' . _t('Saleorder') . ' ' . _t('No') . '[' . $saleorder->getNumber() . ']');
            $body = "Dear " . $accountModel->getName() . "<br />new reply added to order number:" . $saleorder->getNumber();
        }
        $mainClient->SetHtmlBody($body);
        $mainClient->Send();
    }

    public static function updateStateNotification(Saleorder_Model $saleorder, $subject, $message) {
        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter('saleorder');
        $from = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $settingsId = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $mainClient = new Amhsoft_Mail_Client(null, $settingsId);
        $data = Webmail_Setting_Model::getMailClientOptionsById($settingsId);
        $fromEmail = @$data['From'];
        $mainClient->SetFrom($fromEmail);
        if ($saleorder->account == NULL || $saleorder->account == NULL) {
            Amhsoft_Log::error("saleorder not related to accountr or contact, $message", array($mainClient));
            return;
        }

        $bccs = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_BCCS);
        $_bccs = array();
        if ($bccs) {
            $_bccs[] = explode(',', $bccs);
        }
        $adapter = new Webmail_Setting_Model_Adapter();
        $model = $adapter->fetchById($from);

        if ($model instanceof Webmail_Setting_Model) {
            //var_dump($model->email);    exit();
            $mainClient->SetFrom($model->email);
        }
        if ($saleorder->account instanceof Crm_Account_Model) {
            $mainClient->AddAddress($saleorder->account->getEmail());
            //var_dump($saleorder->account->getEmail());      exit();
        }
        $mainClient->setSubject("Re:#" . $saleorder->getNumber() . " : " . $subject);

        //$mainClient->SetFrom($from);
        foreach ((array) $_bccs as $bcc) {
            $mainClient->AddBCC($bcc);
        }
        $mainClient->SetHtmlBody($message);
        $mainClient->Send();

        if ($mainClient->IsError()) {
            Amhsoft_Log::error("cannot send email , $subject , $message", array($mainClient));
        }
    }

}
