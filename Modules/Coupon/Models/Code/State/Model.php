<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Code_State_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;

    const FREE = '1';
    const USED = '2';
    const EXPIRED = '3';

    /**
     * Gets id.
     * @return 
     * */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id.
     * @param  id 
     * @return Coupon_Code_State_Model
     * */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name.
     * @return 
     * */
    public function getName() {
        return $this->name;
    }

    /**
     * Set name.
     * @param  name 
     * @return Coupon_Code_State_Model
     * */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    public function getNext($id) {


        $adapter = new Coupon_Code_State_Model_Adapter();

        if ($id == 1) {
            $adapter->where("id IN (" . 1 . "," . 2 . "," . 3 . ")");
        }
        if ($id == 2) {
            $adapter->where("id IN (" . 2 . "," . 3 . ")");
        }
        if ($id == 3) {
            $adapter->where("id = 3");
        }
        return $adapter->fetch();
    }

}

?>