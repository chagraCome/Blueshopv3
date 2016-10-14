<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Box.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Box_Layout implements Amhsoft_Widget_Interface {

  /** @var boolean True, for horizontal orientation, false for vertical orientation */
  private $horizontal = true;
  /** @var array components in this layout */
  private $components = array();
  /** @var boolean left to right */
  private $ltr = true;
  /** @var integer spacing */
  private $spacing = 0;

  /**
   *
   * @param ooolean $horizontal
   */
  public function __construct($horizontal = true) {
    $this->components = new SplObjectStorage();
    if (is_bool($horizontal)) {
      $this->horizontal = $horizontal;
    }
  }

  /**
   * Get the number of columns in this layout.
   */
  public function getColumns() {
    return count($this->components);
  }

  public function addComponent(Amhsoft_Widget_Interface $component) {
    if ($component !== $this) {
      $this->components->offsetSet($component);
    }
  }

  public function hasComponent(Amhsoft_Widget_Interface $component) {
    return ($this->components->contains($component)) ? true : false;
  }

  public function removeComponent(Amhsoft_Widget_Interface $component) {
    if ($this->hasComponent($component)) {
      $this->components->detach($component);
    }
  }

  public function setComponents(SplObjectStorage $components) {
    $this->components = new SplObjectStorage(); // reset components
    $this->components->addAll($components);
  }

  public function getComponents() {
    return $this->components;
  }

  public function isLtr() {
    return $this->ltr;
  }

  public function setLtr($ltr) {
    $this->ltr = $ltr;
  }

  public function getHorizontal() {
    return $this->horizontal;
  }

  public function setHorizontal($horizontal) {
    $this->horizontal = $horizontal;
  }

  public function getSpacing() {
    return $this->spacing;
  }

  public function setSpacing($spacing) {
    $this->spacing = $spacing;
  }

  public function Render() {
    $this->components->rewind();
    $spacing = ($this->spacing > 0) ? 'border-spacing:' . $this->spacing . 'px"' : '';
    $ltr = ($this->ltr == true) ? ' dir="ltr"' : ' dir="rtl"';
    $out = '<table style="width:100%;' . $spacing . '"' . $ltr . '>';
    $cnt = $this->components->count();

    if ($this->horizontal) { // horizontal direction
      $out .= '<tr>';
      for ($i = 0; $i < $cnt; $i++) {
        $out .= '<td>';
        if ($this->components->valid()) {
          $out .= $this->components->current();
        }
        $out .= '</td>';
        $out .= '<td>xxxxx</td>';
        $this->components->next();
      }
      $out .= '</tr>';
    } else { // vertical direction
      for ($i = 0; $i < $cnt; $i++) {
        $out .= '<tr><td>';
        if ($this->components->valid()) {
          $out .= $this->components->current()->Render();
        }
        $out .= '</td></tr>';
        $this->components->next();
      }
    }

    $out .= '</table>';

    return $out;
  }



}
