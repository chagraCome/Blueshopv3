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
class Amhsoft_Authentication_Db_Object_Adapter extends Amhsoft_Authentication_Adapter_Abstract {

    private $cridentialHash;
    private $where_clause;
    private $adapterClassName;
    private $identityCol;
    private $cridentialCol;
    private $object;

    public function __construct($adapterClassName = null, $identityCol = null, $cridentialCol = null, $where_clause = null, $cridentialHash = 'sha1') {
        $this->adapterClassName = $adapterClassName;
        $this->identityCol = $identityCol;
        $this->cridentialCol = $cridentialCol;
        $this->cridentialHash = $cridentialHash;
        $this->where_clause = $where_clause;
    }

    public function initWithOptions($options) {
        foreach ($options as $key => $val) {
            $this->$key = $val;
        }
    }

    public function getCridentialHash() {
        return $this->cridentialHash;
    }

    public function setCridentialHash($cridentialHash) {
        $this->cridentialHash = $cridentialHash;
        return $this;
    }

    public function getWhere_clause() {
        return $this->where_clause;
    }

    public function setWhere_clause($where_clause) {
        $this->where_clause = $where_clause;
    }

    public function getAdapterClassName() {
        return $this->adapterClassName;
    }

    public function setAdapterClassName($adapterClassName) {
        $this->adapterClassName = $adapterClassName;
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

    public function authenticate($username, $password) {

        $adapter = new $this->adapterClassName;
        $adapter->where($this->identityCol . ' = ?', $username, PDO::PARAM_STR);
        $p = $password;
        if ($this->cridentialHash != null) {
            $p = call_user_func($this->cridentialHash, $password);
        }
        $adapter->where($this->cridentialCol . ' = ?', $p, PDO::PARAM_STR);
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
