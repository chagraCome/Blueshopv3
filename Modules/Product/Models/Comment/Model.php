<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Comment_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $subject;
  public $comment;
  public $public;
  public $author;
  public $insertat;

  /** @var Product_Product_Model $product * */
  public $product;

  /**
   * Sets ProductComment id.
   * @param Integer $id
   * @return Product_Comment_Model
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets ProductComment id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets ProductComment subject.
   * @param String $subject
   * @return Product_Comment_Model
   */
  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  /**
   * Gets ProductComment subject.
   * @return String $subject
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Sets ProductComment comment.
   * @param String $comment
   * @return Product_Comment_Model
   */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * Gets ProductComment comment.
   * @return String $comment
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Sets ProductComment public.
   * @param Integer $public
   * @return Product_Comment_Model
   */
  public function setPublic($public) {
    $this->public = $public;
    return $this;
  }

  /**
   * Gets ProductComment public.
   * @return Integer $public
   */
  public function getPublic() {
    return $this->public;
  }

  /**
   * Sets ProductComment author.
   * @param String $author
   * @return Product_Comment_Model
   */
  public function setAuthor($author) {
    $this->author = $author;
    return $this;
  }

  /**
   * Gets ProductComment author.
   * @return String $author
   */
  public function getAuthor() {
    return $this->author;
  }

  /**
   * Sets ProductComment insertat.
   * @param String $insertat
   * @return ProductComment
   */
  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  /**
   * Gets ProductComment insertat.
   * @return String $insertat
   */
  public function getInsertat() {
    return $this->insertat;
  }

  /**
   * Gets Product product
   * @return Product_Product_Model  $product
   */
  public function getProduct() {
    return $this->product;
  }

  /**
   * Sets Product product
   * @param Product_Product_Model $product
   * @return Product_Comment_Model 
   */
  public function setProduct(Product_Product_Model $product) {
    $this->product = $product;
    return $this;
  }

}

?>
