<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Image_Model implements Amhsoft_Data_Db_Model_Interface {

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
  protected static $productConfig = NULL;

  /**
   * Model Construct
   */
  public function __construct() {
    $this->absolutepath = $this->getAbsolutePath();
  }

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
   * Gets Product Configuration
   * @return type
   */
  protected static function getProductConfig() {
    if (NULL == self::$productConfig) {
      self::$productConfig = new Amhsoft_Config_Table_Adapter('product');
    }
    return self::$productConfig;
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

  /**
   * Gets Description
   * @return type
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * set description
   * @param type $description
   * @return \Product_Image_Model
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * Get Title
   * @return type
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set Title
   * @param type $title
   * @return \Product_Image_Model
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  /**
   * Get Remote Url
   * @return type
   */
  public function getRemoteUrl() {
    return $this->remote_url;
  }

  /**
   * Check if have Remote Url 
   * @return type
   */
  public function isRemote() {
    return $this->remote_url != null;
  }

  /**
   * Check if  Locale Url 
   * @return type
   */
  public function isLocale() {
    return $this->remote_url == null;
  }

  /**
   * Gets Thumb
   * @return type
   */
  public function getThumb() {
    if ($this->isRemote()) {
      return $this->getRemoteUrl();
    }
    if ($this->isLocale()) {
      return $this->thumb();
    }
  }

  /**
   * Gets Big Image
   * @return type
   */
  public function getBig() {
    if ($this->isLocale()) {
      return $this->big();
    }
    if ($this->isRemote()) {
      return $this->getRemoteUrl();
    }
  }

  /**
   * Gets Height
   */
  public function getHeight() {
    
  }

  /**
   * Gets Width
   */
  public function getWidth() {
    
  }

  /**
   * Set Remot Url
   * @param type $remote_url
   * @return \Product_Image_Model
   */
  public function setRemoteUrl($remote_url) {
    $this->remote_url = $remote_url;
    return $this;
  }

  /**
   * Gets Insertat
   * @return type
   */
  public function getInsertat() {
    return $this->insertat;
  }

  /**
   * Set Insert At
   * @param type $insertat
   * @return \Product_Image_Model
   */
  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  /**
   * Resize Thumb
   * @return string
   */
  public function thumb() {
    $width = self::getProductConfig()->getIntValue('product_image_thumb_width');
    $height = self::getProductConfig()->getIntValue('product_image_thumb_height');
    if ($width == 0 && $height == 0) {
      return $this->getAbsolutePath();
    }
    if (!is_dir($this->getThumbAbsolutePathFolder() . $width . '_' . $height)) {
      mkdir($this->getThumbAbsolutePathFolder() . $width . '_' . $height, 0777, true);
    }
    $output = $this->getThumbAbsolutePathFolder() . $width . '_' . $height . '/' . $this->getId() . '.' . $this->getExtention();
    if (file_exists($output)) {
      return $output;
    }
    try {
      $resizer = $this->getResizer();
      $resizer->resizePercent($height, $width);
      $resizer->save($output);
      return $output;
    } catch (Exception $e) {
      return $this->getAbsolutePath();
    }
  }

  /**
   * Resize Big
   * @return string
   */
  public function big() {
    $width = self::getProductConfig()->getIntValue('product_image_width', 360);
    $height = self::getProductConfig()->getIntValue('product_image_height', 480);
    if ($width == 0 && $height == 0) {
      return $this->getAbsolutePath();
    }
    if (!is_dir($this->getThumbAbsolutePathFolder() . $width . '_' . $height)) {
      mkdir($this->getThumbAbsolutePathFolder() . $width . '_' . $height, 0777, true);
    }
    $output = $this->getThumbAbsolutePathFolder() . $width . '_' . $height . '/' . $this->getId() . '.' . $this->getExtention();
    if (file_exists($output)) {
      return $output;
    }
    try {
      $resizer = $this->getResizer();
      $resizer->resizePercent($height, $width);
      $resizer->save($output);
      return $output;
    } catch (Exception $e) {
      return $this->getAbsolutePath();
    }
  }

  /**
   * Check if document exists.
   * @return boolean true if document exists (as file system)
   */
  public function exists() {
    return file_exists($this->getAbsolutePath());
  }

  /**
   * Check if Thumb exists.
   * @return type
   */
  public function thumbExists() {
    return file_exists($this->getThumbAbsolutePath());
  }

  /**
   * Gets the absolute path of the document.
   * @return string absolute path of document.
   */
  public function getAbsolutePath() {
    return $this->getFolder() . '/' . $this->getId() . '.' . $this->getExtention();
  }

  public function getThumbAbsolutePath() {
    $width = self::getProductConfig()->getIntValue('product_image_thumb_width');
    $height = self::getProductConfig()->getIntValue('product_image_thumb_height');
    if ($width == 0 && $height == 0) {
      return $this->getThumbAbsolutePathFolder() . '/' . $this->getId() . '.' . $this->getExtention();
    }
    return $this->getThumbAbsolutePathFolder() . $width . '_' . $height . '/' . $this->getId() . '.' . $this->getExtention();
  }

  public function getAbsolutePathFolder() {
    return $this->getFolder() . '/';
  }

  public function getThumbAbsolutePathFolder() {
    return dirname($this->getFolder()) . '/thumb/';
  }

  /**
   * Delete file
   * @return boolean true if successfully deleted.
   */
  public function delete() {
    @unlink($this->getThumbAbsolutePath());
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

  /**
   * Upload file from temp
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
      } else {
	$this->thumb(); //create the thumb file.
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
      return $this->getThumb();
    }
  }

  public function __toString() {
    return $this->big();
  }

}

?>