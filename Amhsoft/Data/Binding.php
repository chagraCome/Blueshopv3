<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Binding.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Amhsoft_DataBinding_Component class.
 * @author Amir Cherif
 */
class Amhsoft_Data_Binding {

  /** @var <type> ... */
  public $Value;
  /** @var <type> ... */
  public $Index;
  /** @var <type> ... */
  public $SelectedItem;
  /** @var <type> ... */
  public $Text;
  /** @var <type> ... */
  public $callback;

  /**
   * Gets Value of Databinding.
   * @return mixed
   */
  public function getValue() {
    return $this->Value;
  }

  /**
   * Set Value of Databinding.
   * @param mixes $Value
   */
  public function setValue($Value) {
    $this->Value = $Value;
  }

  /**
   * Gets index.
   * @return mixed index.
   */
  public function getIndex() {
    return $this->Index;
  }

  /**
   * Sets index.
   * @param mixed $Index
   */
  public function setIndex($Index) {
    $this->Index = $Index;
  }

  /**
   * Gets selected item.
   * @return mixed
   */
  public function getSelectedItem() {
    return $this->SelectedItem;
  }

  /**
   * Sets selected item.
   * @param mixes $SelectedItem
   */
  public function setSelectedItem($SelectedItem) {
    $this->SelectedItem = $SelectedItem;
  }

  /**
   * Gets Text
   * @return mixed text
   */
  public function getText() {
    return $this->Text;
  }

  /**
   * Sets Text.
   * @param mixed $Text
   */
  public function setText($Text) {
    $this->Text = $Text;
  }

  /**
   * Bind a Component with other components.
   * @param string $value
   * @param string $index
   * @param string $text
   * @param string|int|float $selectedItem
   */
  public function __construct($value, $index = null, $text = null, $selectedItem = null) {
    $this->Value = $value;
    $this->Index = ($index == null) ? $value : $index;
    $this->Text = $text;
    $this->SelectedItem = $selectedItem;
  }

}
