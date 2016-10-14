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
class Crm_Notification_Account_Model {

    const WELCOME_EMAIl_TEMPLATE = 1;
    const RESET_PASSWORD_EMAIL_TEMPLATE = 14;
    const ACCOUNT_REGISTRED_EMAIL_TEMPLATE = 15;

    protected $accountConfiguration;
    protected $accountModel;
    protected $throwsExceptions = false;

    function __construct(Crm_Account_Model $account, $throwsExceptions = false) {
        $this->accountModel = $account;
        $this->throwsExceptions = ($throwsExceptions == true);
        $this->accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    }

    public function notifyAdminAccountRegistred() {
        $templateID = Crm_Account_Model::ACCOUNT_REGISTRED_EMAIL_TEMPLATE;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
            if ($emailTemplateModel instanceof Setting_Template_Email_Model) {
                $from = $this->accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
                $data = Webmail_Setting_Model::getMailClientOptionsById($from);
                $to = @$data['From'];
                $this->sendEmail($to, $from, $emailTemplateModel->getSubject(), $emailTemplateModel->getFilledContent(array($this->accountModel)));
            }
        }
        return true;
    }

    /**
     * Check Notification methods , and send Notification.
     */
    public function notifyAccountRegistred() {
        $this->notifyAccountByEmail();
        return true;
    }

    /**
     * Notify Account throw Email.
     * @return boolean
     */
    public function notifyAccountByEmail() {
        $from = $this->accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
        $templateID = Crm_Account_Model::WELCOME_EMAIl_TEMPLATE;
        $emailTemplateModel = null;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
        }
        if ($emailTemplateModel instanceof Setting_Template_Email_Model) {
            $this->sendEmail($this->accountModel->getEmail(), $from, $emailTemplateModel->getSubject(), $emailTemplateModel->getFilledContent(array($this->accountModel)));
        } else {
            $subject = _t('Welcome To Our Shop');
            $content = _t("Dear %s", $this->accountModel->name);
            $content .= '<br/>';
            $content .= _t("Welcome to our Shop, we wish you happy times");
            $content .='<br />';
            $content .= _t('Best Regards');
            $this->sendEmail($this->accountModel->getEmail(), $subject, $content);
        }
        return true;
    }

	  public function sendPasswordResetTokenByEmail($token) {
    $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
    $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $emailTemlate = $emailTemplateModelAdapter->fetchById(Crm_Notification_Account_Model::RESET_PASSWORD_EMAIL_TEMPLATE);
    if (!$emailTemlate instanceof Setting_Template_Email_Model) {
      $emailTemlate = new Setting_Template_Email_Model();
      $subject = _t('Reset password');
      $emailTemlate->setSubject($subject);
      $content = _t('Dear customer you can reset your password through the following link') . "\n";
      $content .= "__RESET_PASSWORD_LINK__";
      $content .= _t('Best regards');
      $emailTemlate->setContent($content);
    }
    $link = Amhsoft_System_Config::getProperty('appurl') . '/index.php?module=crm&page=intern-shop-resetpassword&token=' . $token;
    $vars = array(
        '__RESET_PASSWORD_LINK__' => $link
    );
    $content = $emailTemlate->getFilledContent(array($this->accountModel, $vars));
    $subject = $emailTemlate->getSubject();
    $from = $accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
    $this->sendEmail($this->accountModel->getEmail(), $from, $subject, $content);
    return true;
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
            $mailClient->SetFrom(@$data['From']);
            $mailClient->SetHtmlBody(@htmlspecialchars_decode($message));
            $mailClient->Send();
	  
            return true;
        } catch (Exception $e) {
            if ($this->throwsExceptions == false) {
                return false;
            } else {
                throw $e;
            }
        }
    }

    public function sendPassword($password) {
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $templateID = $accountConfiguration->getIntValue(Crm_Account_Model::SEND_PASSWORD_EMAIl_TEMPLATE);
        $emailTemplateModel = null;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
        }
        if ($emailTemplateModel instanceof Setting_Template_Email_Model) {
            $subject = $emailTemplateModel->getSubject();
            $this->accountModel->password = $password;
            $message = $emailTemplateModel->getFilledContent(array($this->accountModel));
        } else {
            $subject = _t("New Password");
            $message = _t("Dear") . " " . $this->accountModel->getName() . " , <br />";
            $message .= _t("Your new Password is") . " : " . $this->accountModel->getPassword() . " <br/>";
            $message .=_t("Best Regards");
        }
        $from = $accountConfiguration->getValue(Crm_Account_Model::FROM_EMAIL);
        $this->sendEmail($this->accountModel->email1, $from, $subject, $message);
    }

    public function notifyAdminConfirmPaymentSend($saleOrderModel, $data) {
        $content = _t("Dear Webmaster") . ", <br/>";
        $content .= _t("New Payment confirmation for a Sales Order") . "<br />";
        $content .= _t("Sales Order informations") . " : <br />";
        $content .= _t("Sales Order title") . " :" . $saleOrderModel->name . "<br/>";
        $content .= _t("Sales Order amount") . " : " . $saleOrderModel->total_price . "<br/>";
        $content .= _t("Sales Order number") . " :" . $saleOrderModel->number . "<br />";
        $content .= "<br />";
        $content .= _t("Confirm Payment informations") . " : <br />";
        $content .= _t("Name") . " : " . $this->confirmPaymentForm->nameInput->Value . "<br /> ";
        $content .= _t("Email") . " : " . $this->confirmPaymentForm->emailInput->Value . "<br />";
        $content .= _t("Mobile") . " : " . $this->confirmPaymentForm->mobileInput->Value . "<br />";
        $content .= _t("Transferred amount") . " : " . $this->confirmPaymentForm->amountInput->Value . "<br />";
        $content .= _t("Bank Account number") . " : " . $this->confirmPaymentForm->bankAccountNumberInput->Value . "<br />";
        $content .= _t("Transaction id") . " : " . $this->confirmPaymentForm->transfertIdInput->Value . "<br />";
        $content .= _t("Payment Method name") . " :" . $this->confirmPaymentForm->paymentMethodName->Value . "<br />";
        $content .= _t("Payment done at") . " : " . $this->confirmPaymentForm->paymentDateTime->Value . "<br />";
        $content .= _t("Description") . " : " . $this->confirmPaymentForm->descriptionTextArea->Value . "<br />";
        $content .= _t("Best Regards");
        $subject = _t('Sales Order Payment confirmation');
        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $from = $$saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);

        $data = Webmail_Setting_Model::getMailClientOptionsById($from);
        $to = @$data['From'];
        $this->sendEmail($to, $from, $subject, $content);
    }

}

?>