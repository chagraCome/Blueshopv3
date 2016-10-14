<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Sms_Gateway_SendSms_Adapter extends Amhsoft_Sms_Gateway_Abstract {

    protected $username;
    protected $password;
    protected $sender;

    const URL = 'http://api.sendsms.cc/api/send.aspx';

    public function __construct($username, $password, $sender) {
        $this->username = $username;
        $this->password = $password;
        $this->sender = $sender;
    }

    /**
     * Get Balance.
     * @return integer
     */
    public function getBalance() {
        $url = "http://api.sendsms.cc/api/balance.aspx";
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute($url, null, 'GET', array('username' => $this->username, 'password' => $this->password));
    }

    /**
     * Get Queue.
     * @return string
     */
    public function getQueue() {
        $url = "http://api.sendsms.cc/api/queue.aspx";
        $http = new Amhsoft_Http();
        return $http->execute($url, null, 'GET', array('username' => $this->username, 'password' => $this->password));
    }

    /**
     * Send sms.
     * @param string $to
     * @param string $message
     * @return boolean
     */
    public function send($to, $message) {
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute(self::URL, null, 'GET', array('username' => urlencode($this->username), 'password' => urlencode($this->password), 'language' => 3, 'sender' => urlencode($this->sender), 'mobile' => $to, 'message' => $this->string_to_utf16_hex($message)));
    }

    private function string_to_utf16_hex($string) {
        return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
    }

}

?>
