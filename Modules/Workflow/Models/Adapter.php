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
class Workflow_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  /**
   * Construct a new WorkFlow_Model_Adapter
   */
  public function __construct() {
    $this->table = 'workflow';
    $this->className = 'Workflow_Model';
    $this->map = array(
        'id' => 'id',
        'modelname' => 'modelname',
        'eventname' => 'eventname',
        'state' => 'state',
        'modelname' => 'modelname',
        'trigger_name' => 'trigger_name'
    );
    $this->defineOne2Many("conditions", "workflow_id", "Workflow_Condition_Model");
    $this->defineOne2Many("smsactions", "workflow_id", "Workflow_Action_Sms_Model");
     $this->defineOne2Many("mailactions", "workflow_id", "Workflow_Action_Mail_Model");
    parent::__construct();
  }

  public function getJoinColumn() {
    return "workflow_id";
  }

  public function getLangMap() {
    return array(
        'name' => 'name'
    );
  }

  public function getLanguageTableName() {
    return "workflow_lang";
  }

  public function fetchByTriggerName($triggerName){
      $adapter = new Workflow_Model_Adapter();
      $adapter->where('trigger_name = ?', $triggerName, PDO::PARAM_STR);
      $result = $adapter->fetch();
      if($adapter->getCount() > 0){
          return $result->fetch();
      }else{
          return null;
      }
  }
  
}

?>
