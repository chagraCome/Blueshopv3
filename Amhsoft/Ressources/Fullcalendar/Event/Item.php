<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Ressources_Fullcalendar_Event_Item {

  public $id;
  public $eventName;
  public $start;
  public $end;
  public $url;
  public $color = 'green';

  function __construct($id = null, $eventName = null, $start = null, $end = null, $url = null, $color = 'green') {
    $this->id = $id;
    $this->eventName = $eventName;
    $this->start = $start;
    $this->end = $end;
    $this->url = $url;
    $this->color = $color;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getEventName() {
    return $this->eventName;
  }

  public function setEventName($eventName) {
    $this->eventName = $eventName;
  }

  public function getStart() {
    return $this->start;
  }

  public function setStart($start) {
    $this->start = $start;
  }

  public function getEnd() {
    return $this->end;
  }

  public function setEnd($end) {
    $this->end = $end;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getColor() {
    return $this->color;
  }

  public function setColor($color) {
    $this->color = $color;
  }

  public function asArray() {
    return array(
        'id' => $this->getId(),
        'title' => $this->getEventName(),
        'start' => $this->getStart(),
        'end' => $this->getEnd(),
        'url' => $this->getUrl(),
        'allDay' => false,
        'color' => $this->getColor()
    );
  }

}

?>
