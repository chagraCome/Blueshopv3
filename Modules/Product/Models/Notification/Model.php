<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product_Notification_Model {

    public function notifyNotEnoughQuantity(Product_Product_Model $productModel) {
        $productConfig = new Amhsoft_Config_Table_Adapter('product');

        $emailTemplateID = $productConfig->getValue('stock_alert_email_template');
        $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
        $emailTemplateModel = $emailTemplateModelAdapter->fetchById($emailTemplateID);
        $subject = '';
        $content = '';
        if ($emailTemplateModel instanceof Setting_Template_Model) {
            $content = $emailTemplateModel->getFilledContent(array($productModel));
            $subject = $emailTemplateModel->getSubject();
        } else {
            $subject = _t('Product Quantity Alert');
            $content = "Dear Webmaster , <br/> Product has reached the minmum quantity in stock ,<br/> Product Information <br/> Product Name : " . $productModel->getTitle() . " <br/> Product Number : " . $productModel->getNumber() . " <br/> Best regards";
        }
        $emailCollection = new Amhsoft_Data_Collection();

        $to_emails = $productConfig->getValue('stock_alert_emails');
        $to_emails_array = explode(',', $to_emails);
        if (count($to_emails_array) > 0) {
            $this->sendEmail($to_emails_array, $to_emails_array[0], $subject, $content);
        }
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
            foreach ($to as $email) {
                $mailClient->AddAddress($email);
            }
            $mailClient->setSubject($subject);
            $mailClient->SetHtmlBody(@htmlspecialchars_decode($message));
            $mailClient->Send();
            return true;
        } catch (Exception $e) {
            
        }
    }

}

?>
