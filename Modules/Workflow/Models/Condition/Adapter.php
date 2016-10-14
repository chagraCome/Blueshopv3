<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Condition_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Construct a new WorkFlow_Model_Adapter
   */
  public function __construct() {
    $this->table = 'workflow_condition';
    $this->className = 'Workflow_Condition_Model';
    $this->map = array(
        'id' => 'id',
        'condition_left' => 'condition_left',
        'condition_right' => 'condition_right',
        'condition_op' => 'condition_op',
        'state' => 'state',
        'workflow_id' => 'workflow_id'
    );
  }

}

?>
