<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Abstract_Model {

  protected $fields = array();
  protected $productionUrl;
  protected $sandBoxUrl;
  protected $isTestMode = false;
  protected $waitMessage = 'Please wait, your order is being processed...';

  /**
   * Get Url
   * @return type
   */
  public function getUrl() {
    return $this->isTestMode() ? $this->getSandBoxUrl() : $this->getProductionUrl();
  }

  /**
   * Get ProductionUrl
   * @return type
   */
  public function getProductionUrl() {
    return $this->productionUrl;
  }

  /**
   * Set Production Url
   * @param type $productionUrl
   */
  public function setProductionUrl($productionUrl) {
    $this->productionUrl = $productionUrl;
  }

  /**
   * Get SandBox Url
   * @return type
   */
  public function getSandBoxUrl() {
    return $this->sandBoxUrl;
  }

  /**
   * Set SandBox Url
   * @param type $sandBoxUrl
   */
  public function setSandBoxUrl($sandBoxUrl) {
    $this->sandBoxUrl = $sandBoxUrl;
  }

  /**
   * Check if Test Mode
   * @return type
   */
  public function isTestMode() {
    return $this->isTestMode;
  }

  /**
   * Set Test Mode
   * @param type $isTestMode
   */
  public function setTestMode($isTestMode) {
    $this->isTestMode = (bool) $isTestMode;
  }

  /**
   * Get Wait Message
   * @return type
   */
  public function getWaitMessage() {
    return $this->waitMessage;
  }

  /**
   * Set Wait Message
   * @param type $waitMessage
   */
  public function setWaitMessage($waitMessage) {
    $this->waitMessage = $waitMessage;
  }

  /**
   * Add Field
   * @param type $key
   * @param type $value
   */
  public function addField($key, $value) {
    $this->fields[$key] = $value;
  }

  /**
   * Invoke As HTML
   */
  public function invokeAsHtml() {
    echo "<html>\n";
    echo "<head><title>Processing Payment...</title></head>\n";
    echo "<body onLoad=\"document.form.submit();\">\n";
    echo "<center><h3>" . $this->getWaitMessage() . "</h3></center>\n";
    echo "<form method=\"post\" name=\"form\" action=\"" . $this->getUrl() . "\">\n";
    foreach ($this->fields as $name => $value) {
      echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
    }
    echo "</form>\n";
    echo "</body></html>\n";
    exit;
  }

  /**
   * Display as Html
   */
  public function displayAsHtml() {
    echo "<html>\n";
    echo "<head><title>Processing Payment...</title></head>\n";
    echo "<body>\n";
    echo "<center><h3>" . $this->getWaitMessage() . "</h3></center>\n";
    echo "<form method=\"post\" name=\"form\" action=\"" . $this->getUrl() . "\">\n";
    foreach ($this->fields as $name => $value) {
      echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
    }
    echo "</form>\n";
    echo "</body></html>\n";
    exit;
  }

  /**
   * Invoke As Curl
   */
  protected function invokeAsCurl() {
    
  }

}

?>
