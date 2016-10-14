<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cms_Box_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer $id */
  public $id;

  /** @var string $name */
  public $name;

  /** @var string $html */
  public $html;

  /** @var integer $online */
  public $online;

  /** @var integer $border */
  public $border;

  /** @var integer $link */
  public $link;
  public $file;
  public $image;
  public $entrypoint;

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
   * Gets name
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
   * Get Html
   * @return type
   */
  public function getHtml() {
    return $this->html;
  }

  /**
   * Set Html
   * @param type $html
   */
  public function setHtml($html) {
    $this->html = $html;
  }

  /**
   * Gets Online
   * @return type
   */
  public function getOnline() {
    return $this->online;
  }

  /**
   * Set Online
   * @param type $online
   */
  public function setOnline($online) {
    $this->online = $online;
  }

  /**
   * Gets Border
   * @return type
   */
  public function getBorder() {
    return $this->border;
  }

  /*
   * Set Border
   */

  public function setBorder($border) {
    $this->border = $border;
  }

  /**
   * Gets Link
   * @return type
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * Set Link
   * @param type $link
   */
  public function setLink($link) {
    $this->link = $link;
  }

  /**
   * Gets Image
   * @return type
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * Set Images
   * @param type $image
   */
  public function setImage($image) {
    $this->image = $image;
  }

  /**
   * Gets File
   * @return type
   */
  public function getFile() {
    return $this->file;
  }

  /**
   * Set File
   * @param type $file
   */
  public function setFile($file) {
    $this->file = $file;
  }

  /**
   * Gets Entrypoint
   * @return type
   */
  public function getEntrypoint() {
    return $this->entrypoint;
  }

  /**
   * Set EntryPoint
   * @param type $entrypoint
   */
  public function setEntrypoint($entrypoint) {
    $this->entrypoint = $entrypoint;
  }

  /**
   * Gets Type as Sting
   * @return type
   */
  public function getTypeString() {
    if ($this->entrypoint) {
      return _t('Variable Block');
    }
    if (!$this->file) {
      return _t('Text Block');
    }
    if (preg_match('/mainmenu/i', $this->file)) {
      return _t('Horizontal Menu Block');
    }
    if (preg_match('/box.cms/i', $this->file)) {
      return _t('Vertical Menu Block');
    }
    if (preg_match('/box/i', $this->file)) {
      return _t('Page Box Block');
    }
    return _t('Block');
  }

}
