<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Email_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $from_name;
  public $from_email;
  public $to_emails;
  public $cc_emails;
  public $bcc_emails;
  public $subject;
  public $content;
  public $state;
  public $createat;
  public $sendat;
  public $remote_id;

  const FAILED = 1;
  const DRAFT = 2;
  const SEND = 3;
  const RECEIVED = 4;

  public $attachements = array();

  /**
   * Add Attachment to Email
   * @param Webmail_Email_Attachment_Model $attachement
   * @return \Webmail_Email_Model
   */
  public function addAttachement(Webmail_Email_Attachment_Model $attachement) {
    $this->attachements[] = $attachement;
    return $this;
  }

  /**
   * Gets Attachment
   * @return type
   */
  public function getAttachements() {
    return $this->attachements;
  }

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return 
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets from_name.
   * @return 
   * */
  public function getFrom_name() {
    return $this->from_name;
  }

  /**
   * Set from_name.
   * @param  from_name 
   * @return 
   * */
  public function setFrom_name($from_name) {
    $this->from_name = $from_name;
    return $this;
  }

  /**
   * Gets from_email.
   * @return 
   * */
  public function getFrom_email() {
    return $this->from_email;
  }

  /**
   * Set from_email.
   * @param  from_email 
   * @return 
   * */
  public function setFrom_email($from_email) {
    $this->from_email = $from_email;
    return $this;
  }

  /**
   * Gets to_emails.
   * @return 
   * */
  public function getTo_emails() {
    return $this->to_emails;
  }

  /**
   * Set to_emails.
   * @param  to_emails 
   * @return 
   * */
  public function setTo_emails($to_emails) {
    $this->to_emails = $to_emails;
    return $this;
  }

  /**
   * Gets cc_emails.
   * @return 
   * */
  public function getCc_emails() {
    return $this->cc_emails;
  }

  /**
   * Set cc_emails.
   * @param  cc_emails 
   * @return 
   * */
  public function setCc_emails($cc_emails) {
    $this->cc_emails = $cc_emails;
    return $this;
  }

  /**
   * Gets bcc_emails.
   * @return 
   * */
  public function getBcc_emails() {
    return $this->bcc_emails;
  }

  /**
   * Set bcc_emails.
   * @param  bcc_emails 
   * @return 
   * */
  public function setBcc_emails($bcc_emails) {
    $this->bcc_emails = $bcc_emails;
    return $this;
  }

  /**
   * Gets subject.
   * @return 
   * */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Set subject.
   * @param  subject 
   * @return 
   * */
  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  /**
   * Gets content.
   * @return 
   * */
  public function getContent() {
    return $this->content;
  }

  /**
   * Set content.
   * @param  content 
   * @return 
   * */
  public function setContent($content) {
    $this->content = $content;
    return $this;
  }

  /**
   * Gets state.
   * @return 
   * */
  public function getState() {
    return $this->state;
  }

  /**
   * Set state.
   * @param  state 
   * @return 
   * */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets createat.
   * @return 
   * */
  public function getCreateat() {
    return $this->createat;
  }

  /**
   * Set createat.
   * @param  createat 
   * @return 
   * */
  public function setCreateat($createat) {
    $this->createat = $createat;
    return $this;
  }

  /**
   * Gets sendat.
   * @return 
   * */
  public function getSendat() {
    return $this->sendat;
  }

  /**
   * Set sendat.
   * @param  sendat 
   * @return 
   * */
  public function setSendat($sendat) {
    $this->sendat = $sendat;
    return $this;
  }

  /**
   * Gets remote.
   * @return 
   * */
  public function getRemote() {
    return $this->remote_id;
  }

  /**
   * Set remote.
   * @param  remote 
   * @return 
   * */
  public function setRemote($remote) {
    $this->remote_id = $remote;
    return $this;
  }

  public function __get($name) {
    if ($name == 'status_text') {
      if ($this->state == self::SEND) {
	return _t('Sent');
      }
      if ($this->state == self::DRAFT) {
	return _t('Draft');
      }
      if ($this->state == self::FAILED) {
	return _t('Failed');
      }
      if ($this->state == self::RECEIVED) {
	return _t('Received');
      }
    }
  }

}

?>
