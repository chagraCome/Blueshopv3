<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Xml_Rss2_Row {

  protected $link;
  protected $time;
  protected $title;
  protected $description;
  protected $author;
  protected $guid;
  
  public function __construct($title =null, $link=null, $guid=null, $author=null, $time=null, $description=null) {
    $this->title = $title;
    $this->link = $link;
    $this->guid = $guid;
    $this->author  = $author;
    $this->time = $time;
    $this->description = $description;
  }
  
  public function getLink() {
    return $this->link;
  }

  public function setLink($link) {
    $this->link = $link;
  }

  public function getTime() {
    return $this->time;
  }

  public function setTime($time) {
    $this->time = $time;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor($author) {
    $this->author = $author;
  }

  public function getGuid() {
    return $this->guid;
  }

  public function setGuid($guid) {
    $this->guid = $guid;
  }

    
  public function __toString() {
    $line = '<item>' . PHP_EOL;
    $line .= '<title>'.$this->getTitle().'</title>'.PHP_EOL;
    $line .= '<description><![CDATA['.$this->getDescription().']]></description>'.PHP_EOL;
    $line .= '<link>' .$this->getLink() . '</link>' . PHP_EOL;
    $line .= '<author>'.$this->getAuthor().'</author>' . PHP_EOL;
    $line .= '<guid>'.$this->getGuid().'</guid>' . PHP_EOL;
    $line .= '<pubDate>' . date('c', strtotime($this->getTime())) . '</pubDate>' . PHP_EOL;
    $line .= '</item>' . PHP_EOL;
    return $line;
  }

}

?>