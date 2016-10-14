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
class User_Role_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  public function __construct() {
    $this->table = 'rbac_role';
    $this->className = 'User_Role_Model';
    $this->map = array(
	'id' => 'id',
	'state' => 'state'
    );
    $this->defineOne2One('parent', 'parent_id', 'User_Role_Model', false, false);
    parent::__construct();
  }

  public function getJoinColumn() {
    return 'rbac_role_id';
  }

  public function getLangMap() {
    return array('name' => 'name');
  }

  public function getLanguageTableName() {
    return 'rbac_role_lang';
  }

}

?>
