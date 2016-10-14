<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Xml_Sitemap {

  protected $rows = array();
  protected $encoding;

  public function __construct($encoding = 'UTF-8') {
    $this->encoding = $encoding;
  }

  public function addRow(Amhsoft_Xml_Sitemap_Row $row) {
    $this->rows[] = $row;
  }
  
  public function getRowsCount(){
    return count($this->rows);
  }

  public function pingGoolge(Amhsoft_Http $req, $xmlfilepath = null) {
    return $req->execute('http://www.google.com/webmasters/tools/ping', '', 'GET', array('sitemap' => $xmlfilepath));
  }

  public function pingBing(Amhsoft_Http $req, $xmlfilepath = null) {
    return $req->execute('http://www.bing.com/webmaster/ping.aspx', '', 'GET', array('sitemap' => $xmlfilepath));
  }

  public function toFile($path) {
    $r = @file_put_contents($path, (string) $this);
    if(!$r){
      throw new Amhsoft_Exception('cannot create file');
    }
  }

  public function __toString() {
    $xmlData = '<?xml version="1.0" encoding="' . $this->encoding . '" ?>' . PHP_EOL;
    $xmlData .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
    foreach ($this->rows as $row) {
      $xmlData .= (string) $row;
    }
    $xmlData .= '</urlset>' . PHP_EOL;
    return $xmlData;
  }

}
?>
