<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
abstract class Amhsoft_Sms_Gateway_Abstract{
    abstract function send($to, $message);
    abstract function getBalance();
    abstract function getQueue();
}
?>
