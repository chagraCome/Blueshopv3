<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Newsletter_Template_Model implements Amhsoft_Data_Db_Model_Interface {

  /** @var integer id */
  public $id;

  /** @var string title */
  public $title;

  /** @var string content */
  public $content;

  /**
   * Check of null for id.
   * @return boolean True if id is null, false otherwise.
   */
  public function isIdNull() {
    return intval($this->id == 0);
  }

  /**
   * Check of null for title.
   * @return boolean True if title is null, false otherwise.
   */
  public function isTitleNull() {
    return ($this->title == null || trim($this->title) == '');
  }

  /**
   * Check of null for content.
   * @return boolean True if content is null, false otherwise.
   */
  public function isContentNull() {
    return ($this->content == null || trim($this->content) == '');
  }

  /**
   * Get id
   * @return integer id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get name
   * @return string name
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Get content
   * @return string content
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Set id
   * @param integer $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Set title
   * @param string $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * Set content
   * @param string $content
   */
  public function setContent($content) {
    $this->content = $content;
  }

  /**
   * Construct model.
   * @param integer $id primary key of db table
   */
  public function __construct($id = null) {
    if ($id) {
      $this->id = $id;
    }
  }

}

?>
