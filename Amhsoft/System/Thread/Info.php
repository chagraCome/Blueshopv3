<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Thread_Info {

  public $total;
  public $progress;
  public $percent;
  public $message;

  public function fromArray($array) {
    foreach ($array as $key => $val) {
      $this->{$key} = $val;
    }
    return $this;
  }

  public function getTotal() {
    return $this->total;
  }

  public function setTotal($total) {
    $this->total = $total;
  }

  public function getProgress() {
    return $this->progress;
  }

  public function setProgress($progress) {
    $this->progress = $progress;
  }

  public function getPercent() {
    return $this->percent;
  }

  public function setPercent($percent) {
    $this->percent = $percent;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

}

?>
