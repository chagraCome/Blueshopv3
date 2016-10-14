<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_Reply_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $comment_item;
  public $comment;
  public $insertat;
  public $author_name;

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
   * Gets comment_item.
   * @return 
   * */
  public function getComment_item() {
    return $this->comment_item;
  }

  /**
   * Set comment_item.
   * @param  comment_item 
   * @return 
   * */
  public function setComment_item($comment_item) {
    $this->comment_item = $comment_item;
    return $this;
  }

  /**
   * Gets comment.
   * @return 
   * */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Set comment.
   * @param  comment 
   * @return 
   * */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * Gets insertat.
   * @return 
   * */
  public function getInsertat() {
    return $this->insertat;
  }

  /**
   * Set insertat.
   * @param  insertat 
   * @return 
   * */
  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  /**
   * Gets author_name.
   * @return 
   * */
  public function getAuthor_name() {
    return $this->author_name;
  }

  /**
   * Set author_name.
   * @param  author_name 
   * @return 
   * */
  public function setAuthor_name($author_name) {
    $this->author_name = $author_name;
    return $this;
  }

  public function getLocaleInsertAt() {
    return Amhsoft_Locale::DateTime($this->insertat);
  }

}

?>
