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
class Crm_Contact_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var Crm_Contact_Group_Model $group * */
  public $contact_group;

  /** @var Crm_Account_Model $account */
  public $account;
  public $account_id;
  public $id;
  public $company;
  public $firstname;
  public $lastname;
  public $date_of_birth;
  public $phone;
  public $email;
  public $mobile;
  public $fax;
  public $state;
  public $create_date_time;
  public $update_date_time;
  public $notice;
  public $mails = array();
  public $contact_group_id;
  public $contact_source;
  public $contact_source_id;
  public $documents = array();
  public $number;
  public $company_website;

  public function getNextContactNumber() {
    $orderConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $prefix = $orderConfiguration->getValue('contact_prefix', 'C');
    $start = $orderConfiguration->getValue('contact_start', 1);
    $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM contact WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
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

  public function __get($name) {
    if ($name == 'name') {
      return $this->firstname . ' ' . $this->lastname;
    }
  }

  public function getAccount() {
    return $this->account;
  }

  /**
   * Gets Contact id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Contact id.
   * @param Integer $id
   * @return Crm_Contact_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Contact company.
   * @return String $company
   */
  public function getCompany() {
    return $this->company;
  }

  /**
   * Sets Contact company.
   * @param String $company
   * @return Crm_Contact_Model
   */
  public function setCompany($company) {
    $this->company = $company;
    return $this;
  }

  /**
   * Gets Contact firstname.
   * @return String $firstname
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * Sets Contact firstname.
   * @param String $firstname
   * @return Crm_Contact_Model
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this;
  }

  /**
   * Gets Contact lastname.
   * @return String $lastname
   */
  public function getLastname() {
    return $this->lastname;
  }

  /**
   * Sets Contact lastname.
   * @param String $lastname
   * @return Crm_Contact_Model
   */
  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this;
  }

  /**
   * Gets Contact datebirth.
   * @return String $datebirth
   */
  public function getDatebirth() {
    return $this->date_of_birth;
  }

  /**
   * Sets Contact datebirth.
   * @param String $datebirth
   * @return Crm_Contact_Model
   */
  public function setDatebirth($datebirth) {
    $this->date_of_birth = $datebirth;
    return $this;
  }

  /**
   * Gets Contact phone.
   * @return String $phone
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * Sets Contact phone.
   * @param String $phone
   * @return Crm_Contact_Model
   */
  public function setPhone($phone) {
    $this->phone = $phone;
    return $this;
  }

  /**
   * Gets Contact email.
   * @return String $email
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Sets Contact email.
   * @param String $email
   * @return Crm_Contact_Model
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * Gets Contact mobile.
   * @return String $mobile
   */
  public function getMobile() {
    return $this->mobile;
  }

  /**
   * Sets Contact mobile.
   * @param String $mobile
   * @return Crm_Contact_Model
   */
  public function setMobile($mobile) {
    $this->mobile = $mobile;
    return $this;
  }

  /**
   * Gets Contact fax.
   * @return String $fax
   */
  public function getFax() {
    return $this->fax;
  }

  /**
   * Sets Contact fax.
   * @param String $fax
   * @return Crm_Contact_Model
   */
  public function setFax($fax) {
    $this->fax = $fax;
    return $this;
  }

  /**
   * Gets Contact state.
   * @return String $state
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Sets Contact state.
   * @param String $state
   * @return Crm_Contact_Model
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets Contact createdatetime.
   * @return String $createdatetime
   */
  public function getCreatedatetime() {
    return $this->create_date_time;
  }

  /**
   * Sets Contact createdatetime.
   * @param String $createdatetime
   * @return Crm_Contact_Model
   */
  public function setCreatedatetime($createdatetime) {
    $this->create_date_time = $createdatetime;
    return $this;
  }

  /**
   * Gets Contact updatedatetime.
   * @return String $updatedatetime
   */
  public function getUpdatedatetime() {
    return $this->update_date_time;
  }

  /**
   * Sets Contact updatedatetime.
   * @param String $updatedatetime
   * @return Crm_Contact_Model
   */
  public function setUpdatedatetime($updatedatetime) {
    $this->update_date_time = $updatedatetime;
    return $this;
  }

  /**
   * Gets Contact notice.
   * @return String $notice
   */
  public function getNotice() {
    return $this->notice;
  }

  /**
   * Sets Contact notice.
   * @param String $notice
   * @return Crm_Contact_Model
   */
  public function setNotice($notice) {
    $this->notice = $notice;
    return $this;
  }

  public function getContact_group() {
    return $this->contact_group;
  }

  public function setContact_group(Crm_Contact_Group_Model $contact_group) {
    $this->contact_group = $contact_group;
    return $this;
  }

  public function getFullName() {
    return $this->getFirstname() . ' ' . $this->getLastname();
  }

  public function getName() {
    return $this->getFullName();
  }

  public function __toString() {
    return $this->getFirstname() . ' ' . $this->getLastname();
  }

  public function getMails() {
    return $this->mails;
  }

  public function addMail(Crm_MailInbox_Model $mail) {
    $this->mails[] = $mail;
    return $this;
  }

  public function convertToAccount() {
    $accountModel = new Crm_Account_Model();
    $accountModel->number = $accountModel->getNextAccountNumber();
    $accountModel->setName($this->getFullName());
    $accountModel->setEmail1($this->email);
    $accountModel->setMobile($this->phone);
    $accountModel->setCompany_name($this->company);
    $accountModel->setCompany_website($this->company_website);
    $accountModel->setRegisterDateTime(Amhsoft_Locale::UCTDateTime());
    $accountModel->setState(1);
    $accountModel->setGroup(Crm_Account_Group_Model::getDefault());
    $notices = "Converted from contact at : " . Amhsoft_Locale::UCTDateTime() . " <br /> Last Contact ID : " . $this->id . "<br/> Contact Number :" . $this->number;
    $accountModel->notice = $notices;
    $accountModelAdapter = new Crm_Account_Model_Adapter();
    $accountModelAdapter->save($accountModel);
    if ($accountModel->getId() > 0) {
      $adapter = new Crm_Contact_Model_Adapter();
      $this->account_id = $accountModel->getId();
      $adapter->save($this);
      return $accountModel;
    } else {
      return null;
    }
  }

  public function getDocuments() {
    return $this->documents;
  }

  public function addDocument(Crm_Contact_Document_Model $documents) {
    $this->documents[] = $documents;
  }

  public function getAccount_id() {
    return $this->account_id;
  }

  public function setAccount_id($account_id) {
    $this->account_id = $account_id;
    return $this;
  }

  public function getDate_of_birth() {
    return $this->date_of_birth;
  }

  public function setDate_of_birth($date_of_birth) {
    $this->date_of_birth = $date_of_birth;
    return $this;
  }

  public function getCreate_date_time() {
    return $this->create_date_time;
  }

  public function setCreate_date_time($create_date_time) {
    $this->create_date_time = $create_date_time;
    return $this;
  }

  public function getUpdate_date_time() {
    return $this->update_date_time;
  }

  public function setUpdate_date_time($update_date_time) {
    $this->update_date_time = $update_date_time;
    return $this;
  }

  public function getContact_group_id() {
    return $this->contact_group_id;
  }

  public function setContact_group_id($contact_group_id) {
    $this->contact_group_id = $contact_group_id;
    return $this;
  }

  public function getContact_source() {
    return $this->contact_source;
  }

  public function setContact_source($contact_source) {
    $this->contact_source = $contact_source;
    return $this;
  }

  public function getContact_source_id() {
    return $this->contact_source_id;
  }

  public function setContact_source_id($contact_source_id) {
    $this->contact_source_id = $contact_source_id;
    return $this;
  }

  public function getNumber() {
    return $this->number;
  }

  public function setNumber($number) {
    $this->number = $number;
    return $this;
  }

  public function getCompany_website() {
    return $this->company_website;
  }

  public function setCompany_Website($company_website) {
    $this->company_website = $company_website;
    return $this;
  }

}

?>
