<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: index.php 5 2011-10-19 09:16:11Z cherif $
 * $Rev: 5 $
 * @package    Setting
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2011-10-19 11:16:11 +0200 (Mi, 19 Okt 2011) $
 * $LastChangedDate: 2011-10-19 11:16:11 +0200 (Mi, 19 Okt 2011) $
 * $Author: cherif $
 * *********************************************************************************************** */

class Setting_Backend_Template_Email_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id >= 0) {
      $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
      $emailTemplateModelAdapter->deleteById($id);
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
    } else {
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=false');
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
