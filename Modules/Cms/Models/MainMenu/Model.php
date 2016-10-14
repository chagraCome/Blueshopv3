<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:38:59
 */
class Cms_MainMenu_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer $id */
  public $id;

  /** @var string $name */
  public $name;

  /** @var boolean $state */
  public $state;
  public $box_id;
  public $sites = array();

  /**
   * Construct model.
   *
   * @param integer $id primary key of db table
   */
  public function __construct() {
    
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
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets Name
   * @return type
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name
   * @param type $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Gets State
   * @return type
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Set state
   * @param type $state
   */
  public function setState($state) {
    $this->state = $state;
  }

  public function __toString() {
    return $this->getName();
  }

}