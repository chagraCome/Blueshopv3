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
class Webmail_Email_Attachment_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {
  /*
   * Model Adapter Construct
   */

  public function __construct() {
    $this->table = 'webmail_attchment';
    $this->className = 'Webmail_Email_Attachment_Model';
    $this->map = array('id' => 'id',
	'webmail_email_id' => 'webmail_email_id',
	'name' => 'name',
	'binary' => 'binary',
	'ext' => 'ext',
	'type' => 'type',
    );
    parent::__construct();
  }

}

?>
