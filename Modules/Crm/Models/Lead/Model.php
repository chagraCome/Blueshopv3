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
class Crm_Lead_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var Crm_Lead_Group_Model $group * */
  public $group;
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
  public $source;
  public $company_website;

  public function getNextLeadNumber() {
    $orderConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
    $prefix = $orderConfiguration->getValue('lead_prefix', 'L');
    $start = $orderConfiguration->getValue('lead_start', 1);
    $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM lead WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
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
      return $this->firstname . $this->lastname;
    }
  }

  /**
   * Gets Lead id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Lead id.
   * @param Integer $id
   * @return Crm_Lead_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Lead company.
   * @return String $company
   */
  public function getCompany() {
    return $this->company;
  }

  /**
   * Sets Lead company.
   * @param String $company
   * @return Crm_Lead_Model
   */
  public function setCompany($company) {
    $this->company = $company;
    return $this;
  }

  /**
   * Gets Lead firstname.
   * @return String $firstname
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * Sets Lead firstname.
   * @param String $firstname
   * @return Crm_Lead_Model
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this;
  }

  /**
   * Gets Lead lastname.
   * @return String $lastname
   */
  public function getLastname() {
    return $this->lastname;
  }

  /**
   * Sets Lead lastname.
   * @param String $lastname
   * @return Crm_Lead_Model
   */
  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this;
  }

  /**
   * Gets Lead datebirth.
   * @return String $datebirth
   */
  public function getDatebirth() {
    return $this->date_of_birth;
  }

  /**
   * Sets Lead datebirth.
   * @param String $datebirth
   * @return Crm_Lead_Model
   */
  public function setDatebirth($datebirth) {
    $this->date_of_birth = $datebirth;
    return $this;
  }

  /**
   * Gets Lead phone.
   * @return String $phone
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * Sets Lead phone.
   * @param String $phone
   * @return Crm_Lead_Model
   */
  public function setPhone($phone) {
    $this->phone = $phone;
    return $this;
  }

  /**
   * Gets Lead email.
   * @return String $email
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Sets Lead email.
   * @param String $email
   * @return Crm_Lead_Model
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * Gets Lead mobile.
   * @return String $mobile
   */
  public function getMobile() {
    return $this->mobile;
  }

  /**
   * Sets Lead mobile.
   * @param String $mobile
   * @return Crm_Lead_Model
   */
  public function setMobile($mobile) {
    $this->mobile = $mobile;
    return $this;
  }

  /**
   * Gets Lead fax.
   * @return String $fax
   */
  public function getFax() {
    return $this->fax;
  }

  /**
   * Sets Lead fax.
   * @param String $fax
   * @return Crm_Lead_Model
   */
  public function setFax($fax) {
    $this->fax = $fax;
    return $this;
  }

  /**
   * Gets Lead state.
   * @return String $state
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Sets Lead state.
   * @param String $state
   * @return Crm_Lead_Model
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets Lead createdatetime.
   * @return String $createdatetime
   */
  public function getCreatedatetime() {
    return $this->create_date_time;
  }

  /**
   * Sets Lead createdatetime.
   * @param String $createdatetime
   * @return Crm_Lead_Model
   */
  public function setCreatedatetime($createdatetime) {
    $this->create_date_time = $createdatetime;
    return $this;
  }

  /**
   * Gets Lead updatedatetime.
   * @return String $updatedatetime
   */
  public function getUpdatedatetime() {
    return $this->update_date_time;
  }

  /**
   * Sets Lead updatedatetime.
   * @param String $updatedatetime
   * @return Crm_Lead_Model
   */
  public function setUpdatedatetime($updatedatetime) {
    $this->update_date_time = $updatedatetime;
    return $this;
  }

  /**
   * Gets Lead notice.
   * @return String $notice
   */
  public function getNotice() {
    return $this->notice;
  }

  /**
   * Sets Lead notice.
   * @param String $notice
   * @return Crm_Lead_Model
   */
  public function setNotice($notice) {
    $this->notice = $notice;
    return $this;
  }

  /**
   * Gets Lead group
   * @return Crm_Lead_Group_Model
   */
  public function getGroup() {
    return $this->group;
  }

  /**
   * Sets Lead group
   *
   * @param Crm_Lead_Group_Model $group
   * @return Crm_Lead_Model
   */
  public function setGroup(Crm_Lead_Group_Model $group) {
    $this->group = $group;
    return $this;
  }

  public function getFullName() {
    return $this->getFirstname() . ' ' . $this->getLastname();
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

  public function convertToContact() {
    $contactModel = new Crm_Contact_Model();
    $contactModel->setNumber($contactModel->getNextContactNumber());
    $contactModel->setLastname($this->getLastname());
    $contactModel->setFirstname($this->getFirstname());
    $contactModel->setCompany($this->getCompany());
    $contactModel->setCompany_Website($this->getCompany_website());
    $contactModel->setCreatedatetime(Amhsoft_Locale::UCTDateTime());
    $contactModel->setUpdatedatetime(Amhsoft_Locale::UCTDateTime());
    $contactModel->setEmail($this->getEmail());
    $contactModel->setDatebirth($this->getDatebirth());
    $contactModel->setFax($this->getFax());
    $contactModel->setMobile($this->getMobile());
    $contactModel->setNotice($this->getNotice());
    $contactModel->setPhone($this->getPhone());
    $contactModel->setState(0);
    $contactModelAdapter = new Crm_Contact_Model_Adapter();
    $contactModelAdapter->save($contactModel);
    if ($contactModel->getId() > 0) {
      $adapter = new Crm_Lead_Model_Adapter();
      $adapter->deleteById($this->id);
      return $contactModel;
    } else {
      return null;
    }
  }

  public function convertToAccount() {
    $contact = $this->convertToContact();
    if ($contact instanceof Crm_Contact_Model) {
      return $contact->convertToAccount();
    }
    return null;
  }

  public function getCompany_website() {
    return $this->company_website;
  }

  public function setCompany_website($company_website) {
    $this->company_website = $company_website;
  }

}

?>
