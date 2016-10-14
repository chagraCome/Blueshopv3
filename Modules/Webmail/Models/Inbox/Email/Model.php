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
class Webmail_Inbox_Email_Model {

  public $id;
  public $from;
  public $to;
  public $subject;
  public $date;
  public $seen;
  public $message;
  protected $from_email;
  public $attachements = array();

  /**
   * Gets Id
   * @return type
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set Id
   * @param type $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets From
   * @return type
   */
  public function getFrom() {
    return $this->from;
  }

  /**
   * Set From
   * @param type $from
   */
  public function setFrom($from) {
    $this->from = $from;
  }

  /**
   * Gets Subject
   * @return type
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Set Subject
   * @param type $subject
   */
  public function setSubject($subject) {
    $this->subject = $subject;
  }

  /**
   * Gets Date
   * @return type
   */
  public function getDate() {
    return $this->date;
  }

  /**
   * Set Date
   * @param type $date
   */
  public function setDate($date) {
    $this->date = $date;
  }

  /**
   * Gets Seen
   * @return type
   */
  public function getSeen() {
    return $this->seen;
  }

  /**
   * Set Seen
   * @param type $seen
   */
  public function setSeen($seen) {
    $this->seen = $seen;
  }

  /**
   * Gets TO
   * @return type
   */
  public function getTo() {
    return $this->to;
  }

  /**
   * Set To
   * @param type $to
   */
  public function setTo($to) {
    $this->to = $to;
  }

  /**
   * Gets Message
   * @return type
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * Set Message
   * @param type $message
   */
  public function setMessage($message) {
    $this->message = $message;
  }

  /**
   * Gets FromEmail
   * @return type
   */
  public function getFromEmail() {
    if ($this->from) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->from, $addresse);
      if (isset($addresse[0])) {
	return $this->from_email = $addresse[0];
      }
    }
  }

  /**
   * Search on Crm_Account_Model by email.
   * @param type $email
   * @return \Crm_Account_Model|null
   */
  public function findAccount() {
    if ($this->from) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->from, $addresse);
      if (isset($addresse[0])) {
	$this->from_email = $addresse[0];
	$accountModelAdapter = new Crm_Account_Model_Adapter();
	$accountModelAdapter->where("(email1 = '$this->from_email'  OR email2 = '$this->from_email')");
	$accountModel = $accountModelAdapter->fetch()->fetch();
	return $accountModel;
      }
    }
    if ($this->to) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->to, $addresse);
      if (isset($addresse[0])) {
	$this->to = $addresse[0];
	$accountModelAdapter = new Crm_Account_Model_Adapter();
	$accountModelAdapter->where("(email1 = '$this->to'  OR email2 = '$this->to')");
	$accountModel = $accountModelAdapter->fetch()->fetch();
	return $accountModel;
      }
    }
    return null;
  }

  /**
   * Search on Crm_Account_Model by email.
   * @param type $email
   * @return \Crm_Account_Model|null
   */
  public function findContact() {
    if ($this->from) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->from, $addresse);
      if (isset($addresse[0])) {
	$this->from_email = $addresse[0];
	$contactModelAdapter = new Crm_Contact_Model_Adapter();
	$contactModelAdapter->where("email = '$this->from_email'");
	$contactModel = $contactModelAdapter->fetch()->fetch();
	return $contactModel;
      }
    }
    if ($this->to) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->to, $addresse1);
      if (isset($addresse1[0])) {
	$this->to = $addresse1[0];
	$contactModelAdapter = new Crm_Account_Model_Adapter();
	$contactModelAdapter->where("email = '$this->to'");
	$contactModel = $contactModelAdapter->fetch()->fetch();
	return $contactModel;
      }
    }
    return null;
  }
  
  public function getToEmail(){
     if ($this->to) {
      preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $this->to, $addresse);
      if (isset($addresse[0])) {
	return $this->to = $addresse[0];
      }
    }
  }
  
 
  /**
   * Assigne Email to Account
   * @param Crm_Account_Model $accountModel
   * @param Webmail_Setting_Model $settingModel
   * @return type
   */
  public function assignEmailToAccount(Crm_Account_Model $accountModel, Webmail_Setting_Model $settingModel) {
    $exists = Amhsoft_Database::querySingle("SELECT id FROM webmail_email WHERE (from_email = '" . addslashes($this->getFromEmail()) . "' OR to_emails LIKE '%" . addslashes($this->getToEmail()) . "%') AND remote_id = " . $this->id);
    if (intval($exists) > 0) {
      $db = Amhsoft_Database::getInstance();
      $db->exec("DELETE FROM account_has_email WHERE webmail_email_id = " . $exists);
      $statement = "INSERT INTO account_has_email VALUES(:email_id, :account_id)";
      $stmt = $db->prepare($statement);
      $stmt->bindValue(':account_id', $accountModel->getId());
      $stmt->bindValue(':email_id', $exists);
      $stmt->execute();
      return;
    }
    $model = new Webmail_Email_Model();
    $model->setFrom_email($this->from_email);
    $model->setFrom_name($this->from_email);
    $model->setSubject($this->subject);
    $model->setTo_emails($this->to ? ($this->to) : $settingModel->getEmail());
    $model->createat = Amhsoft_Locale::UCTDateTime();
    $model->setSendat($this->date);
    $model->setContent($this->message);
    $model->setState($settingModel->getEmail() == $this->to ? Webmail_Email_Model::RECEIVED : Webmail_Email_Model::SEND);
    $model->setRemote($this->id);
    $adapter = new Webmail_Email_Model_Adapter();
    $adapter->save($model);
    if ($model->getId() > 0) {
      $statement = "INSERT INTO account_has_email VALUES(:email_id, :acc_id)";
      $db = Amhsoft_Database::getInstance();
      $stmt = $db->prepare($statement);
      $stmt->bindValue(':acc_id', $accountModel->getId());
      $stmt->bindValue(':email_id', $model->getId());
      $stmt->execute();
    }
    //save scan date time to setting model so that we can filter the next scan
    // the next scan must be since last scan date.
  }

  /**
   * Assign Email To Contact
   * @param Crm_Contact_Model $contactModel
   * @param Webmail_Setting_Model $settingModel
   * @return type
   */
  public function assignEmailToContact(Crm_Contact_Model $contactModel, Webmail_Setting_Model $settingModel) {
    $exists = Amhsoft_Database::querySingle("SELECT id FROM webmail_email WHERE (from_email = '" . $this->getFromEmail() . "' OR to_emails LIKE '%" . $this->getToEmail() . "%') AND remote_id = " . $this->id);
    if (intval($exists) > 0) {
      $db = Amhsoft_Database::getInstance();
      $db->exec("DELETE FROM contact_has_email WHERE webmail_email_id = " . $exists);
      $statement = "INSERT INTO contact_has_email VALUES(:email_id, :cont_id)";
      $stmt = $db->prepare($statement);
      $stmt->bindValue(':cont_id', $contactModel->getId());
      $stmt->bindValue(':email_id', $exists);
      $stmt->execute();
      return;
    }
    $model = new Webmail_Email_Model();
    $model->setFrom_email($this->from_email);
    $model->setFrom_name($this->from_email);
    $model->setSubject($this->subject);
    $model->setTo_emails($this->to ? $this->to : $settingModel->getEmail());
    $model->createat = Amhsoft_Locale::UCTDateTime();
    $model->setSendat(Amhsoft_Locale::UCTDateTime($this->date));
    $model->setContent($this->message);
    $model->setState($settingModel->getEmail() == $this->to ? Webmail_Email_Model::RECEIVED : Webmail_Email_Model::SEND);
    $model->setRemote($this->id);
    $adapter = new Webmail_Email_Model_Adapter();
    $adapter->save($model);
    if ($model->getId() > 0) {
      $statement = "INSERT INTO contact_has_email VALUES(:email_id, :cont_id)";
      $db = Amhsoft_Database::getInstance();
      $stmt = $db->prepare($statement);
      $stmt->bindParam(':cont_id', $contactModel->getId());
      $stmt->bindParam(':email_id', $model->getId());
      $stmt->execute();
    }
    //save scan date time to setting model so that we can filter the next scan
    // the next scan must be since last scan date.
  }

}

?>
