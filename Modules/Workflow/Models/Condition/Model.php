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
class Workflow_Condition_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $condition_left;
  public $condition_right;
  public $condition_op;
  public $state;

  /**
   * Gets Workflow Condition id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Workflow Condition id.
   * @param Integer $id
   * @return Workflow_Condition_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Workflow Condition condition_left.
   * @return String $condition_left
   */
  public function getConditionLeft() {
    return $this->condition_left;
  }

  /**
   * Sets Workflow Condition condition_left.
   * @param String $condition_left
   * @return Workflow_Condition_Model
   */
  public function setConditionLeft($condition_left) {
    $this->condition_left = $condition_left;
    return $this;
  }

  /**
   * Gets Workflow Condition condition_right.
   * @return String $condition_right
   */
  public function getConditionRight() {
    return $this->condition_right;
  }

  /**
   * Sets Workflow Condition condition_right.
   * @param String $condition_right
   * @return Workflow_Condition_Model
   */
  public function setConditionRight($condition_right) {
    $this->condition_right = $condition_right;
    return $this;
  }

  /**
   * Gets Workflow Condition condition_op.
   * @return String $condition_op
   */
  public function getConditionOp() {
    return $this->condition_op;
  }

  /**
   * Sets Workflow Condition condition_op.
   * @param String $condition_op
   * @return Workflow_Condition_Model
   */
  public function setConditionOp($condition_op) {
    $this->condition_op = $condition_op;
    return $this;
  }

  /**
   * Gets Workflow Condition state.
   * @return Boolean $state
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Sets Workflow Condition state.
   * @param Boolean $state
   * @return Workflow_Condition_Model
   */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

}

?>
