<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 313 2016-02-04 09:58:05Z montassar.amhsoft $
 * $Rev: 313 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-02-04 10:58:05 +0100 (jeu., 04 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Amhsoft_Authentication_Facebook_Adapter extends Amhsoft_Authentication_Adapter_Abstract {

    private $identityCol;
    private $where_clause;
    private $cridentialCol;
    private $adapterClassName;
    private $object;

    public function __construct($adapterClassName, $identityCol, $where = null) {

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

    public function authenticate($facebookName, $cridential) {

        $adapter = new $this->adapterClassName;
        $adapter->where($this->identityCol . ' = ?', $facebookName, PDO::PARAM_STR);
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
