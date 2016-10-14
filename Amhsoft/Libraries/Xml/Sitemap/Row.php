<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Xml_Sitemap_Row {

  protected $link;
  protected $time;
  protected $freq;
  protected $priority;
  
  public function __construct($link, $modificationtime, $freq='weekly', $priority='0.7') {
    $this->link = $link;
    $this->time = $modificationtime;
    $this->freq = $freq;
    $this->priority = $priority;
  }
  
  public function getLink() {
    return $this->link;
  }

  public function getTime() {
    return $this->time;
  }

  public function getFreq() {
    return $this->freq;
  }

  public function getPriority() {
    return $this->priority;
  }

  
  public function __toString() {
    $line = '<url>' . PHP_EOL;
    $line .= '<loc>' .$this->link . '</loc>' . PHP_EOL;
    $line .= '<lastmod>' . date('c', strtotime($this->time)) . '</lastmod>' . PHP_EOL;
    $line .= '<changefreq>weekly</changefreq>' . PHP_EOL;
    $line .= '<priority>0.7</priority>' . PHP_EOL;
    $line .= '</url>' . PHP_EOL;
    return $line;
  }

}

?>
