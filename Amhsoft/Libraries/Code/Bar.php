<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include dirname(__FILE__) . '/Bar/Barcode39.php';
class Amhsoft_Code_Bar {

  const CODE_39 = 39;

  protected $decorator;

  public function __construct($code, $codetype = 39) {
    if ($codetype == 39) {
      $this->decorator = new Barcode39($code);
    }
  }

  public function asRessource() {
    return $this->decorator->draw(null, false, true);
  }

  public function asBase64() {
    return $this->decorator->draw(null, true);
  }

  public function asFile($fileName) {
    return $this->decorator->draw($fileName);
  }

  public function draw() {
    return $this->decorator->draw();
  }

  public function setHeight($height) {
    $this->decorator->setHeight($height);
  }

  public function setWidth($width) {
    $this->decorator->setWidth($width);
  }

}

?>
