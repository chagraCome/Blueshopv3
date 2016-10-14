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
class Workflow_Action_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Construct a new WorkFlow_Action_Mail_Model_Adapter
   */
  public function __construct() {
    $this->table = 'workflow_action';
    $this->className = 'Workflow_Action_Model';
    $this->map = array(
        'id' => 'id',
        'name' => 'name',
        'type' => 'type',
        'state' => 'state',
        'workflow_id' => 'workflow_id'
    );
    $this->defineOne2One('template', 'template_id', 'Setting_EmailTemplate_Model');
    parent::__construct();
  }

  

}

?>
