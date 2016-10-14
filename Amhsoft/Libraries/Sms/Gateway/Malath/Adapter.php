<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'sms.class.php';

class Amhsoft_Sms_Gateway_Malath_Adapter extends Amhsoft_Sms_Gateway_Abstract {

    protected $malathAdapter;
    protected $username;
    protected $password;
    protected $sender;

    const URL = 'http://bulksms.vsms.net:5567/eapi/submission/send_sms/2/2.0';

    public function __construct($username, $password, $sender) {
        $this->username = $username;
        $this->password = $password;
        $this->sender = $sender;

        $this->malathAdapter = new Malath_SMS($this->username, $this->password, 'UTF-8');
    }

    /**
     * Get Balanace.
     * @return integer
     */
    public function getBalance() {
        return $this->malathAdapter->GetCredits();
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
    public function send($to, $message) {
       return $this->malathAdapter->Send_SMS($to, $this->sender, $message);
    }

}

?>
