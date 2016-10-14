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
class Workflow_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $eventname;
  public $modelname;
  public $name;
  public $state;
  public $conditions = array();
  public $smsactions = array();
  public $mailactions = array();
  public $trigger_name;

  /**
   * Gets WorkFlow id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets WorkFlow id.
   * @param Integer $id
   * @return Workflow_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets WorkFlow eventname.
   * @return String $eventname
   */
  public function getEventname() {
    return $this->eventname;
  }

  /**
   * Sets WorkFlow eventname.
   * @param String $eventname
   * @return Workflow_Model
   */
  public function setEventname($eventname) {
    $this->eventname = $eventname;
    return $this;
  }
  
  public function getModelname() {
      return $this->modelname;
  }

  public function setModelname($modelname) {
      $this->modelname = $modelname;
  }

  
  /**
   * Gets WorkFlow name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets WorkFlow name.
   * @param String $name
   * @return Workflow_Model
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets WorkFlow state.
   * @return Boolean $state
   */
  public function getState() {
    return $this->state;
  }
  
  public function getTriggerName() {
      return $this->trigger_name;
  }

  public function setTriggerName($trigger_name) {
      $this->trigger_name = $trigger_name;
  }

  
  public function calculateTrigger(){
      return 'after.'.strtolower($this->getEventname().'.'.strtolower($this->getModelname()));
  }
  
  /**
   * Sets WorkFlow state.
   * @param Boolean $state
   * @return Workflow_Model
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Add Condition to WorkFlow.
   * @param Workflow_Condition_Model $condition
   * @return Workflow_Model
   */
  public function addCondition(Workflow_Condition_Model $condition) {
    $this->conditions[] = $condition;
    return $this;
  }

  /**
   * Gets Workflow Conditions.
   * @return Array of Workflow_Condition_Model $conditions
   */
  public function getConditions() {
    return $this->conditions;
  }

  public function getSmsactions() {
    return $this->smsactions;
  }

  public function addSmsactions(Workflow_Action_Sms_Model $smsaction) {
    $this->smsactions[] = $smsaction;
    return $this;
  }

  public function getMailactions() {
    return $this->mailactions;
  }

  public function addMailactions(Workflow_Action_Mail_Model $mailaction) {
    $this->mailactions[] = $mailaction;
  }




}

?>
