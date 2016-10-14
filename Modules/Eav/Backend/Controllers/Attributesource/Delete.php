<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributesource_Delete_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id >= 0) {
      $productAttributeModelAdapter = new Eav_Attribute_DataSource_Model_Adapter();
      $productAttributeModelAdapter->deleteById($id);
      Amhsoft_Navigator::go(Amhsoft_History::back() . '&ret=true');
    } else {
      $this->getRedirector()->go(Amhsoft_History::back(0) . '&ret=false');
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
