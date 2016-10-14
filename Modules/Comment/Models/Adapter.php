<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'comment_item';
    $this->className = 'Comment_Model';
    $this->map = array('id' => 'id',
	'comment' => 'comment',
	'subject' => 'subject',
	'entity' => 'entity',
	'insertat' => 'insertat',
	'author_name' => 'author_name',
	'user_seen' => 'user_seen',
	'public_seen' => 'public_seen',
	'public' => 'public',
	'entity_id' => 'entity_id'
    );
    parent::__construct();
  }

}

?>
