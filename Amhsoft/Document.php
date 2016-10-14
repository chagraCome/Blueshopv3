<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Document.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Amhsoft_Document{

  public $id;
  public $name;
  public $folder;
  public $type;
  public $extention;
  public $hash;
  public $public;

  /**
   * Sets Document id.
   * @param Integer $id
   * @return DocumentModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets Document id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets Document name.
   * @param String $name
   * @return DocumentModel
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets Document name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets Document folder.
   * @param String $folder
   * @return DocumentModel
   */
  public function setFolder($folder) {
    if (!is_dir($folder)) {
      if(!mkdir($folder)){
          die('cannot create '.$folder.' permission denied!');
      }
    }
    $this->folder = $folder;
    return $this;
  }

  /**
   * Gets Document folder.
   * @return String $folder
   */
  public function getFolder() {
    return $this->folder;
  }

  /**
   * Sets Document type.
   * @param String $type
   * @return DocumentModel
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * Gets Document type.
   * @return String $type
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Gets Icon
   * @return string
   */
  public function getIcon() {
    if ($this->type == "Image") {
      return "Design/Frontend/Amhshop/images/image.png";
    }
    if ($this->type == "Document") {
      return "Design/Frontend/Amhshop/images/document.png";
    }
    if ($this->type == "Zip File") {
      return "Design/Frontend/Amhshop/images/zip.png";
    }
    if ($this->type == "Software") {
      return "Design/Frontend/Amhshop/images/software.png";
    }
  }

  /**
   * Sets Document extention.
   * @param String $extention
   * @return DocumentModel
   */
  public function setExtention($extention) {
    $this->extention = $extention;
    return $this;
  }

  /**
   * Gets Document extention.
   * @return String $extention
   */
  public function getExtention() {
    return $this->extention;
  }

  /**
   * Sets Document hash.
   * @param String $hash
   * @return DocumentModel
   */
  public function setHash($hash) {
    $this->hash = $hash;
    return $this;
  }

  /**
   * Gets Document hash.
   * @return String $hash
   */
  public function getHash() {
    return $this->hash;
  }

  /**
   * Sets Document public.
   * @param String $public
   * @return DocumentModel
   */
  public function setPublic($public) {
    $this->public = $public;
    return $this;
  }

  /**
   * Gets Document public.
   * @return String $public
   */
  public function getPublic() {
    return $this->public;
  }

  /**
   * Check if document exists.
   * @return boolean true if document exists (as file system)
   */
  public function exists() {
    return file_exists($this->getAbsolutePath());
  }

  public function __get($name) {
    if ($name == 'absolutepath') {
      return $this->getAbsolutePath();
    }
  }

  /**
   * Gets the absolute path of the document.
   * @return string absolute path of document.
   */
  public function getAbsolutePath() {
    return $this->getFolder() . '/' . md5($this->getId().$this->getName()) . '.' . $this->getExtention(); //hash:id-name
  }

  public function getAbsolutePathFolder() {
    return $this->getFolder() . '/';
  }

  /**
   * Delete file
   * @return boolean true if successfully deleted.
   */
  public function delete() {
    echo $this->getAbsolutePath();
    return @unlink($this->getAbsolutePath());
  }

  /**
   * Rename file.
   * @param string $newNAme
   * @return boolean true if renamed. 
   */
  public function rename($newNAme) {
    return @rename($this->getAbsolutePath(), $this->getAbsolutePathFolder() . $newNAme . '.' . $this->getExtention());
  }

  /**
   * Upload File from temp
   * @param type $file
   * @throws Exception
   */
  public function uploadFromTemp($file) {
    if ($file['error']) {
      throw new Exception($file['error']);
    }
    if (is_uploaded_file($file['tmp_name'])) {
      $e = @move_uploaded_file($file['tmp_name'], $this->getAbsolutePath());
      if ($e !== TRUE) {
	throw new Exception(_t('file cannote be uploaded'));
      }
    }
  }

}

?>
