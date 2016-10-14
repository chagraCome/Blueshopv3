<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Sms_Gateway_DreamSms_Adapter extends Amhsoft_Sms_Gateway_Abstract {

    protected $userid;
    protected $password;
    protected $sender;

    const URL = 'http://dreamsms.net/sendHexEncoded.HTML';

    public function __construct($userid, $password, $sender) {
        $this->userid = $userid;
        $this->password = $password;
        $this->sender = $sender;
    }

    /**
     * Get Balanace.
     * @return integer
     */
    public function getBalance() {
        $url = "http://dreamsms.net/GetBalance.aspx";
        $http = new Amhsoft_Http();
        return $http->execute($url, null, 'GET', array('UserName' => $this->userid, 'Password' => $this->password));
    }

    /**
     * Get Queue
     * @return string
     */
    public function getQueue() {
        return null;
    }

    /**
     * Send Sms.
     * @param string $to mobile number
     * @param string $message
     * @return boolean
     */
    public function send($to, $message, $lang=null) {
        $url = "http://dreamsms.net/sendHexEncoded.HTML";
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute($url, null, 'GET', array('UserName' => $this->userid, 'Password' => $this->password, 'MobileNo' => $to, 'message' => $message, 'senderName' => $this->sender, 'txtlang' => $lang));
    }

}

?>
