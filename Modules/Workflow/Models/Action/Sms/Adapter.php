<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Action_Sms_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Construct a new WorkFlow_Model_Adapter
   */
  public function __construct() {
    $this->table = 'workflow_sms_action';
    $this->className = 'Workflow_Action_Sms_Model';
    $this->map = array(
        'id' => 'id',
        'from' => 'from',
        'phone' => 'phone',
        'state' => 'state',
        'workflow_id' => 'workflow_id'
    );
    parent::__construct();
  }

  public function getJoinColumn() {
    return "workflow_sms_action_id";
  }

  public function getLangMap() {
    return array(
        'body' => 'body'
    );
  }

  public function getLanguageTableName() {
    return "workflow_sms_action_lang";
  }

}

?>
