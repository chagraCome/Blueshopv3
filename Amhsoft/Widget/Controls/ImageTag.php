<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ImageTag.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Image tag (<img ... />) component.
 * @author Thomas Häber
 */
class Amhsoft_ImageTag_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var string image source URL */
  private $Src = '';
  /** @var string image alternative text */
  private $Alt = '';
  /** @var string image title text */
  private $Title;
  /** @var string image height */
  private $Height;
  /** @var string image border */
  private $Border = 0;
  /** @var string style attribute value */
  public $Style;

  /**
   * Construct component label and bind data to label
   * @param string $label label text for component
   * @param Databinding $dataBinding dataBinding for this label
   */
  public function __construct($label, $src, $width=0, $height=0, $alt = '', Databinding $dataBinding = null) {
    parent::__construct('label');
    $this->Label = $label;
    $this->DataBinding = $dataBinding;
    if (!empty($src)) {
      $this->setSrc($src);
    }
    if (!empty($width) && $width > 0) {
      $this->setWidth($width);
    }
    if (!empty($height) && intval($height) > 0) {
      $this->setHeight($height);
    }
    if (strlen(trim($alt)) > 0) {
      $this->setAlt($alt);
    }
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {
    $html_value = ($this->Value == null) ? $this->Src : $this->Value;
    $html_width = ($this->Width == null) ? '' : ' width="' . $this->Width . '"';
    $html_height = ($this->Height == null) ? '' : ' height="' . $this->Height . '"';
    
    $html_width_style = ($this->Width == null) ? '' : ' max-width:' . $this->Width . ';';
    $html_height_style = ($this->Height == null) ? '' : ' max-height:' . $this->Height . ';';
    
    $this->Style .= $html_width_style.$html_height_style;
    
    $html_title = ($this->Title == null) ? '' : ' title="' . $this->Title . '"';
    $html_class = ($this->Class == null) ? '' : ' class="' . $this->Class . '"';
    $html_style = ($this->Style == null) ? '' : ' style="' . $this->Style . '"';
    
    
    return '<img src="' . $html_value . '" alt="' . $this->Alt . '"' . $html_width . $html_title . $html_class . $html_style . ' />';
  }

  /**
   * get source URI of image
   * @return string source URI of image
   */
  public function getSrc() {
    return $this->Src;
  }

  /**
   * set source URI of image
   * @param string $Src source URI of image
   */
  public function setSrc($Src) {
    $this->Src = $Src;
  }

  public function getAlt() {
    return $this->Alt;
  }

  public function setAlt($Alt) {
    $this->Alt = $Alt;
  }

  public function getTitle() {
    return $this->Title;
  }

  public function setTitle($Title) {
    $this->Title = $Title;
  }

  public function getHeight() {
    return $this->Height;
  }

  public function setHeight($Height) {
    $this->Height = $Height;
  }

  public function getBorder() {
    return $this->Border;
  }

  public function setBorder($Border) {
    $this->Border = $Border;
  }

  public function getStyle() {
    return $this->Style;
  }

  public function setStyle($Style) {
    $this->Style = $Style;
  }

}
