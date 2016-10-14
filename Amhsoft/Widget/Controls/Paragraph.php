<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Paragraph.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Text paragraph tag component
 * @author Thomas Häber
 */
class Amhsoft_Paragraph_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  /** @var string style attribute value */
  public $Style;

  /**
   * Construct component
   * @param string $name id-name of component
   * @param string $value value of component
   */
  public function __construct($name, $value = null) {
    parent::__construct($name, $value);
  }

  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Draw() {
    $class_attribute = $this->Class ? ' class="' . $this->Class . '"' : '';
    $style_attribute = $this->Style ? ' style="' . $this->Style . '"' : '';
    return '<p' . $class_attribute . $style_attribute . '>' . nl2br($this->Value) . '</p>';
  }

  /**
   * Get style attribute value
   * @return string Style attribute value
   */
  public function getStyle() {
    return $this->Style;
  }

  /**
   * Set style attribute value
   * @param string $Style
   */
  public function setStyle($Style) {
    $this->Style = $Style;
  }


}
