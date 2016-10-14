<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Collection.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package  Amhsoft
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Data_Collection implements Countable, Iterator {

  private $data = array();

  public function __construct($data = array()) {
    $this->data = $data;
    $this->rewind();
  }

  public function add($item) {
    $this->data[] = $item;
  }

  public function get($i) {
    return isset($this->data[$i]) ? $this->data[$i] : null;
  }

  public function getAll() {
    return $this->data;
  }

  public function count() {
    return count($this->data);
  }

  function rewind() {
    return reset($this->data);
  }

  function current() {
    return current($this->data);
  }

  function key() {
    return key($this->data);
  }

  function next() {
    return next($this->data);
  }

  function valid() {
    return key($this->data) !== null;
  }

}
