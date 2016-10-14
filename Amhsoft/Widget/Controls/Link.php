<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Link.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * link component
 * @author Amir Cherif
 */
class Amhsoft_Link_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var string action/target of link/anchor as URI */
  public $Href;

  /** @var string browser window target (e.g. open new windows) */
  public $Target;
  public $Alias;
  public $Fragment;
  public $DisplayValue = false;
  public $ValueToDisplay;
  public $overrideRender;
  protected $popup = false;
  protected $popupWidth = 500;
  protected $popupHeight = 400;
  public $MaxChar = 1000;

  /**
   * Construct component.
   * @param string $label label of anchor/link
   * @param string $href URI/action of link
   * @param string $target browser window target
   */
  public function __construct($label, $href = null, $target = '', $fragment = null) {
    parent::__construct($label);
    $this->Label = $label;
    $this->Target = $target;
    $this->Href = $href;
    //$this->Fragment = ($fragment == null) ? @$_GET['module'] : $fragment;
  }

  public function getHref() {
    return $this->Href;
  }

  public function setHref($Href) {
    $this->Href = $Href;
  }

  public function getTarget() {
    return $this->Target;
  }

  public function setTarget($Target) {
    $this->Target = $Target;
  }

  public function getAlias() {
    return $this->Alias;
  }

  public function setAlias($Alias) {
    $this->Alias = $Alias;
  }

  public function getFragment() {
    return $this->Fragment;
  }

  public function setFragment($Fragment) {
    $this->Fragment = $Fragment;
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {
    
  }

  public function onClickOpenInPopUp($width, $height) {
    $this->popup = true;
    $this->popupWidth = $width;
    $this->popupHeight = $height;
  }

  /**
   * Draw/Render component
   * @return string output like HTML
   */
  public function Render() {

    $this->applyFilters();
    foreach ($this->filters as $filter) {
      $this->ValueToDisplay = $filter->apply($this->ValueToDisplay);
    }

    if ($this->popup == true) {
      $this->JavaScript = "return onClick='popup(\"" . $this->Href . "\", $this->popupWidth, $this->popupHeight)'";
      $this->Href = 'javascript:void(0)';
    }

    if ($this->overrideRender != null) {
      return $this->overrideRender->dispatchEvent($this);
    }

    $fragment = $this->Fragment == null ? null : '#' . $this->Fragment;
    $str = '<a href="' . $this->Href . $fragment . '"';
    if ($this->Target)
      $str .= ' target="' . $this->Target . '"';
    if ($this->Class) {
      $str .= ' class="' . $this->Class . '"';
    }
    if ($this->JavaScript) {
      $str .= ' ' . $this->JavaScript . ' ';
    }
    if ($this->Id) {
      $str .= ' id="' . $this->Id . '"';
    }
    if ($this->DisplayValue == true)
      $str .= '>' . $this->ValueToDisplay . '</a>';
    else
      $str .= '>' . $this->Label . '</a>';

    return $str;
  }

}
