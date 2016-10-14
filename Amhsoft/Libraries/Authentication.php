<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Authentication.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Authentication {

    private static $instance = null;
    private $object = null;

    /** @var Amhsoft_Authentication_Adapter_Abstract $adapter */
    private $adapter;
    private $identity;

    /**
     * Singelton
     * @return Amhsoft_Authentication
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getIdentity() {
        return $this->identity;
    }

    public function persist() {
        Amhsoft_Session::write(Amhsoft_System::getLevel() . '.logged_user_idententity', $this->identity);
        Amhsoft_Session::write(Amhsoft_System::getLevel() . '.logged_user_object', $this->object);
    }

    public function clear() {
        Amhsoft_Session::destroy(Amhsoft_System::getLevel() . '.logged_user_idententity');
        Amhsoft_Session::destroy(Amhsoft_System::getLevel() . '.logged_user_object');
    }

    public function isAuthenticated() {
        $this->identity = Amhsoft_Session::read(Amhsoft_System::getLevel() . '.logged_user_idententity');
        return $this->identity != null;
    }

    public function getObject() {
        $this->object = @unserialize(Amhsoft_Session::read(Amhsoft_System::getLevel() . '.logged_user_object'));
        return $this->object;
    }

    public function getShopId() {
        return @$this->getObject()->shop_id;
    }

    public function setObject($object) {
        $this->object = $object;
    }

    public function setAdapter(Amhsoft_Authentication_Adapter_Abstract $adapter) {
        $this->adapter = $adapter;
    }

    public function authenticate($username, $password) {
        $this->clear();
        $this->adapter->authenticate($username, $password);
        $this->object = $this->adapter->getObject();
        $this->identity = $username;
        if ($this->object) {
            $this->persist();
        }
    }

}

?>