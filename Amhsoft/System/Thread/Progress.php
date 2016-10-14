<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Thread_Progress {

  private $progress = 0;
  private $message = '';
  private $tag = null;
  private $totalStepCount = 1;
  private $percent = 0;

  /** @var Amhsoft_System_Thread_Event $progressChanged */
  public $progressChanged;

  public function __construct($progress = 0, $message = null, $tag = null) {
    $this->progress = $progress;
    $this->message = $message;
    $this->tag = $tag;
    $this->progressChanged = new Amhsoft_System_Thread_Event();
  }

  public function getProgress() {
    return $this->progress;
  }

  public function setProgress($progress) {
    $this->progress = $progress;
    $this->notify();
  }

  public function getPercent() {
    return floor(100 * $this->progress / $this->totalStepCount);
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
    $this->notify();
  }

  public function getTag() {
    return $this->tag;
  }

  public function setTag($tag) {
    $this->tag = $tag;
    $this->notify();
  }

  public function setTotalStepCount($totalStepCount) {
    $this->totalStepCount = $totalStepCount;
    $this->notify();
  }

  public function getTotalSteps() {
    return $this->totalStepCount;
  }

  public function increment($step = 1, $message = null) {
    $this->progress += $step;
    $this->message = $message;
    $this->notify();
  }

  private function notify() {
    if ($this->progressChanged) {
      $this->progressChanged->dispatchEvent($this);
    }
  }

}

?>
