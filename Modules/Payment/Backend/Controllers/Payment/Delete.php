<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Payment_Backend_Payment_Delete_Controller extends Amhsoft_System_Web_Controller {
  /*
   * Initialize Controller
   */

  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $paymentModelAdapter = new Payment_Payment_Model_Adapter();
      $paymentMethod = $paymentModelAdapter->fetchById($id);
      if ($paymentMethod instanceof Payment_Payment_Model) {
	if ($paymentMethod->modulename) {
	  Amhsoft_Database::getInstance()->exec("DELETE FROM module WHERE name = '$paymentMethod->modulename'");
	}
      }
      $paymentModelAdapter->deleteById($id);
      $this->getRedirector()->go(Amhsoft_History::back(0) . '&ret=true');
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    
  }

}

?>
