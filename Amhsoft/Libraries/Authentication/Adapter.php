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
class Amhsoft_Authentication_Instagram_Adapter extends Amhsoft_Authentication_Adapter_Abstract {

  private $identityCol;
  private $where_clause;
  private $cridentialCol;
  private $adapterClassName;
  private $object;

  public function __construct($adapterClassName, $identityCol, $where=null) {
    
    $this->where_clause = $where;
    $this->identityCol = $identityCol;
    $this->adapterClassName = $adapterClassName;
  }

  public function initWithOptions($options) {
    foreach ($options as $key => $val) {
      $this->$key = $val;
    }
  }

  


  public function getIdentityCol() {
    return $this->identityCol;
  }

  public function setIdentityCol($identityCol) {
    $this->identityCol = $identityCol;
  }

  public function getCridentialCol() {
    return $this->cridentialCol;
  }

  public function setCridentialCol($cridentialCol) {
    $this->cridentialCol = $cridentialCol;
  }

  public function authenticate($instagramusername, $cridential) {

    $adapter = new $this->adapterClassName;
    $adapter->where($this->identityCol . ' = ?', $instagramusername, PDO::PARAM_STR);
    if ($this->where_clause != null) {
      $adapter->where($this->where_clause);
    }
    $this->object = $adapter->fetch()->fetch();
  }

  public function getObject() {
    return $this->object;
  }

}

?>
