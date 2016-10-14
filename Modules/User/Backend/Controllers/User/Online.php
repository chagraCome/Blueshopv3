<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Online.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_User_Online_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize controller.
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $userUserModelAdapter = new User_User_Model_Adapter();
      $userUserModel = $userUserModelAdapter->fetchById($id);
      if ($userUserModel instanceof User_User_Model) {
	$userUserModel->state = 1;
	$userUserModelAdapter->save($userUserModel);
	$this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event.
   */
  public function __finalize() {
    
  }

}

?>
