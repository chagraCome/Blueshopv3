<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include dirname(__FILE__).'/Qr/QrCode.php';
class Amhsoft_Code_Qr {

    private $_adapter;

    function __construct($_adapter = null) {
        if ($_adapter instanceof Amhsoft_Code_Interface) {
            $this->_adapter = $_adapter;
        } else {
            $this->_adapter = new QRcode();
        }
    }

    public function png($text, $outfile = false) {
        return $this->_adapter->png($text, $outfile);
    }

    public function raw($text, $outfile = false) {
        return $this->_adapter->raw($text, $outfile);
    }

}

?>
