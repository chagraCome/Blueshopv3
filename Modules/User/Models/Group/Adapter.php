<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Group_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct() {
    $this->table = 'user_group';
    $this->className = 'User_Group_Model';
    $this->map = array(
	'id' => 'id',
	'name' => 'name',
	'alias' => 'alias'
    );
    $this->defineMany2Many('users', 'User_User_Model', 'user_group_has_user', 'user_group_id', 'user_id', true, true);
    parent::__construct();
  }

}

?>
