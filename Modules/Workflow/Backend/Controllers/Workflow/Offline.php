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
class Workflow_Backend_Workflow_Offline_Controller extends Amhsoft_System_Web_Controller {

  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $workflowModelAdapter = new Workflow_Model_Adapter();
      $workFlow = $workflowModelAdapter->fetchById($id);
      $workFlow->setState(0);
      $workflowModelAdapter->update($workFlow);
      $this->getRedirector()->go('admin.php?module=workflow&page=workflow-list&ret=true');
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  public function __default() {
    
  }

  public function __finalize() {
    
  }

}

?>
