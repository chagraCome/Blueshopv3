<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Offline.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Default_Backend_Portlet_Offline_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $defaultPortletModelAdapter = new Default_Portlet_Model_Adapter();
      $defaultPortletModel = $defaultPortletModelAdapter->fetchById($id);
      if ($defaultPortletModel instanceof Default_Portlet_Model) {
	$user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
	$this->save($id, $user_id, 0);
	$this->getRedirector()->go(Amhsoft_History::back(0) . '&ret=true');
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Save Portlet state
   */
  public function save($id, $user_id, $status) {
    $e = Amhsoft_Database::querySingle("SELECT portlet_id FROM portlet_user WHERE portlet_id = $id AND user_id = $user_id");
    if ($e) {
      Amhsoft_Database::getInstance()->exec("UPDATE portlet_user SET status = $status WHERE user_id = $user_id ANd portlet_id = $id");
    } else {
      Amhsoft_Database::getInstance()->exec("INSERT INTO portlet_user VALUES ($id, $user_id, 'L', 0, $status)");
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