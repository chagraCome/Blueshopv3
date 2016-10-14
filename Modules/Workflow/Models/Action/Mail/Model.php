<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Action_Mail_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $from;
  public $to;
  public $bcc;
  public $subject;
  public $body;
  public $state;
  public $variablelist;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getFrom() {
    return $this->from;
  }

  public function setFrom($from) {
    $this->from = $from;
  }

  public function getTo() {
    return $this->to;
  }

  public function setTo($to) {
    $this->to = $to;
  }

  public function getBcc() {
    return $this->bcc;
  }

  public function setBcc($bcc) {
    $this->bcc = $bcc;
  }

  public function getSubject() {
    return $this->subject;
  }

  public function setSubject($subject) {
    $this->subject = $subject;
  }

  public function getBody() {
    return $this->body;
  }

  public function setBody($body) {
    $this->body = $body;
  }

  public function getState() {
    return $this->state;
  }

  public function setState($state) {
    $this->state = $state;
  }

  /**
   * Get filled content
   * @param array $objects
   * @return string 
   */
  public function getFilledContent(array $objects) {
    foreach ($objects as $object) {
      $className = get_class($object);
      $attrs = get_class_vars($className);
      foreach ($attrs as $key => $value) {
        $search = $className . '::' . $key;
        if (is_object($object->$key)) {
          return $this->getFilledContent(array($object->$key));
        } else {
          $replace = is_string($object->$key) ? $object->$key : '';
          $this->body = str_replace($search, $replace, $this->body);
        }
      }
    }
    return $this->body;
  }

  public function getFilledAdress(array $objects) {
    foreach ($objects as $object) {
      $className = get_class($object);
      $attrs = get_class_vars($className);
      foreach ($attrs as $key => $value) {
        $search = $className . '::' . $key;

        if (is_object($object->$key)) {

          return $this->getFilledContent(array($object->$key));
        } else {
          $replace = is_string($object->$key) ? $object->$key : '';
          $this->to = str_replace($search, $replace, $this->to);
        }
      }
    }
    return $this->to;
  }

  public function getFilledBcc(array $objects) {
    foreach ($objects as $object) {
      $className = get_class($object);
      $attrs = get_class_vars($className);
      foreach ($attrs as $key => $value) {
        $search = $className . '::' . $key;

        if (is_object($object->$key)) {

          return $this->getFilledContent(array($object->$key));
        } else {
          $replace = is_string($object->$key) ? $object->$key : '';
          $this->bcc = str_replace($search, $replace, $this->bcc);
        }
      }
    }
    return $this->bcc;
  }

  public function getFilledSubject(array $objects) {
    foreach ($objects as $object) {
      $className = get_class($object);
      $attrs = get_class_vars($className);
      foreach ($attrs as $key => $value) {
        $search = $className . '::' . $key;
        if (is_object($object->$key)) {
          return $this->getFilledContent(array($object->$key));
        } else {
          $replace = is_string($object->$key) ? $object->$key : '';
          $this->subject = str_replace($search, $replace, $this->subject);
        }
      }
    }
    return $this->subject;
  }

}

?>
