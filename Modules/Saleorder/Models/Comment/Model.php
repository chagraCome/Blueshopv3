<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Comment_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $comment;

  /** @var User_User_Model $user * */
  public $user;
  public $insertat;
  public $admin_seen;
  public $account_seen;
  public $public;
  public $sale_order_id;
  public $author_name;

  /** @var Crm_Account_Model $acount * */
  public $account;

  /**
   * Sets SaleOrderComment id.
   * @param Integer $id
   * @return SaleOrderCommentModel
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets SaleOrderComment id.
   * @return Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets SaleOrderComment comment.
   * @param String $comment
   * @return SaleOrderCommentModel
   */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * Gets SaleOrderComment comment.
   * @return String $comment
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Sets SaleOrderComment insertat.
   * @param String $insertat
   * @return SaleOrderCommentModel
   */
  public function setInsertat($insertat) {
    $this->insertat = $insertat;
    return $this;
  }

  /**
   * Gets SaleOrderComment insertat.
   * @return String $insertat
   */
  public function getInsertat() {
    return $this->insertat;
  }

  /**
   * Gets SaleOrderComment user
   * @return UserModel $user
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Sets Gets SaleOrderComment user.
   * @param UserModel $user
   * @return SaleOrderCommentModel 
   */
  public function setUser(User_Model $user) {
    $this->user = $user;

    return $this;
  }

  public function __toString() {
    return $this->getComment();
  }

  
  public function getAdminSeen() {
    return $this->admin_seen;
  }

  public function setAdminSeen($admin_seen) {
    $this->admin_seen = $admin_seen;
  }

  public function getAccountSeen() {
    return $this->account_seen;
  }

  public function setAccountSeen($account_seen) {
    $this->account_seen = $account_seen;
  }

  public function getPublic() {
    return $this->public;
  }

  public function setPublic($public) {
    $this->public = $public;
  }

  public function getAccount() {
    return $this->account;
  }

  public function setAccount(Crm_Account_Model $account) {
    $this->account = $account;
  }
  
  public function getAuthorName() {
      return $this->author_name;
  }

  public function setAuthorName($author_name) {
      $this->author_name = $author_name;
  }




}

?>
