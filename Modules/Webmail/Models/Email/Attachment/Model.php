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
class Webmail_Email_Attachment_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $binary;
  public $ext;
  public $type;

  /**
   * From FIle
   * @param type $file_url
   * @return \Webmail_Email_Attachment_Model
   */
  public static function fromFile($file_url) {
    if (file_exists($file_url)) {
      $attachementModel = new Webmail_Email_Attachment_Model();
      $attachementModel->setBinary(file_get_contents($file_url));
      $ext = end(explode('.', $file_url));
      $attachementModel->setExt($ext);
      $name = end(explode("/", $file_url));
      $attachementModel->setName($name);
      if (function_exists('mime_content_type')) {
	$attachementModel->setType(mime_content_type($file_url));
      }
      return $attachementModel;
    }
  }

  /**
   * Gets Name
   * @return type
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name
   * @param type $name
   */
  public function setName($name) {
    $this->name = $name;
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
   * Gets webmail_email.
   * @return 
   * */
  public function getWebmail_email() {
    return $this->webmail_email;
  }

  /**
   * Set webmail_email.
   * @param  webmail_email 
   * @return 
   * */
  public function setWebmail_email($webmail_email) {
    $this->webmail_email = $webmail_email;
    return $this;
  }

  /**
   * Gets binary.
   * @return 
   * */
  public function getBinary() {
    return $this->binary;
  }

  /**
   * Set binary.
   * @param  binary 
   * @return 
   * */
  public function setBinary($binary) {
    $this->binary = $binary;
    return $this;
  }

  /**
   * Gets ext.
   * @return 
   * */
  public function getExt() {
    return $this->ext;
  }

  /**
   * Set ext.
   * @param  ext 
   * @return 
   * */
  public function setExt($ext) {
    $this->ext = $ext;
    return $this;
  }

  /**
   * Gets type.
   * @return 
   * */
  public function getType() {
    return $this->type;
  }

  /**
   * Set type.
   * @param  type 
   * @return 
   * */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

}

?>
