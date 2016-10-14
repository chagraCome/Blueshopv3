<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Account_Model extends Amhsoft_Data_Db_Model_Semi_Eav_Model implements Amhsoft_Data_Db_Model_Interface {

    const WELCOME_EMAIl_TEMPLATE = 1;
    const RESET_PASSWORD_EMAIL_TEMPLATE = 14;
    const ACCOUNT_REGISTRED_EMAIL_TEMPLATE = 15;

    public $id;
    public $name;
    public $password;
    public $number;
    public $telefon;
    public $mobile;
    public $email1;
    public $email2;
    public $country;
    public $province;
    public $city;
    public $street;
    public $zipcode;
    public $register_date_time;
    public $persons = array();
    public $dealer = 0;
    public $logosrc;
    public $bannersrc;
    public $group;
    public $activation_code;
    public $state;
    public $token;
    public $account_source;
    public $notice;
    public $account_source_id;
    public $documents = array();
    public $company_name;
    public $company_website;

    const SETTING = 'account';
    const FROM_EMAIL = 'account_notifications_from_email';
    const REGISTRATION_EMAIL_TEMPLATE = 'account_registration_email_template';
    const REGISTRATION_SMS_TEMPLATE = 'account_registration_sms_template';
    const FORGOT_PASSWORD_TEMPLATE = 'account_forgot_password_template';
    const PASSWORD_CHANGED_TEMPLATE = 'account_password_changed_template';
    const SEND_EMAIl_ON_REGISTER = 'account_send_email_on_register';
    const SEND_SMS_ON_REGISTER = 'account_send_sms_on_register';
    const SEND_EMAIL_ON_PASSWORD_CHANGED = 'account_send_email_on_password_changed';
    const SEND_SMS_ON_PASSWORD_CHANGED = 'account_send_sms_on_password_changed';
    const ACCOUNT_ACTIVATION = 'account_activation';
    const ACTIVATION_METHOD = 'account_activation_method';
    const ACCOUNT_ACTIVATION_EMAIL = 'account_email_activation';
    const ACCOUNT_ACTIVATION_SMS = 'account_sms_activation';
    const NOTIFY_ADMIN_ACCOUNT_REGISTRED = 'notify_admin_account_registred';
    const NOTIFY_ADMIN_ACCOUNT_REGISTRED_TEMPLATE = 'notify_admin_account_registred_template';
    const DEFAULT_ACCOUNT_GROUP = 'account_registration_default_group';
    const SEND_PASSWORD_EMAIl_TEMPLATE = 'account_send_password_email_template';
    const PRIVACY_POLICY_TEXT = 'privacy_policy_text';
    const PRIVACY_POLICY_STATUS = 'privacy_policy_status';

    public function getNextAccountNumber() {
        $orderConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $prefix = $orderConfiguration->getValue('account_prefix', 'A');
        $start = $orderConfiguration->getValue('account_start', 1);

        $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM account WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
        if (!$lastNumber) {
            return $prefix . $start;
        } else {
            $lastNumberAsInt = str_replace($prefix, '', $lastNumber);
            if ($lastNumberAsInt >= $start) {
                $lastNumberAsInt = intval($lastNumberAsInt) + 1;
                return $prefix . $lastNumberAsInt;
            } else {
                return $prefix . $start;
            }
        }
    }

    /**
     * Get All contact realted to this account.
     * @return 
     */
    public function getContacts() {
        $adapter = new Crm_Contact_Model_Adapter();
        $adapter->where('account_id = ?', $this->id);
        return $adapter->fetch();
    }

    public function getPicture() {
        return 'media/account/' . $this->getId() . '.jpg';
    }

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        $this->group = $group;
    }

    public function __construct() {
        $this->setLogoSrc();
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    /**
     * Gets Account id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    public function getActivationCode() {
        return $this->activation_code;
    }

    public function setActivationCode($activation_code) {
        $this->activation_code = $activation_code;
    }

    /**
     * Sets Account id.
     * @param Integer $id
     * @return Crm_Account_Model
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets Account name.
     * @return String $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets Account name.
     * @param String $name
     * @return Crm_Account_Model
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets Account password.
     * @return String $password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets Account password.
     * @param String $password
     * @return Crm_Account_Model
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets Account number.
     * @return String $number
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Sets Account number.
     * @param String $number
     * @return Crm_Account_Model
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * Gets Account telefon.
     * @return String $telefon
     */
    public function getTelefon() {
        return $this->telefon;
    }

    /**
     * Gets Mobbile number of Telefonnumber.
     * @return string $phone
     */
    public function getPhone() {
        return ($this->getMobile()) ? $this->getMobile() : $this->getTelefon();
    }

    /**
     * Sets Account telefon.
     * @param String $telefon
     * @return Crm_Account_Model
     */
    public function setTelefon($telefon) {
        $this->telefon = $telefon;
        return $this;
    }

    /**
     * Gets Account Mobile.
     * @return String $mobile
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * Sets Account mobile.
     * @param String $mobile
     * @return Crm_Account_Model
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * Gets Account email1.
     * @return String $email1
     */
    public function getEmail1() {
        return $this->email1;
    }

    /**
     * Sets Account email1.
     * @param String $email1
     * @return Crm_Account_Model
     */
    public function setEmail1($email1) {
        $this->email1 = $email1;
        return $this;
    }

    /**
     * Gets Account email2.
     * @return String $email2
     */
    public function getEmail2() {
        return $this->email2;
    }

    /**
     * Sets Account email2.
     * @param String $email2
     * @return Crm_Account_Model
     */
    public function setEmail2($email2) {
        $this->email2 = $email2;
        return $this;
    }

    /**
     * Gets Account country.
     * @return String $country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Sets Account country.
     * @param String $country
     * @return Crm_Account_Model
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * Gets Account province.
     * @return String $province
     */
    public function getProvince() {
        return $this->province;
    }

    /**
     * Sets Account province.
     * @param String $province
     * @return Crm_Account_Model
     */
    public function setProvince($province) {
        $this->province = $province;
        return $this;
    }

    /**
     * Gets Account city.
     * @return String $city
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Sets Account city.
     * @param String $city
     * @return Crm_Account_Model
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Gets Account street.
     * @return String $street
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Sets Account street.
     * @param String $street
     * @return Crm_Account_Model
     */
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    /**
     * Gets Account zipcode.
     * @return String $zipcode
     */
    public function getZipcode() {
        return $this->zipcode;
    }

    /**
     * Sets Account zipcode.
     * @param String $zipcode
     * @return Crm_Account_Model
     */
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function getPersons() {
        if (empty($this->persons)) {
            $personModelAdapter = new Crm_Lead_Model_Adapter();
            $personModelAdapter->where('account_id = ?', $this->getId());
            if ($personModelAdapter->getCount() > 0) {
                $this->persons = $personModelAdapter->fetch()->fetchAll();
            }
        }
        return $this->persons;
    }

    public function addPersons(Crm_Lead_Model $persons) {
        $this->persons[] = $persons;
    }

    public function __toString() {
        return $this->getName();
    }

    public function getRegisterDateTime() {
        return $this->register_date_time;
    }

    public function setRegisterDateTime($register_date_time) {
        $this->register_date_time = $register_date_time;
    }

    public function getEmail() {
        if ($this->email1 != null) {
            return $this->email1;
        } else {
            return $this->email2;
        }
    }

    public function getDealer() {
        return $this->dealer;
    }

    public function setDealer($dealer) {
        $this->dealer = $dealer;
    }

    public function setLogoSrc() {
        if (file_exists('media/account/' . $this->id . '.jpg')) {
            $this->logosrc = 'media/account/' . $this->id . '.jpg';
        }
    }

    public function getLogoSrc() {
        $this->setLogoSrc();
        if (file_exists($this->logosrc)) {
            return $this->logosrc;
        }
    }

    public function setBannerSrc() {
        if (file_exists('media/dealer/banners/' . $this->id . '.jpg')) {
            $this->bannersrc = 'media/dealer/banners/' . $this->id . '.jpg';
        }
    }

    public function getBannerSrc() {
        if (file_exists('media/dealer/banners/' . $this->id . '.jpg')) {
            return 'media/dealer/banners/' . $this->id . '.jpg';
        } else {
            return null;
        }
    }

    public function getAddresses() {
        $addressModelAdapter = new Crm_Address_Model_Adapter();
        $addressModelAdapter->where('account_id = ?', $this->id);
        return $addressModelAdapter->fetch()->fetchAll();
    }

    /**
     * Gets Account By ID.
     * @param type $id
     * @return Crm_Account_Model
     * @throws Exception
     */
    public static function byId($id) {

        if (intval($id) <= 0) {
            throw new Exception("Object Not found");
        }

        $adapter = new Crm_Account_Model_Adapter();
        $model = $adapter->fetchById($id);

        if ($model instanceof Crm_Account_Model) {
            return $model;
        } else {
            throw new Exception("Object Not found");
        }
    }

    public function doObjectImport(Amhsoft_Data_Db_Model_Importable_Interface $object, $args = array()) {
//    if ($object->number == '') {
//      $object->number = 'xxxx';
//    }
    }

    public function getImportableAttributes($args = null) {
        $data = get_class_vars('Crm_Account_Model');
        unset($data['persons']);
        unset($data['documents']);

        return array_keys($data);
    }

    public function isObjectToImportValid(Amhsoft_Data_Db_Model_Importable_Interface $object, &$messages = '') {
        return true;
    }

    public function onImportObjectsFinishCallBack() {
        
    }

    public function exportData($format, $map) {
        $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
        if ($format == 'csv') {
            $str = array();
            $header = array();
            foreach ($map as $i => $val) {
                $header[] = $val;
            }
            $str[] = implode(";", $header);
            $iterator = $crmAccountModelAdapter->fetch();

            while ($account = $iterator->fetch()) {
                $str_row_array = array();
                foreach ($map as $i => $val) {
                    $str_row_array[] = isset($account->{$val}) ? $account->{$val} : "";
                }
                $str[] = implode(";", $str_row_array);
            }
            return implode("\n", $str);
        }
        if ($format == 'xml') {

            foreach ($map as $i => $val) {
                if ($val != '') {
                    $crmAccountModelAdapter->select($val);
                }
            }
            return $crmAccountModelAdapter->fetchAsXml();
        }
        if ($format == 'excel') {
            return 'i will export all data in excel format';
        }
    }

    public function getExportableAttributes($args = null) {
        return array('id', 'number', 'name', 'email1', 'email2', 'country');
    }

    public function getExportFormats() {
        return array('csv', 'outlook', 'xml', 'excel', 'vcard');
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    /**
     * Gets Comments related to account.
     * @param int $id
     * @param boolean $all
     */
    public static function getComments($id, $all = false) {
        $commentModelAdapter = new Comment_Model_Adapter();
        if ($all == false) {
            $commentModelAdapter->where('public = 1');
        }
        $commentModelAdapter->where("entity = 'Crm_Account_Model' ");
        $commentModelAdapter->where('entity_id = ?', $id);

        return $commentModelAdapter->fetch();
    }

    public function getDocuments() {
        return $this->documents;
    }

    public function addDocument(Crm_Account_Document_Model $documents) {
        $this->documents[] = $documents;
    }

    public function getCompany_name() {
        return $this->company_name;
    }

    public function setCompany_name($company_name) {
        $this->company_name = $company_name;
    }

    public function getCompany_website() {
        return $this->company_website;
    }

    public function setCompany_website($company_website) {
        $this->company_website = $company_website;
    }

}

?>
