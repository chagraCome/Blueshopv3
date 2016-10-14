<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Sms_Gateway_Resalty_Adapter extends Amhsoft_Sms_Gateway_Abstract {

    protected $userid;
    protected $password;
    protected $sender;

    const URL = 'http://www.resalty.net/api/sendSMS.php';

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
		$url = "http://www.resalty.net/api/getBalance.php";
		$http = new Amhsoft_Http();
        return $http->execute($url, null, 'GET', array('userid' => $this->userid, 'password' => $this->password));
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
		$url = "http://www.resalty.net/api/sendSMS.php";
        $http = new Amhsoft_Http();
        $http->useCurl(false);
        return $http->execute($url, null, 'GET', array('userid' => $this->userid, 'password' => $this->password,'to'=>$to,'msg'=>$message,'sender'=>$this->sender,'encoding'=>'utf8'));
    }

}

?>
