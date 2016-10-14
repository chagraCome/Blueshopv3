<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_User_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Construct
   */
  public function __construct() {
    $this->table = 'user';
    $this->className = 'User_User_Model';
    $this->map = array(
	'id' => 'id',
	'number' => 'number',
	'username' => 'username',
	'password' => 'password',
	'firstname' => 'firstname',
	'lastname' => 'lastname',
	'phone' => 'phone',
	'email' => 'email',
	'mobile' => 'mobile',
	'fax' => 'fax',
	'address' => 'address',
	'postalcode' => 'postalcode',
	'city' => 'city',
	'province' => 'province',
	'country' => 'country',
	'state' => 'state',
	'create_date_time' => 'create_date_time',
	'update_date_time' => 'update_date_time',
	'lastLoginDate' => 'lastLoginDate',
	'lastLoginHost' => 'lastLoginHost',
	'notice' => 'notice',
	'remote_id' => 'remote_id',
	'admin' => 'admin',
	'msn' => 'msn',
	'facebook' => 'facebook',
	'twitter' => 'twitter',
	'icq' => 'icq',
	'whatsapp' => 'whatsapp',
	'blackberry' => 'blackberry',
	'gmail' => 'gmail',
	'token' => 'token'
    );
    $this->defineOne2One('role', 'role_id', 'User_Role_Model');
    $this->defineOne2One('department', 'department_id', 'User_Department_Model');
    parent::__construct();
  }

}

?>
