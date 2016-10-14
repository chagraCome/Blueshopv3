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
class Crm_Lead_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct() {
    $this->table = 'lead';
    $this->className = 'Crm_Lead_Model';
    $this->map = array(
	'id' => 'id',
	'number' => 'number',
	'company' => 'company',
	'firstname' => 'firstname',
	'lastname' => 'lastname',
	'date_of_birth' => 'date_of_birth',
	'phone' => 'phone',
	'email' => 'email',
	'mobile' => 'mobile',
	'fax' => 'fax',
	'state' => 'state',
	'create_date_time' => 'create_date_time',
	'update_date_time' => 'update_date_time',
	'notice' => 'notice',
	'company_website' => 'company_website',
    );
    $this->defineOne2One('group', 'lead_group_id', 'Crm_Lead_Group_Model');
    $this->defineOne2One('source', 'lead_source_id', 'Crm_Lead_Source_Model');
    $this->defineOne2Many('mails', 'lead_id', 'Crm_MailInbox_Model');
    parent::__construct();
  }

}

?>
