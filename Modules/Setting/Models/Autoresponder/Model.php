<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Autoresponder_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer $id */
  public $id;

  /** @var string $name */
  public $name;

  /** @var string $subject */
  public $subject;

  /** @var string $body */
  public $body;

  /** @return boolean true if is null. */
  public function isIdNull() {
    return intval($this->id == 0);
  }

  /** @return boolean true if is null. */
  public function isNameNull() {
    return ($this->name == null || trim($this->name) == '');
  }

  /** @return boolean true if is null. */
  public function isSubjectNull() {
    return ($this->subject == null || trim($this->subject) == '');
  }

  /** @return boolean true if is null. */
  public function isBodyNull() {
    return ($this->body == null || trim($this->body) == '');
  }

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   * @return \Setting_Autoresponder_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

}
?>

