<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: File.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_File {

  protected $file;
  protected $fileSystem = true;

  public function __construct($file = null) {
    $this->setFile($file);
  }

  public function setFile($file) {
    $this->file = $file;
    if (is_array($file)) {
      $this->fileSystem = false;
    }
  }

  public function getSize() {
    if ($this->fileSystem) {
      return filesize($this->file);
    } else {
      return $this->file['size'];
    }
  }

  public function getMimeType() {
    if ($this->fileSystem) {
      return mime_content_type($this->file);
    } else {
      if (is_uploaded_file($this->file['tmp_name'])) {
        return mime_content_type($this->file['tmp_name']);
      } else {
        return false;
      }
    }
  }

  public function copy($distinationFolder, $newName) {
    $distination = rtrim($distinationFolder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    $distination .= $newName;
    if ($this->fileSystem) {
      return @copy($this->file, $distination);
    } else {
      if (is_uploaded_file($this->file['tmp_name'])) {
        is_uploaded_file($distination);
      }
    }
  }

  public function move($distinationFolder, $newName) {
    $distination = rtrim($distinationFolder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    $distination .= $newName;
    if ($this->fileSystem) {
      $resultCopy = @copy($this->file, $distination);
      @unlink($this->file);
      return $resultCopy;
    } else {
      if (is_uploaded_file($this->file['tmp_name'])) {
        return move_uploaded_file($this->file['tmp_name'], $distination);
      }
    }
  }

}