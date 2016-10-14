<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 331 2016-02-04 16:17:27Z imen.amhsoft $
 * $Rev: 331 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-04 17:17:27 +0100 (jeu., 04 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Saleorder_State_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;

    const CREATED = '8'; //1
    const SEND = '9'; //2
    const ACCEPTED = '10'; //3
    const CANCELED = '11'; //..
    const PAID = '12'; //
    const SHIPPED = '13';
    const CLOSED = '14';
    const REFUNDED = '15';
    const PAID_EMAIL_NOTIFICATION = 20;
    const CREATED_ADMIN_EMAIL_TEMPLATE = 19;
    const CREATED_CUSTOMER_EMAIL_TEMPLATE = 12;
    const STATE_CHANGED_EMAIL_TEMPLATE = 13;
    const COMMENT_ADDED_ADMIN_TEMPLATE = 16;
    const COMMENT_ADDED_CUSTOMER_TEMPLATE = 17;
    const CANCELED_EMAIL_NOTIFICATION = 20;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    public function getNext() {
        $config = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);


        $stateFlow = array(
            self::CREATED => array(
                self::CREATED,
                self::SEND,
            ),
            self::SEND => array(
                self::SEND,
                self::ACCEPTED,
                self::CANCELED
            ),
            self::CLOSED => array(self::CLOSED),
            self::ACCEPTED => array(
                self::ACCEPTED,
                self::PAID,
                self::CANCELED,
            ),
            self::PAID => array(
                self::PAID,
                self::SHIPPED,
                self::CANCELED,
            ),
            self::SHIPPED => array(
                self::SHIPPED,
                self::CLOSED,
            )
        );




        $adapter = new Saleorder_State_Model_Adapter();
        foreach ($stateFlow as $state => $nextstates) {
            if ($this->id == $state) {

                $ids = array();
                foreach ($nextstates as $st) {
                    $ids[] = (int) ($st);
                }

                if (!empty($ids)) {
                    $adapter->where("id IN (" . implode(',', $ids) . ")");
                }
            }
        }

        return $adapter->fetch();
    }

}

?>
