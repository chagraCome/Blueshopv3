<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Client.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PHPMailer' . DIRECTORY_SEPARATOR . 'class.pop3.php';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PHPMailer' . DIRECTORY_SEPARATOR . 'class.smtp.php';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PHPMailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php';

class Amhsoft_Mail_Client {

    private $_adapter = null;

    public function __construct($options = null, $settingid = null) {

        if (Amhsoft_System_Module_Manager::isModuleInstalled('Webmail') && intval($settingid) > 0) {
            $options = Webmail_Setting_Model::getMailClientOptionsById($settingid);
        }
        
        
        $this->_adapter = new PHPMailer(false);

        if (is_array($options)) {
            $this->setOptions($options);
        } else {
            if (@file_exists('config/mail.ini')) {
                $config = new Amhsoft_Config_Ini_Adapter('config/mail.ini');
                $this->setOptions($config->getConfiguration());
            }
        }
        $this->_adapter->CharSet = 'utf-8';
        /*
          $this->_adapter->Host = 'smtp.amhsoft.com';
          $this->_adapter->Port = 25;
          $this->_adapter->Username = 'jobs@amhsoft.com';
          $this->_adapter->Password = 'amhsoftsjob';
          $this->_adapter->SMTPAuth = true;
          $this->_adapter->CharSet = 'utf-8';

          $this->_adapter->IsSMTP();
         */
    }

    public function setOptions(array $options) {
        if ($options['SMTPAuth'] == true) {
            $this->IsSMTP();
        }
        foreach ($options as $key => $value) {
            $this->_adapter->$key = $value;
        }
    }

    public function SetFrom($address, $name = '', $auto = 1) {
        $this->_adapter->SetFrom($address, $name, $auto);
    }

    public function AddAddress($address, $name = '') {
        $this->_adapter->AddAddress($address, $name);
        return $this;
    }

    public function AddAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {
        $this->_adapter->AddAttachment($path, $name, $encoding, $type);
        return $this;
    }

    public function AddBCC($address, $name = '') {
        $this->_adapter->AddBCC($address, $name);
        return $this;
    }

    public function AddCC($address, $name = '') {
        $this->_adapter->AddCC($address, $name);
        return $this;
    }

    public function AddReplyTo($address, $name = '') {
        $this->_adapter->AddReplyTo($address, $name);
        return $this;
    }

    public function AddStringAttachment($string, $filename, $encoding = 'base64', $type = 'application/octet-stream') {
        $this->_adapter->AddStringAttachment($string, $filename, $encoding, $type);
        return $this;
    }

    public function ClearAddresses() {
        $this->_adapter->ClearAddresses();
        return $this;
    }

    public function ClearAllRecipients() {
        $this->_adapter->ClearAllRecipients();
        return $this;
    }

    public function ClearAttachments() {
        $this->_adapter->ClearAttachments();
        return $this;
    }

    public function ClearBCCs() {
        $this->_adapter->ClearBCCs();
        return $this;
    }

    public function ClearCCs() {
        return $this->_adapter->ClearCCs();
    }

    public function ClearReplyTos() {
        $this->_adapter->ClearReplyTos();
        return $this;
    }

    public function GetAttachments() {
        return $this->_adapter->GetAttachments();
    }

    public function GetMailMIME() {
        return $this->_adapter->GetMailMIME();
    }

    public function IsError() {
        return $this->_adapter->IsError();
    }

    public function IsHTML($ishtml = true) {
        return $this->_adapter->IsHTML($ishtml);
    }

    public function IsMail() {
        return $this->_adapter->IsMail();
    }

    public function IsQmail() {
        return $this->_adapter->IsQmail();
    }

    public function IsSMTP() {
        return $this->_adapter->IsSMTP();
    }

    public function IsSendmail() {
        return $this->_adapter->IsSendmail();
    }

    /**
     * @deprecated since version 1.0
     * @param type $message
     * @param type $basedir
     * @return type
     */
    public function MsgHTML($message, $basedir = '') {
        return $this->_adapter->MsgHTML($message, $basedir);
    }

    public function SetHtmlBody($message, $basedir = '') {
        $this->IsHTML();
        return $this->MsgHTML($message, $basedir);
    }

    public function SetAltBody($message) {
        $this->_adapter->AltBody = $message;
    }

    public function SetPlainBody($body) {
        $this->_adapter->Body = $body;
    }

    public function SetSubject($subject) {
        $this->_adapter->Subject = $subject;
    }

    public function Send() {
        return $this->_adapter->Send();
    }

    public function getError() {
        return $this->_adapter->ErrorInfo;
    }

}

?>