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
class Setting_Autoresponder_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct 
   */
  public function __construct() {
    $this->table = 'autoresponder';
    $this->className = 'Setting_Autoresponder_Model';
    $this->map = array(
	'id' => 'id',
	'name' => 'name',
	'subject' => 'subject',
	'body' => 'body',
    );
    parent::__construct();
  }

  /**
   * Fetch by Neme
   * @param type $name
   * @return \Setting_Autoresponder_Model
   */
  public function fetchByName($name) {
    $adapter = new Setting_Autoresponder_Model_Adapter();
    $adapter->where('name=?', $name, PDO::PARAM_STR);
    $e = $adapter->fetch()->fetchAll();
    if (is_array($e)) {
      return $e[0];
    } else {
      return new Setting_Autoresponder_Model();
    }
  }

}

?>
