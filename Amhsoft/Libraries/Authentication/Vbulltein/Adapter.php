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
class Amhsoft_Authentication_Vbulltein_Adapter extends Amhsoft_Authentication_Adapter_Abstract {

  private $mysqlhost;
  private $mysqlUserName;
  private $mysqlPassword;
  private $mysqlPort;
  private $dbName;

  /** @var PDO $connexion */
  public $connexion;
  private $object;

  public function __construct($mysqlhost, $mysqlUserName, $mysqlPassword, $mysqlPort, $dbName) {
    $this->mysqlhost = $mysqlhost;
    $this->mysqlUserName = $mysqlUserName;
    $this->mysqlPassword = $mysqlPassword;
    $this->mysqlPort = $mysqlPort;
    $this->dbName = $dbName;

    Amhsoft_Log::info('vb: tray to establehs connection');
            
    $this->connexion = $this->MySqlConnect($this->mysqlhost, $this->mysqlUserName, $this->mysqlPassword, $this->mysqlPort, $this->dbName);
    //var_dump($this->connexion->getAttribute(PDO::ATTR_SERVER_INFO));exit;
  }

  public function MySqlConnect($mysqlhost, $mysqlUserName, $mysqlPassword, $mysqlPort, $dbname) {
    $host = "mysql:host=$mysqlhost;dbname=$dbname";
    $connexion = new PDO($host, $mysqlUserName, $mysqlPassword);
    return $connexion;
  }

  public function authenticate($identity, $cridential) {
    try {
        Amhsoft_Log::info('vb: tray to authenticatate with '.$identity.' connection');
      $select = $this->connexion->prepare("SELECT `salt` FROM `user` WHERE `username` = '$identity'");
      $select->execute();
      $salt = $select->fetch();
      if ($salt != null) {
        $cridential = md5(md5($cridential) . $salt['salt']);
        $select = $this->connexion->prepare("SELECT * FROM `user` WHERE `username` = '$identity' AND `password`= '$cridential'");
        $select->execute();
      }else{
          Amhsoft_Log::warn('vb: salt is null');
      }
      $this->object = $select->fetch();
      Amhsoft_Log::info('vb: fetchted object:', $this->object);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getObject() {
    return $this->object;
  }

}

?>
