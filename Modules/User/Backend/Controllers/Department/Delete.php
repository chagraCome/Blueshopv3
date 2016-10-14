<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Delete.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_Department_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id >= 0) {
      $userDepartmentModelAdapter = new User_Department_Model_Adapter();
      $userDepartmentModelAdapter->deleteById($id);
      $this->getRedirector()->go('admin.php?module=user&page=department-list&ret=true');
    } else {
      $this->getRedirector()->go('admin.php?module=user&page=department-list&ret=false');
    }
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    
  }

}

?>
