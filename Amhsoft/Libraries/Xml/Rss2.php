<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Xml_Rss2 {

  protected $rows = array();
  protected $encoding;
  protected $title;
  protected $link;
  protected $description;
  protected $copyright;
  protected $pubDate;
  protected $imageUrl;
  protected $imageTitle;
  protected $imageLink;
  protected $language;

  public function __construct($title, $link, $copyright, $encoding = 'UTF-8') {
    $this->encoding = $encoding;
    $this->title = $title;
    $this->link = $link;
    $this->copyright = $copyright;
  }

  public function getEncoding() {
    return $this->encoding;
  }

  public function setEncoding($encoding) {
    $this->encoding = $encoding;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getLink() {
    return $this->link;
  }

  public function setLink($link) {
    $this->link = $link;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getCopyright() {
    return $this->copyright;
  }

  public function setCopyright($copyright) {
    $this->copyright = $copyright;
  }

  public function getPubDate() {
    return $this->pubDate ? $this->pubDate : date('Y-m-d H:i:s');
  }

  public function setPubDate($pubDate) {
    $this->pubDate = $pubDate;
  }

  public function getImageUrl() {
    return $this->imageUrl;
  }

  public function setImageUrl($imageUrl) {
    $this->imageUrl = $imageUrl;
  }

  public function getImageTitle() {
    return $this->imageTitle;
  }

  public function setImageTitle($imageTitle) {
    $this->imageTitle = $imageTitle;
  }

  public function getImageLink() {
    return $this->imageLink;
  }

  public function setImageLink($imageLink) {
    $this->imageLink = $imageLink;
  }

  public function getLanguage() {
    return $this->language ? $this->language : 'en';
  }

  public function setLanguage($language) {
    $this->language = $language;
  }

  public function addRow(Amhsoft_Xml_Rss2_Row $row) {
    $this->rows[] = $row;
  }

  public function getRowsCount() {
    return count($this->rows);
  }

  public function __toString() {
    $xmlData = '<?xml version="1.0" encoding="' . $this->encoding . '" ?>' . PHP_EOL;
    $xmlData .= '<rss version="2.0">' . PHP_EOL;
    $xmlData .= '<channel>' . PHP_EOL;
    $xmlData .= '<title>' . $this->getTitle() . '</title>' . PHP_EOL;
    $xmlData .= '<link>' . $this->getLink() . '</link>' . PHP_EOL;
    $xmlData .= '<description><![CDATA[' . $this->getDescription() . ']]></description>' . PHP_EOL;
    $xmlData .= '<language>' . $this->getLanguage() . '</language>' . PHP_EOL;
    $xmlData .= '<copyright>' . $this->getCopyright() . '</copyright>' . PHP_EOL;
    $xmlData .= '<pubDate>' . date('c', strtotime($this->getPubDate())) . '</pubDate>' . PHP_EOL;
    if ($this->getImageUrl()) {
      $xmlData .= '<image>' . PHP_EOL;
      $xmlData .= '<url>' . $this->getImageUrl() . '</url>' . PHP_EOL;
      $xmlData .= '<title>' . $this->getImageTitle() . '</title>' . PHP_EOL;
      $xmlData .= '<link>' . $this->getImageLink() . '</link>' . PHP_EOL;
      $xmlData .= '</image>' . PHP_EOL;
    }

    foreach ($this->rows as $row) {
      $xmlData .= (string) $row;
    }
    $xmlData .= '</channel>' . PHP_EOL;
    $xmlData .= '</rss>' . PHP_EOL;
    return $xmlData;
  }

}
?>