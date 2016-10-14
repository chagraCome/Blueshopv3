<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Sms_Gateway_BulkSms_Adapter extends Amhsoft_Sms_Gateway_Abstract {

    protected $username;
    protected $password;
    protected $sender;

    const URL = 'http://bulksms.vsms.net:5567/eapi/submission/send_sms/2/2.0';

    public function __construct($username, $password, $sender) {
        $this->username = $username;
        $this->password = $password;
        $this->sender = $sender;
    }

    /**
     * Get Balanace.
     * @return integer
     */
    public function getBalance() {
        $url = "http://bulksms.vsms.net:5567/eapi/user/get_credits/1/1.1";
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute($url, null, 'POST', array('username' => $this->username, 'password' => $this->password));
    }

    /**
     * Get Queue
     * @return string
     */
    public function getQueue() {
        $url = "http://bulksms.vsms.net:5567/eapi/status_reports/get_report/2/2.0";
        $http = new Amhsoft_Http();
        return $http->execute($url, null, 'POST', array('username' => $this->username, 'password' => $this->password));
    }

    /**
     * Send Sms.
     * @param string $to mobile number
     * @param string $message
     * @return boolean
     */
    public function send($to, $message) {
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute(self::URL, null, 'POST', array('username' => urlencode($this->username), 'password' => urlencode($this->password), 'message' => $this->string_to_utf16_hex($message), 'msisdn' => urlencode($to), 'dca' => '16bit'));
    }

    private function string_to_utf16_hex($string) {
        return bin2hex(mb_convert_encoding($string, "UTF-16", "UTF-8"));
    }

}

?>
