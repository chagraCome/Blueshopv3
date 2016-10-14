<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Inbox_Email_Model_Adapter {

  protected $inbox = null;
  protected $settingid = null;

  /** @var Webmail_Setting_Model $settingModel */
  protected $settingModel;

  /**
   * Model Adapter Construct
   * @param type $settingid
   */
  public function __construct($settingid = null) {
    $this->settingid = $settingid;
  }

  /**
   * Gets Setting Id
   * @return type
   */
  public function getSettingId() {
    return $this->settingid;
  }

  /**
   * Set Setting Id
   * @param type $settingid
   */
  public function setSettingId($settingid) {
    $this->settingid = $settingid;
  }

  /**
   * 
   * @return Webmail_Setting_Model
   */
  public function getSettingModel() {
    return $this->settingModel;
  }

  /**
   * Set Setting Model
   * @param Webmail_Setting_Model $settingModel
   */
  public function setSettingModel(Webmail_Setting_Model $settingModel) {
    $this->settingModel = $settingModel;
    $this->settingid = $this->settingModel->getId();
  }

  /**
   * Check if Open
   * @return type
   */
  public function isOpened() {
    return !$this->inbox === NULL;
  }

  /**
   * Clase
   */
  public function close() {
    if ($this->isOpened()) {
      imap_close($this->inbox);
    }
  }

  /**
   * Open
   * @param type $box
   * @throws Exception
   */
  public function open($box = 'Inbox') {
    if ($this->settingid) {
      $this->settingModel = Webmail_Setting_Model::getInComingSettings(null, $this->settingid);
    } else {
      $this->settingModel = Webmail_Setting_Model::getInComingSettings(Amhsoft_Authentication::getInstance()->getObject()->id, null);
      $this->settingid = $this->settingModel->getId();
    }
    /* connect to gmail */
    $connection = $this->settingModel->getConnectionString();
    $username = $this->settingModel->getEmail();
    $password = $this->settingModel->getPassword();
    /* try to connect */
    @imap_timeout(IMAP_READTIMEOUT, 5);
    $this->inbox = @imap_open($connection . $box, $username, $password, OP_READONLY);
    if (!$this->inbox) {
      throw new Exception(_t('Cannot establish connection to server: ') . $connection);
    }
  }

  /**
   * Fetch 
   * @param type $query
   * @param type $box
   * @return \Webmail_Inbox_Email_Model
   */
  public function fetch($query = 'ALL', $box = 'Inbox') {
    if (!$this->isOpened()) {
      $this->open($box);
    }
    $emails = array();
    /* grab emails */
    $emails = imap_search($this->inbox, $query, 0, 'UTF-8');
    $models = array();
    if ($emails) {
      rsort($emails);
      foreach ($emails as $email_number) {
	$overview = imap_fetch_overview($this->inbox, $email_number, 0);
	/* get information specific to this email */
	$model = new Webmail_Inbox_Email_Model();
	$model->id = $email_number;
	$model->from = ($overview[0]->from);
	$model->from = imap_utf8($model->from);
	$model->to = @$overview[0]->to;
	$model->to = imap_utf8($model->to);
	$model->date = Amhsoft_Locale::DateTime($overview[0]->date);
	$model->subject = @$overview[0]->subject;
	$model->subject = imap_utf8($model->subject);
	$model->seen = $overview[0]->seen;
	$model->message = $this->getBody($overview[0]->uid, $this->inbox);
	$model->uid = $overview[0]->uid;
	$models[] = $model;
      }
    }
    imap_close($this->inbox);
    return $models;
  }

  /**
   * Fetch Email By Id;
   * @param type $uid
   * @return Webmail_Inbox_Email_Model
   */
  public function fetchById($uid) {
    if (!$this->isOpened()) {
      $this->open();
    }
    $overview = imap_fetch_overview($this->inbox, $uid);
    $model = new Webmail_Inbox_Email_Model();
    $model->id = $uid;
    $model->from = ($overview[0]->from);
    $model->from = imap_utf8($model->from);
    $model->date = Amhsoft_Locale::DateTime($overview[0]->date);
    $model->subject = $overview[0]->subject;
    mb_internal_encoding('UTF-8');
    $model->subject = imap_utf8($model->subject);
    $model->seen = $overview[0]->seen;
    $model->message = nl2br($this->getBody($overview[0]->uid, $this->inbox));
    $mailStruct = imap_fetchstructure($this->inbox, $uid);
    $model->attachements = $this->getAttachments($this->inbox, $uid, $mailStruct, "");
    $model->uid = $overview[0]->uid;
    return $model;
  }

  /**
   * Gets Total Email Count.
   * @return Integer $count;
   */
  public function getUnreadMessages() {
    if (!$this->isOpened()) {
      $this->open();
    }
    if (!$this->inbox)
      return false;
    $check = imap_mailboxmsginfo($this->inbox);
    $count = $check->Unread;
    $this->close();
    return $count;
  }

  /**
   * Save Email to database and assign to account.
   * @param Webmail_Email_Model $model
   * @param type $id
   */
  public function __destruct() {
    $this->close();
  }

  /**
   * Get EMail Body
   * @param type $uid
   * @param type $imap
   * @return type
   */
  protected function getBody($uid, $imap) {
    mb_internal_encoding('UTF-8');
    $body = $this->get_part($imap, $uid, "TEXT/HTML");
    // if HTML body is empty, try getting text body
    if ($body == "") {
      $body = $this->get_part($imap, $uid, "TEXT/PLAIN");
    }
    return ($body);
  }

  /**
   * Get Part
   * @param type $imap
   * @param type $uid
   * @param type $mimetype
   * @param type $structure
   * @param int $partNumber
   * @return boolean
   */
  protected function get_part($imap, $uid, $mimetype, $structure = false, $partNumber = false) {
    if (!$structure) {
      $structure = imap_fetchstructure($imap, $uid, FT_UID);
    }
    if ($structure) {
      if ($mimetype == $this->get_mime_type($structure)) {
	if (!$partNumber) {
	  $partNumber = 1;
	}
	$text = imap_fetchbody($imap, $uid, $partNumber, "1");
	$encodetoutf8 = false;
	foreach ((array) $structure->parameters as $param) {
	  if ($param->attribute == 'charset') {
	    $enc = $param->value;
	    if ($enc != 'utf-8') {
	      $encodetoutf8 = true;
	    }
	  }
	}
	switch ($structure->encoding) {
	  case 3: return $encodetoutf8 == true ? utf8_encode(imap_base64($text)) : imap_base64($text);
	  case 4: return $encodetoutf8 == true ? utf8_encode(imap_qprint($text)) : imap_qprint($text);
	  default: return $text;
	}
      }
      // multipart 
      if ($structure->type == 1) {
	foreach ($structure->parts as $index => $subStruct) {
	  $prefix = "";
	  if ($partNumber) {
	    $prefix = $partNumber . ".";
	  }
	  $data = $this->get_part($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
	  if ($data) {
	    return $data;
	  }
	}
      }
    }
    return false;
  }

  /**
   * Get Mime Type
   * @param type $structure
   * @return string
   */
  function get_mime_type($structure) {
    $primaryMimetype = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
    if ($structure->subtype) {
      return $primaryMimetype[(int) $structure->type] . "/" . $structure->subtype;
    }
    return "TEXT/PLAIN";
  }

  /**
   * Get Attachements
   * @param type $imap
   * @param type $mailNum
   * @param type $part
   * @param type $partNum
   * @return array
   */
  protected function getAttachments($imap, $mailNum, $part, $partNum) {
    $attachments = array();
    if (isset($part->parts)) {
      foreach ($part->parts as $key => $subpart) {
	if ($partNum != "") {
	  $newPartNum = $partNum . "." . ($key + 1);
	} else {
	  $newPartNum = ($key + 1);
	}
	$result = $this->getAttachments($imap, $mailNum, $subpart, $newPartNum);
	if (count($result) != 0) {
	  array_push($attachments, $result);
	}
      }
    } else if (isset($part->disposition)) {
      if (strtoupper($part->disposition) == "ATTACHMENT") {
	$partStruct = imap_bodystruct($imap, $mailNum, $partNum);
	$attachmentDetails = array(
	    "name" => $part->dparameters[0]->value,
	    "partNum" => $partNum,
	    "enc" => $partStruct->encoding
	);
	return $attachmentDetails;
      }
    }
    return $attachments;
  }

  /**
   * Download Attachement
   * @param type $uid
   * @param type $partNum
   * @param type $encoding
   */
  public function downloadAttachment($uid, $partNum, $encoding) {
    $partStruct = imap_bodystruct($this->inbox, imap_msgno($this->inbox, $uid), $partNum);
    $filename = $partStruct->dparameters[0]->value;
    $message = imap_fetchbody($this->inbox, $uid, $partNum, FT_UID);
    switch ($encoding) {
      case 0:
      case 1:
	$message = imap_8bit($message);
	break;
      case 2:
	$message = imap_binary($message);
	break;
      case 3:
	$message = imap_base64($message);
	break;
      case 4:
	$message = quoted_printable_decode($message);
	break;
    }
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $filename);
    header("Content-Transfer-Encoding: binary");
    header("Expires: 0");
    header("Cache-Control: must-revalidate");
    header("Pragma: public");
    echo $message;
  }

  /**
   * Gets Attachement As Binary
   * @param type $uid
   * @param type $partNum
   * @param type $encoding
   * @return type
   */
  public function getAttachmentAsBinary($uid, $partNum, $encoding) {
    $partStruct = imap_bodystruct($this->inbox, imap_msgno($this->inbox, $uid), $partNum);
    $filename = $partStruct->dparameters[0]->value;
    $message = imap_fetchbody($this->inbox, $uid, $partNum, FT_UID);
    switch ($encoding) {
      case 0:
      case 1:
	$message = imap_8bit($message);
	break;
      case 2:
	$message = imap_binary($message);
	break;
      case 3:
	$message = imap_base64($message);
	break;
      case 4:
	$message = quoted_printable_decode($message);
	break;
    }
    return array('file' => $filename, 'data' => $message);
  }

}

?>
