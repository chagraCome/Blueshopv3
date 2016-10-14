<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Setting_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'webmail_server_setting';
    $this->className = 'Webmail_Setting_Model';
    $this->map = array('id' => 'id',
	'name' => 'name',
	'email' => 'email',
	'user_id' => 'user_id',
	'type' => 'type',
	'host' => 'host',
	'port' => 'port',
	'encryption' => 'encryption',
	'cert' => 'cert',
	'global' => 'global',
	'last_update_date_time' => 'last_update_date_time',
	'signature' => 'signature',
	'password' => 'password',
	'hash' => 'hash',
    );
    parent::__construct();
  }

}

?>
