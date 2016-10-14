<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Account_Model_Adapter extends Amhsoft_Data_Db_Model_Semi_Eav_Adapter {

    public function __construct() {
        $this->table = 'account';
        $this->className = 'Crm_Account_Model';
        $this->map = array(
            'id' => 'id',
            'number' => 'number',
            'name' => 'name',
            'password' => 'password',
            'number' => 'number',
            'telefon' => 'telefon',
            'mobile' => 'mobile',
            'email1' => 'email1',
            'email2' => 'email2',
            'country' => 'country',
            'province' => 'province',
            'city' => 'city',
            'street' => 'street',
            'zipcode' => 'zipcode',
            'register_date_time' => 'register_date_time',
            'dealer' => 'dealer',
            'activation_code' => 'activation_code',
            'state' => 'state',
            'token' => 'token',
            'notice' => 'notice',
            'company_name' => 'company_name',
            'company_website' => 'company_website',
        );
        $this->defineOne2One("group", "group_id", 'Crm_Account_Group_Model');
        //$this->defineOne2One("account_stage", "account_stage_id", 'Crm_Account_Stage_Model', true, true);
        $this->defineOne2One("account_source", "account_source_id", 'Crm_Account_Source_Model', true, true);
        $this->defineMany2Many('documents', 'Crm_Account_Document_Model', 'account_has_document', 'account_id', 'document_id', false, true);

        parent::__construct();
    }

    protected function _insert($object) {

        $e = parent::_insert($object);
        $addressBookModel = new Crm_Address_Model();
        $addressBookModel->setAccountId($object->getId());
        $addressBookModel->setCity($object->getCity());
        $addressBookModel->setCountry($object->getCountry());
        $addressBookModel->setProvince($object->getProvince());
        $addressBookModel->setName($object->getName());
        $addressBookModel->setZipCode($object->getZipcode());
        $addressBookModel->setStreet($object->getStreet());
        $addressBookModelAdapter = new Crm_Address_Model_Adapter();
        $addressBookModelAdapter->save($addressBookModel);
        return $e;
    }

    public function getUid() {
        return 3;
    }

}

?>
