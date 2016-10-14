<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Banner
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Banner_Backend_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id >= 0) {
      $bannerModelAdapter = new Banner_Model_Adapter();
      $bannerModelAdapter->deleteById($id);
      $this->getRedirector()->go('?module=banner&page=list&ret=true');
    } else {
      $this->getRedirector()->go('?module=banner&page=list&ret=false');
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
