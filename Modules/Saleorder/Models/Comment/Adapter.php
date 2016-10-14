<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Comment_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct() {
    $this->table = 'sale_order_comment';
    $this->className = 'Saleorder_Comment_Model';
    $this->map = array(
        'id' => 'id',
        'comment' => 'comment',
        'author_name' => 'author_name',
        'insertat' => 'insertat',
        'admin_seen' => 'admin_seen',
        'account_seen' => 'account_seen',
        'public' => 'public',
        'sale_order_id' => 'sale_order_id'
    );
    $this->defineOne2One('user', 'user_id', 'User_User_Model');
    $this->defineOne2One('account', 'account_id', 'Crm_Account_Model');
    parent::__construct();
  }
  
  
  public static function getAdminNonSeenCount(){
      $saCommentAdapter = new Saleorder_Comment_Model_Adapter();
      $saCommentAdapter->where('admin_seen = 0');
      return $saCommentAdapter->getCount();
  }
  
  public static function getCustomerNonSeenCount($customerId){
      $saCommentAdapter = new Saleorder_Comment_Model_Adapter();
      $saCommentAdapter->where('account_seen = 0');
      $saCommentAdapter->where('account_id = ?', $customerId);
      return $saCommentAdapter->getCount();
  }


}
?>
