<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Banner_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $folder;
  public $type;
  public $extention;
  public $hash;
  public $public;
  public $description;
  public $title;
  public $remote_url;
  public $insertat;
  public $state;
  public $sortid;

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
    if (!is_dir(ltrim($folder, '/'))) {
      mkdir(ltrim($folder, '/'));
    }
    $this->folder = $folder;
    return $this;
  }

  /**
   * Gets Document folder.
   * @return String $folder
   */
  public function getFolder() {
    return ltrim($this->folder, '/');
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

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  public function getRemoteUrl() {
    return $this->remote_url;
  }

  public function isRemote() {
    return $this->remote_url != null;
  }

  public function isLocale() {
    return $this->remote_url == null;
  }

  public function getBig() {
    if ($this->isLocale()) {
      return $this->big();
    }

    if ($this->isRemote()) {
      return $this->getRemoteUrl();
    }
  }

  public function getHeight() {
    
  }

  public function getWidth() {
    
  }

  public function setRemoteUrl($remote_url) {
    $this->remote_url = $remote_url;
    return $this;
  }

  public function getInsertat() {
    return $this->insertat;
  }

  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  public function big() {
    return $this->getAbsolutePath();
  }

  /**
   * Check if document exists.
   * @return boolean true if document exists (as file system)
   */
  public function exists() {
    return file_exists($this->getAbsolutePath());
  }

  /**
   * Gets the absolute path of the document.
   * @return string absolute path of document.
   */
  public function getAbsolutePath() {
    return $this->getFolder() . '/' . $this->getId() . '.' . $this->getExtention();
  }

  public function getAbsolutePathFolder() {
    return $this->getFolder() . '/';
  }

  /**
   * Delete file
   * @return boolean true if successfully deleted.
   */
  public function delete() {
    return @unlink($this->getAbsolutePath());
  }

  /**
   * Rename file.
   * @param string $newNAme
   * @return boolean true if renamed. 
   */
  public function rename($newNAme) {
    @rename($this->getThumbAbsolutePath(), $this->getThumbAbsolutePathFolder() . $newNAme . '.' . $this->getExtention());
    return @rename($this->getAbsolutePath(), $this->getAbsolutePathFolder() . $newNAme . '.' . $this->getExtention());
  }

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

  public function uploadFromLocal($local) {
    if (file_exists($local)) {
      copy($local, $this->getAbsolutePath());
    }
  }

  /**
   * Get Resizer
   * @return Amhsoft_Image_Resizer 
   */
  public function getResizer() {
    if ($this->exists()) {
      $resizer = new Amhsoft_Image_Resizer();
      $resizer->load($this->getAbsolutePath());
      return $resizer;
    } else {
      throw new Exception('file does not exists');
    }
  }

  public function __get($name) {
    if ($name == 'absolutepath') {
      return $this->getAbsolutePath();
    }

    if ($name == "thumb_image") {
      return $this->getAbsolutePath();
    }
  }

  public function __toString() {
    return $this->getAbsolutePath();
  }

  public function __construct() {
    $this->absolutepath = $this->getAbsolutePath();
  }

}

?>