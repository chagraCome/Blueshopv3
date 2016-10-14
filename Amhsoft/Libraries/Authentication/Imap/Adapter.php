<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Authentication_Imap_Adapter extends Amhsoft_Authentication_Adapter_Abstract {

  private $host;
  private $port;
  private $encryption;
  private $object;

  public function __construct($host, $port, $encryption) {
    $this->host = $host;
    $this->port = $port;
    $this->encryption = $encryption;
  }

  public function authenticate($identity, $cridential) {

    imap_timeout(IMAP_OPENTIMEOUT, 5);
    $result = @imap_open($this->getConnectionString(), $identity, $cridential);
    if ($result) {
        $obj = new stdClass();
        $obj->identity = $identity;
        $obj->cridential = $cridential;
      $this->object = $obj;
    }
  }

  private function getConnectionString() {
    if ($this->port == 143) {
      $string = "{" . $this->host . ":" . $this->port . "}INBOX";
    }
    if ($this->port == 110) {
      $string = "{" . $this->host . ":" . $this->port . "/pop3}INBOX";
    }

    return $string;
  }

  public function getObject() {
    return $this->object;
  }

}

?>
