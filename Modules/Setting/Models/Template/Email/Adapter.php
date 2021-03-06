<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Template_Email_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'email_template';
    $this->className = 'Setting_Template_Email_Model';
    $this->map = array(
	'id' => 'id',
	'name' => 'name'
    );
    parent::__construct();
  }

  /**
   * Get Joint Column
   * @return string
   */
  public function getJoinColumn() {
    return "email_template_id";
  }

  /**
   * Get Language Map
   * @return type
   */
  public function getLangMap() {
    return array(
	'subject' => 'subject',
	'content' => 'content',
    );
  }

  /**
   * Get Language Table Name
   * @return string
   */
  public function getLanguageTableName() {
    return "email_template_lang";
  }

}

?>
