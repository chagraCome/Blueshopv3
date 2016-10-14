<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Template_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $newsletterTemplateModelAdapter = new Newsletter_Template_Model_Adapter();
      $newsletterTemplateModelAdapter->deleteById($id);
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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
   * Finalize controller
   */
  public function __finalize() {
    
  }

}

?>
