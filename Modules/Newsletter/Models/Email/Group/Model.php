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
class Newsletter_Email_Group_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer id */
  public $id;

  /** @var string name */
  public $name;

  /** @var string desc */
  public $desc;

  /**
   * Check of null for id.
   * @return boolean True if id is null, false otherwise.
   */
  public function isIdNull() {
    return intval($this->id == 0);
  }

  /**
   * Check of null for name.
   * @return boolean True if name is null, false otherwise.
   */
  public function isNameNull() {
    return ($this->name == null || trim($this->name) == '');
  }

  /**
   * Check of null for desc.
   * @return boolean True if desc is null, false otherwise.
   */
  public function isDescNull() {
    return ($this->desc == null || trim($this->desc) == '');
  }

  /**
   * Get id
   * @return integer id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get name
   * @return string name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Get desc
   * @return string desc
   */
  public function getDesc() {
    return $this->desc;
  }

  /**
   * Set id
   * @param integer $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Set name
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Set desc
   * @param string $desc
   */
  public function setDesc($desc) {
    $this->desc = $desc;
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

  public function __toString() {
    return (string)$this->name;
  }

}

?>
