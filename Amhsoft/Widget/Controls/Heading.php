<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Heading.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Amhsoft_Heading_Control tag (h1-h6) component
 * @author Thomas Häber
 */
class Amhsoft_Heading_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  private $possibleLevels = array(1, 2, 3, 4, 5, 6);
  private $Level = 1;

  /**
   * Construct component label and bind data to label
   * @param string $label label text for component
   * @param Databinding $dataBinding dataBinding for this label
   */
  public function __construct($label, Databinding $dataBinding = null, $level = 1) {
    parent::__construct('label');
    $this->Label = $label;
    $this->DataBinding = $dataBinding;
    if (in_array($level, $this->possibleLevels, true)) {
      $this->Level = $level;
    }
  }

  /**
   * get output HTML / string represantation of Control
   * @return string output HTML / string represantation of Control
   */
  public function Draw() {
    $html_value = ($this->Value == null) ? '' : $this->Value;
    return '<h' . $this->Level . '>' . (($this->Value == null) ? $this->Label : $this->Value) . '</h' . $this->Level . '>' . PHP_EOL . $html_value;
  }

}
