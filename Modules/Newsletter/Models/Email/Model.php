<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Newsletter_Email_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer id */
  public $id;

  /** @var string email */
  public $email;

  /** @var boolean state */
  public $state;

  /** @var Newsletter_Email_Group_Model group */
  public $group;

  public $newsletter_email_groups_id;
  /**
   * Check of null for id.
   * @return boolean True if id is null, false otherwise.
   */
  public function isIdNull() {
    return intval($this->id == 0);
  }

  /**
   * Check of null for email.
   * @return boolean True if email is null, false otherwise.
   */
  public function isEmailNull() {
    return ($this->email == null || trim($this->email) == '');
  }

  /**
   * Check of null for state.
   * @return boolean True if state is null, false otherwise.
   */
  public function isStateNull() {
    return (!$this->state);
  }

  /**
   * Check of null for group.
   * @return boolean True if group is null, false otherwise.
   */
  public function isGroupNull() {
    return (!$this->group);
  }

  /**
   * Get id
   * @return integer id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get email
   * @return string email
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Get state
   * @return boolean state
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Get group
   * @return Newsletter_Email_Group_Model group
   */
  public function getGroup() {
    return $this->group;
  }

  /**
   * Set id
   * @param integer $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Set email
   * @param string $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }

  /**
   * Set state
   * @param boolean $state
   */
  public function setState($state) {
    $this->state = $state;
  }

  /**
   * Set newsletter email_groups model
   * @param Newsletter_Email_Group_Model $group email_groups model
   */
  public function setGroup(Newsletter_Email_Group_Model $group) {
    $this->group = $group;
  }

  /**
   * Construct model.
   * @param integer $id primary key of db table
   */
  public function __construct($id = null) {
    if ($id) {
      $this->id = $id;
    }
  }

}

?>
