<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_MailInbox_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $subject;
  public $content;
  public $createat;
  public $issend;
  public $sendat;
  public $comment;
  public $user;
  public $lead;
  public $email_to;
  public $to;
  public $cc;

  /**
   * Gets MailInbox id.
   * @return Integer $id 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets MailInbox id.
   * @param Integer $id
   * @return Crm_MailInbox_Model 
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets MailInbox subject.
   * @return String $subject 
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Sets MailInbox $subject.
   * @param String $subject
   * @return Crm_MailInbox_Model 
   */
  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  /**
   * Gets MailInbox content.
   * @return String $content
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Sets MailInbox content.
   * @param String $content
   * @return Crm_MailInbox_Model 
   */
  public function setContent($content) {
    $this->content = $content;
    return $this;
  }

  /**
   * gets MailInbox createat.
   * @return String $createat
   */
  public function getCreateat() {
    return $this->createat;
  }

  /**
   * Sets MailInbox createat.
   * @param String $createat
   * @return MailInboxModel 
   */
  public function setCreateat($createat) {
    $this->createat = $createat;
    return $this;
  }

  /**
   * Gets MailInbox issend.
   * @return Integer $issend
   */
  public function getIssend() {
    return $this->issend;
  }

  /**
   * Sets MailInbox issend.
   * @param Integer $issend
   * @return MailInboxModel 
   */
  public function setIssend($issend) {
    $this->issend = $issend;
    return $this;
  }

  /**
   * Gets MailInbox sendat.
   * @return String $sendat
   */
  public function getSendat() {
    return $this->sendat;
  }

  /**
   * Sets MailInbox sendat.
   * @param String $sendat
   * @return MailInboxModel 
   */
  public function setSendat($sendat) {
    $this->sendat = $sendat;
    return $this;
  }

  /**
   * Gets MailInbox comment.
   * @return String $comment 
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Sets MailInbox comment.
   * @param String $comment
   * @return MailInboxModel 
   */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  public function getUser() {
    return $this->user;
  }

  public function setUser(User_User_Model $user) {
    $this->user = $user;
    return $this;
  }

  public function getLead() {
    return $this->lead;
  }

  public function setLead(Crm_Lead_Model $lead) {
    $this->lead = $lead;
  }

}

?>
