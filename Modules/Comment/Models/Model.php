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
class Comment_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $comment;
  public $subject;
  public $entity;
  public $insertat;
  public $author_name;
  public $user_seen;
  public $public_seen;
  public $public;
  public $entity_id;
  public $replys;

  /**
   * Gets Replys
   * @return type
   */
  public function getReplys() {
    if ($this->replys === null) {
      $replyModelAdapter = new Comment_Reply_Model_Adapter();
      $replyModelAdapter->where('comment_item_id = ? ', $this->id);
      $this->replys = $replyModelAdapter->fetch();
    }
    return $this->replys;
  }

  /**
   * Reply Count
   * @return type
   */
  public function getReplysCount() {
    $replyModelAdapter = new Comment_Reply_Model_Adapter();
    $replyModelAdapter->where('comment_item_id = ? ', $this->id);
    return $replyModelAdapter->getCount();
  }

  /*
   * Set Reply
   */

  public function setReplys($replys) {
    $this->replys = $replys;
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
   * @return Comment_Model
   * */
  public function setId($id) {
    $this->id = $id;
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
   * @return Comment_Model
   * */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * Gets subject.
   * @return 
   * */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Set subject.
   * @param  subject 
   * @return Comment_Model
   * */
  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  /**
   * Gets entity.
   * @return 
   * */
  public function getEntity() {
    return $this->entity;
  }

  /**
   * Set entity.
   * @param  entity 
   * @return Comment_Model
   * */
  public function setEntity($entity) {
    $this->entity = $entity;
    return $this;
  }

  /**
   * 
   * @return void
   */
  public function getEntityId() {
    return $this->entity_id;
  }

  /**
   * 
   * @param type $id
   * @return \Comment_Model
   */
  public function setEntityId($id) {
    $this->entity_id = $id;
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
   * @return Comment_Model
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
   * @return Comment_Model
   * */
  public function setAuthor_name($author_name) {
    $this->author_name = $author_name;
    return $this;
  }

  /**
   * Gets user_seen.
   * @return 
   * */
  public function getUser_seen() {
    return $this->user_seen;
  }

  /**
   * Set user_seen.
   * @param  user_seen 
   * @return Comment_Model
   * */
  public function setUser_seen($user_seen) {
    $this->user_seen = $user_seen;
    return $this;
  }

  /**
   * Gets public_seen.
   * @return 
   * */
  public function getPublic_seen() {
    return $this->public_seen;
  }

  /**
   * Set public_seen.
   * @param  public_seen 
   * @return Comment_Model
   * */
  public function setPublic_seen($public_seen) {
    $this->public_seen = $public_seen;
    return $this;
  }

  /**
   * Gets public.
   * @return 
   * */
  public function getPublic() {
    return $this->public;
  }

  /**
   * Set public.
   * @param  public 
   * @return Comment_Model
   * */
  public function setPublic($public) {
    $this->public = $public;
    return $this;
  }

  public function getLocaleInsertAt() {
    return Amhsoft_Locale::DateTime($this->insertat);
  }

}

?>
