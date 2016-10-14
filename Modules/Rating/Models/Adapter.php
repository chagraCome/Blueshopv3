<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Rating_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'entity_rating';
    $this->className = 'Rating_Model';
    $this->map = array('id' => 'id',
	'entity_id' => 'entity_id',
	'entity_class' => 'entity_class',
	'rate' => 'rate',
	'name' => 'name',
	'comment' => 'comment',
	'rate_date_time' => 'rate_date_time',
	'ip' => 'ip',
	'state' => 'state',
    );
    parent::__construct();
  }

}

?>