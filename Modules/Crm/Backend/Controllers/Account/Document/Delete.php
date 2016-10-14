<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Crm_Backend_Account_Document_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize event
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $documentModelAdapter = new Crm_Account_Document_Model_Adapter();
      $documentModelAdapter->deleteById($id);
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
    } else {
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=false');
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
