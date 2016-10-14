<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Authentication.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Api
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Api_Hash_Authentication extends Amhsoft_Authentication_Adapter_Abstract {

  private $object;
  private $identity;
  private $cridential;

  public function authenticate($identity, $cridential) {
    if ($identity == null) {
      return;
    }


    $this->identity = $identity;

    $this->cridential = $cridential;
    $adapter = new User_User_Model_Adapter();
    $adapter->where("CONCAT(SHA1(username) ,password) = ?", $this->identity, PDO::PARAM_STR);
    $adapter->where(' state =1');

    $this->object = $adapter->fetch()->fetch();
  }

  public function getObject() {
    return $this->object;
  }

}
?>