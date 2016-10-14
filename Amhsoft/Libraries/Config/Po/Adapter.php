<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Config_Po_Adapter extends Amhsoft_Config_Abstract {

  protected $data = null;

  public function __construct($filename) {

    
    $this->data = array();

    $po_string = file_get_contents($filename);
    
    $matches = array();
    preg_match_all('/^#\s*(.+?)\r?\nmsgid "(.+?)"\r?\nmsgstr "(.+?)"/m', $po_string, $matches);#
    if (count($matches) > 2) {
      $this->data = (array)@array_combine($matches[2], $matches[3]);
    }
	

//    $PO = FILE($FILENAME);
//    FOREACH ((ARRAY) $PO AS $LINE) {
//      IF (SUBSTR($LINE, 0, 5) == 'MSGID') {
//        $CURRENT = TRIM(SUBSTR(TRIM(SUBSTR($LINE, 5)), 1, -1));
//      }
//      IF (SUBSTR($LINE, 0, 6) == 'MSGSTR') {
//        $TRANSLATION_KEY = TRIM(SUBSTR(TRIM(SUBSTR($LINE, 6)), 1, -1));
//        IF ($CURRENT) {
//          $THIS->DATA[$CURRENT] = ($TRANSLATION_KEY) ? $TRANSLATION_KEY : $CURRENT;
//        }
//      }
//    }
  }

  /**
   * @deprecated since version 1.0
   * @return array
   */
  public function getConfiguration() {
    return $this->data;
  }

  public function getDataAsArray() {
    return $this->data;
  }

  public function getValue($key, $defaultValue = null) {
    if ($this->hasKey($key)) {
      return $this->data[$key];
    } else {
      return $defaultValue;
    }
  }

  public function hasKey($key) {
    return isset($this->data[$key]);
  }

  public function getArrayValue($key) {
    return (array) $this->getValue($key);
  }

  public function getDoubleValue($key) {
    return (double) $this->getValue($key);
  }

  public function getIntValue($key) {
    return (int) $this->getValue($key);
  }

  public function getStringValue($key) {
    return (string) $this->getValue($key);
  }

}

?>
