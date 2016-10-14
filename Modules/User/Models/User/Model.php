<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:38:59
 */
class User_User_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer $id */
  public $id;

  /** @var string $username */
  public $username;

  /** @var string $password */
  public $password;

  /** @var string $firstname */
  public $firstname;

  /** @var string $lastname */
  public $lastname;

  /** @var string $phone */
  public $phone;

  /** @var string $email */
  public $email;

  /** @var string $mobile */
  public $mobile;

  /** @var string $fax */
  public $fax;

  /** @var string $address */
  public $address;

  /** @var string $postalcode */
  public $postalcode;

  /** @var string $city */
  public $city;

  /** @var string $province */
  public $province;

  /** @var string $country */
  public $country;

  /** @var integer $state */
  public $state;

  /** @var string $create_date_time */
  public $create_date_time;

  /** @var string $update_date_time */
  public $update_date_time;

  /** @var string $lastLoginDate */
  public $lastLoginDate;

  /** @var string $lastLoginHost */
  public $lastLoginHost;

  /** @var string $notice */
  public $notice;

  /** @var Integer $remote_id */
  public $remote_id;

  /** @var String $msn */
  public $msn;

  /** @var String $facebook */
  public $facebook;

  /** @var String $twitter */
  public $twitter;

  /** @var String $icq */
  public $icq;

  /** @var String $whatsapp */
  public $whatsapp;

  /** @var String $blackberry */
  public $blackberry;

  /** @var String $gmail */
  public $gmail;

  /** @var User_Role_Model $role * */
  public $role;
  public $admin = false; //true/false

  /** @var User_Department_Model $department */
  public $department;
  public $number;
  public $token;
  public $picturesrc;

  public function __construct($id = null) {
    if ($id) {
      $this->id = $id;
      $pictures = glob('media/user/picture/' . $this->id . '.*');
      if (count($pictures) > 0) {
	$this->picturesrc = @$pictures[0];
      }
    }
  }

  /**
   * Set Id
   * @param type $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Set Username
   * @param type $username
   */
  public function setUsername($username) {
    $this->username = $username;
  }

  /**
   * Gets Remote Id
   * @return type
   */
  public function getRemote_id() {
    return $this->remote_id;
  }

  /**
   * Set Remote Id
   * @param type $remote_id
   */
  public function setRemote_id($remote_id) {
    $this->remote_id = $remote_id;
  }

  /**
   * Set Password
   * @param type $password
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  /**
   * Set Firstname
   * @param type $firstname
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
  }

  /**
   * Gets Firstname
   * @return type
   */
  public function getFirstName() {
    return $this->firstname;
  }

  /**
   * Gets Lastname
   * @return type
   */
  public function getLastName() {
    return $this->lastname;
  }

  /**
   * Set Lastname
   * @param type $lastname
   */
  public function setLastname($lastname) {
    $this->lastname = $lastname;
  }

  /**
   * Gets Adress
   * @return type
   */
  public function getAdress() {
    return $this->address;
  }

  /**
   * Set Phone
   * @param type $phone
   */
  public function setPhone($phone) {
    $this->phone = $phone;
  }

  /**
   * Set Email
   * @param type $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }

  /**
   * Set Mobile
   * @param type $mobile
   */
  public function setMobile($mobile) {
    $this->mobile = $mobile;
  }

  /**
   * Set Fax
   * @param type $fax
   */
  public function setFax($fax) {
    $this->fax = $fax;
  }

  /**
   * Set Address
   * 
   * @param type $address
   */
  public function setAddress($address) {
    $this->address = $address;
  }

  /**
   * Set Postal Code
   * @param type $postalcode
   */
  public function setPostalcode($postalcode) {
    $this->postalcode = $postalcode;
  }

  /**
   * Set City
   * @param type $city
   */
  public function setCity($city) {
    $this->city = $city;
  }

  /**
   * Set Province
   * @param type $province
   */
  public function setProvince($province) {
    $this->province = $province;
  }

  /**
   * Set Country
   * @param type $country
   */
  public function setCountry($country) {
    $this->country = $country;
  }

  /**
   * Set State
   * @param type $state
   */
  public function setState($state) {
    $this->state = $state;
  }

  /**
   * Set Create date
   * @param type $create_date_time
   */
  public function setCreate_date_time($create_date_time) {
    $this->create_date_time = $create_date_time;
  }

  /**
   * Set update date
   * @param type $update_date_time
   */
  public function setUpdate_date_time($update_date_time) {
    $this->update_date_time = $update_date_time;
  }

  /**
   * Set Last Login Date
   * @param type $lastLoginDate
   */
  public function setLastLoginDate($lastLoginDate) {
    $this->lastLoginDate = $lastLoginDate;
  }

  /**
   * Set Last Login Host
   * @param type $lastLoginHost
   */
  public function setLastLoginHost($lastLoginHost) {
    $this->lastLoginHost = $lastLoginHost;
  }

  /**
   * Set Notice
   * @param type $notice
   */
  public function setNotice($notice) {
    $this->notice = $notice;
  }

  /**
   * Set Group Id
   * @param type $group_id
   */
  public function setGroup_id($group_id) {
    $this->group_id = $group_id;
  }

  /** @return boolean true if is null. */
  public function isIdNull() {
    return intval($this->id == 0);
  }

  /** @return boolean true if is null. */
  public function isUsernameNull() {
    return ($this->username == null || trim($this->username) == '');
  }

  /** @return boolean true if is null. */
  public function isPasswordNull() {
    return ($this->password == null || trim($this->password) == '');
  }

  /** @return boolean true if is null. */
  public function isFirstnameNull() {
    return ($this->firstname == null || trim($this->firstname) == '');
  }

  /** @return boolean true if is null. */
  public function isLastnameNull() {
    return ($this->lastname == null || trim($this->lastname) == '');
  }

  /** @return boolean true if is null. */
  public function isPhoneNull() {
    return ($this->phone == null || trim($this->phone) == '');
  }

  /** @return boolean true if is null. */
  public function isEmailNull() {
    return ($this->email == null || trim($this->email) == '');
  }

  /** @return boolean true if is null. */
  public function isMobileNull() {
    return ($this->mobile == null || trim($this->mobile) == '');
  }

  /** @return boolean true if is null. */
  public function isFaxNull() {
    return ($this->fax == null || trim($this->fax) == '');
  }

  /** @return boolean true if is null. */
  public function isAddressNull() {
    return ($this->address == null || trim($this->address) == '');
  }

  /** @return boolean true if is null. */
  public function isPostalcodeNull() {
    return ($this->postalcode == null || trim($this->postalcode) == '');
  }

  /** @return boolean true if is null. */
  public function isCityNull() {
    return ($this->city == null || trim($this->city) == '');
  }

  /** @return boolean true if is null. */
  public function isProvinceNull() {
    return ($this->province == null || trim($this->province) == '');
  }

  /** @return boolean true if is null. */
  public function isCountryNull() {
    return ($this->country == null || trim($this->country) == '');
  }

  /** @return boolean true if is null. */
  public function isStateNull() {
    return intval($this->state == 0);
  }

  /** @return boolean true if is null. */
  public function isCreate_date_timeNull() {
    return ($this->create_date_time == null || trim($this->create_date_time) == '');
  }

  /** @return boolean true if is null. */
  public function isUpdate_date_timeNull() {
    return ($this->update_date_time == null || trim($this->update_date_time) == '');
  }

  public function getFullName() {
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  /** @return boolean true if is null. */
  public function isLastLoginDateNull() {
    return ($this->lastLoginDate == null || trim($this->lastLoginDate) == '');
  }

  /** @return boolean true if is null. */
  public function isLastLoginHostNull() {
    return ($this->lastLoginHost == null || trim($this->lastLoginHost) == '');
  }

  /** @return boolean true if is null. */
  public function isNoticeNull() {
    return ($this->notice == null || trim($this->notice) == '');
  }

  /** @return boolean true if is null. */
  public function isGroup_idNull() {
    return intval($this->group_id == 0);
  }

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Gets Username
   * @return type
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Gets Password
   * @return type
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Gets Phone
   * @return type
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * Gets Email
   * @return type
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Gets Mobile
   * @return type
   */
  public function getMobile() {
    return $this->mobile;
  }

  /**
   * Gets Fax
   * @return type
   */
  public function getFax() {
    return $this->fax;
  }

  /**
   * Gets Address
   * @return type
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * Gets Postal Code
   * @return type
   */
  public function getPostalcode() {
    return $this->postalcode;
  }

  /**
   * Gets City
   * @return type
   */
  public function getCity() {
    return $this->city;
  }

  /**
   * Gets Provinve
   * @return type
   */
  public function getProvince() {
    return $this->province;
  }

  /**
   * Gets Country
   * @return type
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * Gets State
   * @return type
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Gets Create Date
   * @return type
   */
  public function getCreate_date_time() {
    return $this->create_date_time;
  }

  /**
   * Gets Update Date
   * @return type
   */
  public function getUpdate_date_time() {
    return $this->update_date_time;
  }

  /**
   * Gets Last Login Date
   * @return type
   */
  public function getLastLoginDate() {
    return $this->lastLoginDate;
  }

  /**
   * Gets Last Login Host
   * @return type
   */
  public function getLastLoginHost() {
    return $this->lastLoginHost;
  }

  /**
   * Gets Notice
   * @return type
   */
  public function getNotice() {
    return $this->notice;
  }

  /**
   * Get static usermodel
   * @param type $id
   * @return UserModel $usermodel
   */
  public static function get($id) {
    $userModelAdapter = new User_User_Model_Adapter();
    return $userModelAdapter->fetchById($id);
  }

  /**
   * Gets Group Ids.
   * @return type
   */
  public function getGroupIds() {
    $sql = "SELECT DISTINCT(user_group_id) FROM user_group_has_user WHERE user_id = " . $this->getId();
    $stmt = Amhsoft_DataBase::getInstance()->query($sql);
    $groups = array();
    while ($row = $stmt->fetch()) {
      $groups[] = $row['user_group_id'];
    }
    return $groups;
  }

  /**
   * Gets all users in given group.
   * @param type $group_id
   * @return type
   */
  public function getUsersInTheSameGroup($group_id = null) {
    $groupIds = $this->getGroupIds();
    $users = array();
    foreach ($groupIds as $groupid) {
      if (intval($group_id) > 0 && $groupid != $group_id) {
	continue;
	;
      }
      $groupModelAdapter = new User_Group_Model_Adapter();
      $group = $groupModelAdapter->fetchById($groupid);
      if ($group instanceof User_Group_Model) {
	foreach ($group->getUsers() as $u) {
	  if (!in_array($u, $users)) {
	    $users[] = $u;
	  }
	}
      }
    }
    return $users;
  }

  /**
   * Return first + lastname.
   * @return type
   */
  public function __toString() {
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  public function getAdmin() {
    return $this->admin;
  }

  /**
   * Check if user isadmin.
   * @return type
   */
  public function isAdmin() {
    return $this->admin == true;
  }

  public function setAdmin($admin) {
    $this->admin = $admin;
  }

  public function getMsn() {
    return $this->msn;
  }

  public function setMsn($msn) {
    $this->msn = $msn;
  }

  public function getFacebook() {
    return $this->facebook;
  }

  public function setFacebook($facebook) {
    $this->facebook = $facebook;
  }

  public function getTwitter() {
    return $this->twitter;
  }

  public function setTwitter($twitter) {
    $this->twitter = $twitter;
  }

  public function getIcq() {
    return $this->icq;
  }

  public function setIcq($icq) {
    $this->icq = $icq;
  }

  public function getWhatsapp() {
    return $this->whatsapp;
  }

  public function setWhatsapp($whatsapp) {
    $this->whatsapp = $whatsapp;
  }

  public function getBlackberry() {
    return $this->blackberry;
  }

  public function setBlackberry($blackberry) {
    $this->blackberry = $blackberry;
  }

  public function getGmail() {
    return $this->gmail;
  }

  public function setGmail($gmail) {
    $this->gmail = $gmail;
  }

  /**
   * Gets Role
   * @return type
   */
  public function getRole() {
    return $this->role;
  }

  /**
   * Set Role
   * @param User_Role_Model $role
   * @return User_User_Model
   */
  public function setRole(User_Role_Model $role) {
    $this->role = $role;
    return $this;
  }

  /**
   * Gets department
   * @return User_Department_Model departement
   */
  public function getDepartment() {
    return $this->department;
  }

  /**
   * Sets department
   * @param User_Department_Model $department
   */
  public function setDepartment(User_Department_Model $department) {
    $this->department = $department;
  }

  /**
   * Gets Number
   * @return type
   */
  public function getNumber() {
    return $this->number;
  }

  /**
   * Set Number
   * @param type $number
   */
  public function setNumber($number) {
    $this->number = $number;
  }

  /**
   * Get Next user Number.
   * @return type
   */
  public function getNextNumber() {
    $prefix = 'U0';
    $start = 1;
    $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM user WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
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

  public function getImage() {
    return $this->getPictureSrc();
  }

  public function hasImage() {
    if (@file_exists("media/user/picture/" . $this->id . ".jpg")) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Gets
   * @param type $name
   * @return type
   */
  public function __get($name) {
    if ($name == 'fullname') {
      return $this->getFullName();
    }
    
    if($name == 'pic'){
      return $this->getImage();
    }
  }

  /**
   * Gets Token
   * @return type
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * Set Token
   * @param type $token
   */
  public function setToken($token) {
    $this->token = $token;
  }

  public function getPictureSrc() {
    if (@file_exists("media/user/picture/" . $this->id . ".jpg")) {
      return "media/user/picture/" . $this->id . ".jpg";
    } else {
      return null;
    }
  }

  /**
   * Set Picture
   * @param type $bannersrc
   */
  public function setPictureSrc($picturesrc) {
    $this->picturesrc = $picturesrc;
  }

}

