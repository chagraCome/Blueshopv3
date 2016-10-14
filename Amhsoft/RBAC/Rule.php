<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Rule.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_RBAC_Rule {

  public $name;
  public $label;
  public $group;

  public function __construct($name, $label, $group = null) {
    $this->name = $name;
    $this->label = $label;
    $this->group = $group;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getLabel() {
    return $this->label;
  }

  public function setLabel($label) {
    $this->label = $label;
  }

  public function getGroup() {
    return $this->group;
  }

  public function setGroup($group) {
    $this->group = $group;
  }

  public function hasChildern() {
    return ($this->group == null);
  }

  public function getChildern() {
    return Amhsoft_RBAC_Rule_Manager::getByGroup($this->getName());
  }

}

?>
